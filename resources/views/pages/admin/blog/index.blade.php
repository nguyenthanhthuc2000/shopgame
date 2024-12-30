@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <h2 class="mb-4">Bài viết</h2>
                    <div class="col-12">
                        <div class="card">
                            <div class="d-flex justify-content-end my-3 gap-3">
                                <div class="d-flex">
                                    <form action="{{ route('admin.blog.index') }}" method="GET">
                                        <div class="input-group w-100">
                                            <input type="text" for="username" id="username" name="username"
                                                class="form-control" placeholder="Tìm kiếm bài viết..." aria-label="Search"
                                                aria-describedby="searchIcon" value="{{ request('title') }}">
                                            <button type="submit" class="input-group-text" id="searchIcon">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary col-xs-12 btn4"
                                    style="display: flex; align-items: center; gap: 6px;">
                                    <i class="fa-solid fa-plus"></i>
                                    Thêm Mới
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">ID</th>
                                            <th>Tiêu đề</th>
                                            <th>Tài khoản</th>
                                            <th>Slug</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->id }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->user_id }}</td>
                                                <td>{{ $blog->slug }}</td>
                                                <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                                                {{-- <td class='badge'>{{ $blog->status_name }}</td> --}}
                                                <td>
                                                    @if ($blog->status_name === 'Hiện')
                                                        <span class="badge bg-success">Hiện</span>
                                                    @else
                                                        <span class="badge">Ẩn</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <button type="button" class="btn btn-danger btn-delete"
                                                            data-id="{{ $blog->id }}"
                                                            data-url="{{ route('admin.blog.delete', $blog->id) }}">Xóa</button>
                                                        <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                            class="btn btn-warning">Sửa</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Không có bài viết nào.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <div class="ms-auto">
                                    {{-- {{ $blogs->links('pagination::bootstrap-5') }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@vite(['resources/js/pages-exclusive/blog-manage.js'])
