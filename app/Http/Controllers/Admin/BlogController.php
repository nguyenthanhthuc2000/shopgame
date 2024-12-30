<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Google\Service\Blogger\Resource\Blogs;
use Google\Service\ServiceControl\Auth as GoogleAuth;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(request $request)
    {
        $blogs = Blog::orderBy('id', 'DESC');

        if ($request->username) {
            $blogs = $blogs->filterByTitle($request->username);
        }


        $blogs = $blogs->paginate(10)
            ->withQueryString();

        return view('pages.admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.admin.blog.create');
    }

    public function store(BlogRequest $request)
    {
        if (empty($request->title)) {
            return back()->withErrors(['title' => 'Tiêu đề không được để trống.']);
        }

        $slug = Carbon::now()->format('YmdHis');

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = $slug;
        $blog->status = $request->has('is_public') && $request->is_public ? 1 : 0;
        $blog->user_id = LaravelAuth::id();
        $blog->save();

        return redirect()->route('admin.blog.index')->with([
            'success' => 'Bài viết đã được lưu thành công.',
        ]);
    }

    public function destroy($id)
    {
        $deleted = Blog::find($id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy bài viết.'
            ], 404);
        }

        $deleted->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công!'
        ]);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('pages.admin.blog.edit', compact('blog'));
    }

    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->status = $request->has('is_public') && $request->is_public ? 1 : 0;
        $blog->user_id = LaravelAuth::id();
        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }
}
