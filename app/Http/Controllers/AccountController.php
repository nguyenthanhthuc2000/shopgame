<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Models\Category;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function index(Request $request)
    {
        // $query = Account::orther();

        // if ($request->filled('searchValue')) {
        //     $query->where('account_name', 'like', '%' . $request->searchValue . '%');
        // }

        // if ($request->filled('selectedPrice')) {
        //     $query->where('account_price', $request->selectedPrice);
        // }

        // if ($request->filled('selectedOption')) {
        //     $query->where('option', $request->selectedOption);
        // }

        $accounts = Account::orderBy('id', 'DESC')
            ->paginate();
        // dd($accounts->toarray());
        return view('pages.product', compact('accounts'));
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

        if (empty($category) || empty($category)) {
            return redirect()->route('home');
        }

        return view('pages.account-detail', compact(['account', 'category']));
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

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
        }

        if ($request->hasFile('gallery')) {
            $imagesDetail = $request->file('gallery');
        }

        $accountCreated = $this->accountService->storeAccount($accountData, $banner, $imagesDetail ?? []);

        dd($accountCreated);
    }

    public function edit($id)
    {
        dd($id);
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }
    public function filterProducts(Request $request) {}
}
