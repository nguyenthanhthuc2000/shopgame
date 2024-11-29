<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Models\Category;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        $accounts = Account::orderBy('id', 'DESC')->paginate();

        return view('pages.account-manage', compact('accounts'));
    }

    /**
     * Summary of show
     * 
     * @param mixed $categorySlug
     * @param mixed $accountUuid
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($categorySlug, $accountUuid)
    {
        $category = Category::where('slug', $categorySlug)->first();
        $account = Account::where('uuid', $accountUuid)->first();

        if (empty($category) || empty($category) || !empty($category) && $category->status !== Category::ACTIVE_STATUS) {
            return redirect()->route('home');
        }
        $class = collect(Account::CLASSED)->where('value', $account->class)->first();
        $regisType = collect(Account::REGIS_TYPE)->where('value', $account->regis_type)->first();
        $earring = collect(Account::EARRING)->where('value', $account->earring)->first();
        $server = collect(Account::SERVER)->where('value', $account->server)->first();

        return view('pages.account-detail', compact([
            'account',
            'category',
            'class',
            'regisType',
            'earring',
            'server',
        ]));
    }

    public function buyNick(Request $request, $accountUuid)
    {
        $account = Account::where('uuid', $accountUuid)->first();
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
        $classes = Account::CLASSED;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;

        $data = compact(
            'categories',
            'classes',
            'regisTypes',
            'earring',
            'servers'
        );

        return view('pages.create-account',  $data);
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
            'note' => $request->input('description', 0),
            'user_id' => Auth::id(),
            'status' => 1,
        ];

        DB::transaction(function () use ($request, $accountData) {
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
            }

            if ($request->hasFile('gallery')) {
                $imagesDetail = $request->file('gallery');
            }

            $this->accountService->storeAccount($accountData, $banner, $imagesDetail ?? []);
        });

        return redirect()->route('banks.tran.index')->with('success', "Thêm nick thành công");
    }

    /**
     * Summary of edit
     * 
     * @param mixed $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($uuid)
    {
        $categories = Category::isActive()->get();
        $classes = Account::CLASSED;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;
        $account = Account::whereUuid($uuid)->first();

        $data = compact(
            'categories',
            'classes',
            'regisTypes',
            'earring',
            'servers',
            'account'
        );
        return view('pages.edit-account', $data);
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }
    public function destroy($uuid)
    {
        dd($uuid);
    }
}
