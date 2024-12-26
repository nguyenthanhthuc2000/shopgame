@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Tạo mới Blog</h2>
        <form action="{{ route('admin.blog.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="content">Nội dung</label>
                <textarea name="content" id="content" class="form-control ckeditor-box" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
    @vite(['resources/js/pages-exclusive/ckeditor.js'])
@endsection
