<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Models\Category;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * @var GoogleDriveService $googleDriveService
     */
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
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

    public function show($slug, $uuid)
    {
        return view('pages.detail');
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

        $accountCreated = Account::create($accountData);

        if ($accountCreated) {
            $folderId = config('google.accounts_folder_id');

            if ($request->hasFile('banner')) {
                $banner = $this->googleDriveService->uploadSingleFile($request->file('banner'), $folderId);
            }

            if ($request->hasFile('gallery')) {
                $imagesDetail = $this->googleDriveService->uploadMultipleFiles($request->file('gallery'), $folderId);
            }
            // TODO: Save the images in the table
        }

        dd($accountCreated, $banner, $imagesDetail);
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