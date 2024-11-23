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
    public function index(Request $request, $slug)
    {
        dd( $slug);
    }
}
