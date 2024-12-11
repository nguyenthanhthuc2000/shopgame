<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    /**
     * Trang danh mục game
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'DESC')
            ->paginate(10);

        return view('pages.admin.category.index', compact([
            'categories',
        ]));
    }
}