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
}