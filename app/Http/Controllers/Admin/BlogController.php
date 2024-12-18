<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index(request $request)
    {
        return view('pages.admin.blog.index');
    }

    public function create()
    {
        // dd(Blog::get());
        return view('pages.admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // $blog = new Account();

        // $blog->title = $request->input('title');
        // $blog->content = $request->input('content');
        // $blog->save();

        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã được lưu thành công.');
    }
}
