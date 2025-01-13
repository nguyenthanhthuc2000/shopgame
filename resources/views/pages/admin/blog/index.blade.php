@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <h2 class="mb-4">Bài viết</h2>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Danh sách</h3>
                                <div class="d-flex justify-content-end my-3 gap-3">
                                    <form action="{{ route('admin.blog.index') }}" method="GET" class="mb-0">
                                        <div class="input-group w-100">
                                            <input type="text" for="username" id="username" name="username"
                                                class="form-control" placeholder="Tìm kiếm bài viết..." aria-label="Search"
                                                aria-describedby="searchIcon"
                                                value="{{ request('username') ?? old('username') }}">
                                            <button type="submit" class="input-group-text" id="searchIcon">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-plus"></i>
                                        &nbsp;Thêm Mới
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">Stt</th>
                                            <th>Tiêu đề</th>
                                            <th>Tài khoản</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày sửa</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->user->email }}</td>
                                                <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $blog->slug}}</td>
                                                <td>
                                                    <button class="badge {{ $blog->status_color }} btn-toggle-status"
                                                        data-url="{{ route('admin.blog.toggle', $blog->id) }}"
                                                        data-status="{{ $blog->status }}">
                                                        {{ $blog->status_name }}
                                                    </button>
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
                                    {{ $blogs->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @vite(['resources/js/pages-exclusive/blog-manage.js'])
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-toggle-status', function() {
                var button = $(this);
                var url = button.data('url');
                var currentStatus = button.data('status');
                var newStatus = currentStatus == 1 ? 0 : 1;
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        is_public: newStatus,
                    },
                    success: function(response) {
                        if (response.success) {
                            button.data('status', newStatus);
                            button.text(newStatus ? 'Hiện' : 'Ẩn');
                            button.text(response.status_name);
                            button.removeClass('bg-secondary bg-success')
                                .addClass(response.status_color);
                        }
                    },
                });
            });
        });
    </script>
@endpush
