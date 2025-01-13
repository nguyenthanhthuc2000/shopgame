<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\ToggleRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(request $request)
    {
        $filters = $request->only(['username']);

        $blogs = Blog::with('user')
            ->filterByKey($filters)
            ->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        return view('pages.admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.admin.blog.create');
    }

    public function store(StoreRequest $request)
    {
        $slug = Str::slug($request->title, '-') . '-' . Carbon::now()->format('d-m-Y');

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = $slug;
        $blog->status = $request->has('is_public') && $request->is_public ? 1 : 0;
        $blog->user_id = Auth::id();
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

    public function update(StoreRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->status = $request->has('is_public') && $request->is_public ? 1 : 0;
        $blog->user_id = Auth::id();
        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function toggleStatus(ToggleRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $newStatus = filter_var($request->is_public, FILTER_VALIDATE_BOOLEAN);

        $blog->status = $newStatus;
        $blog->save();

        return response()->json([
            'success' => true,
            'new_status' => $blog->status,
            'status_name' => $blog->status_name,
            'status_color' => $blog->status_color
        ]);
    }
}
