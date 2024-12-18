@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Blog Đã Tạo Thành Công</h2>
        <div class="card">
            <div class="card-body">
                {{-- <h3 class="card-title">{{ $blog['title'] }}</h3>
                <p class="card-text">{!! nl2br(e($blog['content'])) !!}</p> --}}
            </div>
        </div>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-secondary mt-3">Tạo Blog Mới</a>
    </div>
@endsection
