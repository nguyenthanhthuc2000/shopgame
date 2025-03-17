<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    /**
     * Game category page
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);

        return view('pages.admin.category.index', compact(['categories'])); 
    }
}
