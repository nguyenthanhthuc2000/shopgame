@extends('layouts.app')

@section('title', 'Tài Khoản Ngọc Rồng | NickDaoQuan.Vn')

@section('content')
    {{-- <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            /* khoảng cách phía dưới */
        }

        .page-info {
            text-align: center;
            margin-top: 10px;
            /* khoảng cách phía trên */
            font-size: 14px;
            color: #555;
        }
    </style> --}}
    <div class="list-section app-sub-menu" style="padding-top: 130px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="row-flex-safari game-list">
                    <section id="cardbody" class="section">
                        <div class="row">
                            {{-- LEFT MENU --}}
                            <div class="col-lg-3">
                                @include('components.app-sub-menu')
                            </div>
                            {{-- END LEFT MENU --}}

                            <div class="col-lg-9">
                                <div class="col-sm-12 text-center">
                                    <h1 style="font-size: 26px;">TÀI KHOẢN NGỌC RỒNG</h1>
                                </div>
                                <div class="d-flex justify-content-end my-3 gap-3">
                                    <a href="{{ route('account.create') }}" class="btn btn-primary col-xs-12 btn4"
                                        style="display: flex; align-items: center; gap: 6px;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 12H20M12 4V20" stroke="#FFFFFF" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Thêm Mới
                                    </a>
                                    <div class="d-flex justify-content-end">
                                        <div class="input-group w-100">
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Tìm kiếm tài khoản..." aria-label="Search"
                                                aria-describedby="searchIcon">
                                            <span class="input-group-text" id="searchIcon">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @auth
                                        <div id="accountList" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Mã Nick</th>
                                                        <th scope="col" style="min-width: 150px;">Tài Khoản</th>
                                                        <th scope="col" style="min-width: 70px;">Giá</th>
                                                        <th scope="col" style="min-width: 70px;">Giá KM</th>
                                                        <th scope="col" style="min-width: 60px;">Trạng Thái</th>
                                                        <th scope="col" style="min-width: 60px;">Ngày Tạo</th>
                                                        <th scope="col" style="min-width: 60px;">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($accounts as $account)
                                                        <tr>
                                                            <td>#{{ $account->id }}</td>
                                                            <td>{{ $account->username }}</td>
                                                            <td>{{ getPrice($account->price) }}</td>
                                                            <td>{{ getPrice($account->discount_price) }}</td>
                                                            <td>{{ config('account.account_status.' . $account->status) }}</td>
                                                            <td>{{ date('d/m/Y H:i', strtotime($account->created_at)) }}</td>
                                                            <td>
                                                                @if ($account->status !== \App\Models\Account::STATUS_AVAILABLE)
                                                                    <div class="d-flex gap-3">
                                                                        <button type="button" class="btn btn-danger btn-delete"
                                                                            data-id="{{ $account->uuid }}"
                                                                            data-url="{{ route('account.delete', $account->uuid) }}">Xóa</button>
                                                                        <a href="{{ route('account.edit', $account->uuid ?? '#') }}"
                                                                            class="btn btn-warning">Sửa</a>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">Không tìm thấy tài khoản</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        {!! $accounts->links() !!}
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('.btn-delete').on('click', confirmDelete)
        })

        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const uuid = $(event.currentTarget).data('id');
                    const url = $(event.currentTarget).data('url');
                    handleDelete(url, uuid);
                }
            });
        }

        function handleDelete(url, uuid) {
            $.ajax({
                url: url,
                type: 'delete',
                success: function(response) {
                    Swal.fire({
                        title: 'Thông báo!',
                        text: response.message,
                        icon: response.status,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: response.message,
                        icon: response.status,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    });
                },
            })
        }
    </script>
@endpush
