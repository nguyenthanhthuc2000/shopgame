<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

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

    public function index()
    {
        return 'this is a list of accounts';
    }

    public function show($id)
    {
        dd($id);
    }

    public function create(Request $request)
    {
        $categories = Category::isActive()->get();
        return view('pages.create-account',  compact('categories'));
    }

    public function store(Request $request)
    {
        $folderId = config('google.accounts_folder_id');
        $response = $this->googleDriveService->uploadFile($request->banner, $folderId);
        return view('components.image', ['src' => $response['src_url']]);
    }
}
