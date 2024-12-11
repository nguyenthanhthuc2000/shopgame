<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        dd(123);
    }
    public function create(Request $request)
    {
        return view('pages.admin.blog.index');
    }
}