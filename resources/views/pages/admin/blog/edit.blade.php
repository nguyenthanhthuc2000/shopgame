@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa Bài Viết</h2>
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-2">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
            </div>
            <div class="form-group mb-2">
                <label for="content">Nội dung</label>
                <textarea name="content" id="content" class="form-control ckeditor-box" rows="10" required>{{ $blog->content }}</textarea>
            </div>
            <div class="form-group mb-2">
                <label for="is_public">
                    <input type="checkbox" name="is_public" id="is_public" {{ $blog->status == 1 ? 'checked' : '' }}>
                    Hiện
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@endsection
