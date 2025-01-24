@extends('layouts.app')

@section('title', 'Tài Khoản Ngọc Rồng | NickDaoQuan.Vn')

@section('content')
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
                                <div class="d-flex flex-wrap-reverse justify-content-between">
                                    <div class="search-container mb-3 col-12 col-md-8">
                                        @include('pages.account.account-search')
                                    </div>
                                    <div class="search-container mb-3 col-12 col-md-4 text-end">
                                        <a href="{{ route('account.create') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-plus"></i>
                                            Thêm Mới
                                        </a>
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
                                                        <th scope="col" style="min-width: 60px;">Trạng Thái</th>
                                                        <th scope="col" style="min-width: 60px;">Ngày Tạo</th>
                                                        <th scope="col" class="text-end" style="min-width: 60px;">Hành Động
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($accounts as $account)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>{{ $account->username }}</td>
                                                            <td>{{ $account->price_formated }}</td>
                                                            <td>
                                                                <span
                                                                    class="acccount-status acccount-status--{{ $account->status_bg_color }}">{{ $account->status_name }}</span>
                                                            </td>
                                                            <td>{{ date('d/m/Y H:i', strtotime($account->created_at)) }}</td>
                                                            <td>
                                                                <div class="d-flex gap-3 justify-content-end">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ route('account.show', ['category' => $account->category->slug, 'account' => $account->uuid]) }}"><i
                                                                            class="far fa-eye"></i></a>
                                                                    @if ($account->canEdit())
                                                                        <a href="{{ route('account.edit', ['account' => $account->uuid]) }}"
                                                                            class="btn btn-warning"><i
                                                                                class="fas fa-edit"></i></a>
                                                                        <button type="button" class="btn btn-danger btn-delete"
                                                                            data-id="{{ $account->uuid }}"
                                                                            data-url="{{ route('account.delete', ['account' => $account->uuid]) }}"><i
                                                                                class="far fa-trash-alt"></i></button>
                                                                    @endif
                                                                </div>
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
                    }, 2000);
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Thông báo!',
                        text: error.message || '{{ __('messages.common_error') }}',
                        icon: error.status || 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    });
                },
            })
        }
    </script>
@endpush
