<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Trang danh mục game
     *
     * @param Request $request
     */
    public function index(Request $request) {}

    public function show($slug)
    {
        $accounts = Category::whereSlug($slug)->first()->accounts;

        return view('pages.product', compact('accounts'));
    }

    /**
     * Summary of list
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {
        $categories = Category::withCount([
            'soldAccounts as sold_count',
            'unsoldAccounts as unsold_count',
        ])->orderBy('id', 'DESC')->get();

        return view('pages.categories', compact('categories'));
    }
}