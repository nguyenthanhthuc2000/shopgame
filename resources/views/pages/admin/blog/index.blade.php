@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Blog Đã Tạo Thành Công</h2>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="justify-content: space-between; gap:8px;">
                                <h3 class="card-title">Danh sách</h3>
                                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                                    <form action="{{ route('admin.blog.index') }}" method="get" autocomplete="off"
                                        novalidate>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </span>
                                            <input type="text" name="id" value="{{ request('id') }}"
                                                class="form-control" placeholder="Tìm kiếm tài khoản..." aria-label="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">ID</th>
                                            <th>Tài khoản</th>
                                            <th>Tiêu đề</th>
                                            <th>Nội dung</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->id }}</td>
                                                <td>{{ $blog->slug }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->content }}</td>
                                                <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($blog->status === 1)
                                                        <span class="badge bg-success">Hoạt động</span>
                                                    @else
                                                        <span class="badge bg-warning">Đã khóa</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <button type="button" class="btn btn-danger btn-delete"
                                                            data-id="{{ $blog->id }}"
                                                            data-url="{{ route('admin.blog.delete', $blog->id) }}">Xóa</button>
                                                        <a href="{{ route('account.edit', $blog->id ?? '#') }}"
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
        <a href="{{ route('admin.blog.create') }}" class="btn btn-secondary mt-3">Tạo Blog Mới</a>
    </div>
@endsection
