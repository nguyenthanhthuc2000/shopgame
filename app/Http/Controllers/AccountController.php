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
        $accounts = Account::orderBy('id', 'DESC')
            ->paginate();
        return view('pages.product', compact('accounts'));
    }

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

    public function create(Request $request)
    {
        $categories = Category::isActive()->get();
        $classes = [
            [
                'name' => 'Xayda',
                'value' => '1',
            ],
            [
                'name' => 'Trái đất',
                'value' => '2',
            ],
            [
                'name' => 'Namec',
                'value' => '3',
            ],
        ];
        $regisTypes = [
            [
                'name' => 'Đăng ký ảo',
                'value' => '0',
            ],
            [
                'name' => 'Đăng ký bằng số điện thoại',
                'value' => '1',
            ],
            [
                'name' => 'Đăng ký bằng email',
                'value' => '2',
            ],
        ];
        $earring = [
            [
                'name' => 'Có',
                'value' => '1',
            ],
            [
                'name' => 'Không',
                'value' => '0',
            ],
        ];
        $servers = [
            [
                'name' => 'Server 1',
                'value' => '1',
            ],
            [
                'name' => 'Server 2',
                'value' => '2',
            ],
            [
                'name' => 'Server 3',
                'value' => '3',
            ],
            [
                'name' => 'Server 4',
                'value' => '4',
            ],
            [
                'name' => 'Server 5',
                'value' => '5',
            ],
            [
                'name' => 'Server 6',
                'value' => '6',
            ],
            [
                'name' => 'Server 7',
                'value' => '7',
            ],
            [
                'name' => 'Server 8',
                'value' => '8',
            ],
            [
                'name' => 'Server 9',
                'value' => '9',
            ],
            [
                'name' => 'Server 10',
                'value' => '10',
            ],
            [
                'name' => 'Server 11',
                'value' => '11',
            ],
            [
                'name' => 'Server 12',
                'value' => '12',
            ],
        ];

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
