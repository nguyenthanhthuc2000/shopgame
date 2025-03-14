<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Models\Category;
use App\Services\AccountService;

class AccountController extends Controller
{
    /**
     * @var AccountService $accountService
     */
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Summary of index
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $accountName = $request->input('account_name');

        $accounts = Account::with(['category'])
            ->orderBy('id', 'DESC')
            ->where('user_id', Auth::id())
            ->filter(request())
            ->byUserName($accountName)
            ->paginate()
            ->withQueryString();

        $classes = Account::CLASSES;

        return view('pages.account.account-manage', compact('accounts', 'classes'));
    }

    /**
     * Summary of show
     *
     * @param Category $category
     * @param Account $account
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Category $category, Account $account)
    {
        if ($account->status === Account::STATUS_HIDE) {
            flash()->error('Tài khoản này hiện không hoạt động!');
            return redirect()->route('home');
        }

        if ($category->status !== Category::ACTIVE_STATUS) {
            flash()->error('Danh mục game hiện không hoạt động!');
            return redirect()->route('home');
        }

        $accountRefs = Account::with(relations: 'banner')
            ->whereNotIn('id', [$account->id])
            ->where('server', $account->server)
            ->where('status', Account::STATUS_AVAILABLE)
            ->where('category_id', $category->id)
            ->limit(8)
            ->get();

        return view('pages.account.account-detail', compact([
            'account',
            'category',
            'accountRefs',
        ]));
    }

    /**
     * Summary of create
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $categories = Category::isActive()->get();
        $classes = Account::CLASSES;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;
        $statuses = Account::STATUS;

        return view('pages.create-account',  compact([
            'categories',
            'classes',
            'regisTypes',
            'earring',
            'servers',
            'statuses',
        ]));
    }

    /**
     * Summary of store
     *
     * @param \App\Http\Requests\AccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AccountRequest $request)
    {
        $accountData = [
            'uuid' => Str::uuid(),
            'price' => $request->input('price_account', ''),
            'username' => $request->input('username', ''),
            'password' => $request->input('password', ''),
            'category_id' => $request->input('category_id', ''),
            'server' => $request->input('server_id', ''),
            'class' => $request->input('class_id', ''),
            'regis_type' => $request->input('regis_type_id', 0),
            'earring' => $request->input('earring', 0),
            'note' => $request->input('description', 0),
            'user_id' => Auth::id(),
            'status' => Account::STATUS_AVAILABLE,
        ];

        DB::transaction(function () use ($request, $accountData) {
            $this->accountService->storeAccount(
                $accountData,
                $request->file('banner'),
                $request->file('gallery', [])
            );
        });

        flash()->success('Thêm tài khoản thành công, hình ảnh của nick sẽ được cập nhật trong giây lát.');
        return redirect()->route('account.manage.index');
    }

    /**
     * Summary of edit
     *
     * @param Account $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Account $account)
    {
        $categories = Category::isActive()->get();
        $classes = Account::CLASSES;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;
        $statuses = Account::STATUS;

        if (!$account->canEdit()) {
            return redirect()->route('account.manage.index');
        }

        return view('pages.account.edit-account', compact([
            'categories',
            'classes',
            'regisTypes',
            'earring',
            'servers',
            'account',
            'statuses',
        ]));
    }

    /**
     * Update account
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Account $account
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Account $account)
    {
        if (!$account->canEdit()) {
            return redirect()->back()->with('error', 'Tài khoản không hợp lệ');
        }

        $accountData = [
            'price' => $request->input('price_account'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'category_id' => $request->input('category_id'),
            'server' => $request->input('server_id'),
            'class' => $request->input('class_id'),
            'regis_type' => $request->input('regis_type_id'),
            'earring' => $request->input('earring'),
            'note' => $request->input('description'),
            'status' => $request->input('status'),
        ];

        $accountData = array_filter($accountData, fn($value) => $value !== '' && $value !== null);

        DB::transaction(function () use ($request, $accountData, $account) {
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
            }

            if ($request->hasFile('gallery')) {
                $imagesDetail = $request->file('gallery');
            }

            if (!empty($accountData['removed_image'])) {
                $accountData['removed_image'] = explode(';', $accountData['removed_image']);
            }

            $this->accountService->updateAccount($account, $accountData, $banner ?? null, $imagesDetail ?? []);
        });

        flash()->success('Cập nhật tài khoản thành công, hình ảnh của nick sẽ được cập nhật trong giây lát.');
        return redirect()->route('account.manage.index');
    }

    /**
     * Destroy account
     *
     * @param \App\Models\Account $account
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Account $account)
    {
        $deleted = $this->accountService->delete($account);

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thành công!'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('messages.common_error'),
        ]);
    }
}
