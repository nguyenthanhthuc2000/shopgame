<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Account;
use App\Models\Blog;
use Google\Service\Blogger\Resource\Blogs;
use Google\Service\ServiceControl\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(request $request)
    {
        $blogs = Blog::filterById($request->input('id'))
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.admin.blog.create');
    }

    public function store(BlogRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();

        $slug = str::slug($validatedData['title'], '-');

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->slug = $slug;
        $blog->save();

        return redirect()->route('admin.blog.index')->with([
            'success' => 'Bài viết đã được lưu thành công.',
        ]);
    }

    public function destroy($id)
    {
        // $blog = Blog::where('id', Auth::id())
        //     ->where('id', $id)
        //     ->first();

        // if (!$blog) {
        //     return redirect()->route('admin.blog.index')->with('error', 'Không tìm thấy bài viết.');
        // }

        // if ($blog->status !== Blog::STATUS_AVAILABLE) {
        //     $blog->delete();
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Xóa thành công!'
        //     ]);
        // }

        // return response()->json([
        //     'status' => 'error',
        //     'message' => 'Bài viết đang hoạt động, không thể xóa.'
        // ]);
    }
}