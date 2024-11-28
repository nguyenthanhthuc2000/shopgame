@extends('layouts.app')

@section('title', 'Tai Khoản Ngọc Rồng | NickDaoQuan.Vn')

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
                                <div class="d-flex justify-content-end my-3">
                                    <div class="input-group w-50">
                                        <input type="text" id="searchInput" class="form-control"
                                            placeholder="Tìm kiếm tài khoản..." aria-label="Search"
                                            aria-describedby="searchIcon">
                                        <span class="input-group-text" id="searchIcon">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    @auth
                                        <div id="accountList" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Mã Nick</th>
                                                        <th scope="col" style="min-width: 200px;">Tài Khoản</th>
                                                        <th scope="col">Mật Khẩu</th>
                                                        <th scope="col" style="min-width: 70px;">Loại</th>
                                                        <th scope="col" style="min-width: 70px;">Giá</th>
                                                        <th scope="col" style="min-width: 60px;">Trạng Thái</th>
                                                        <th scope="col" style="min-width: 60px;">Ngày Tạo</th>
                                                        <th scope="col" style="min-width: 60px;">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($accounts as $account)
                                                        <tr>
                                                            <td>{{ $account->uuid }}</td>
                                                            <td>{{ $account->username }}</td>
                                                            <td>{{ $account->password }}</td>
                                                            <td>{{ $account->category->name ?? '' }}</td>
                                                            <td>{{ getPrice($account->price) }}</td>
                                                            <td>{{ config('account.account_status.' . $account->status) }}</td>
                                                            <td>{{ date('d/m/Y H:i', strtotime($account->created_at)) }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="" class="btn btn-danger">Xóa</a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <a href="{{ route('product.edit', $account->uuid ?? '#') }}"
                                                                            class="btn btn-warning">Sửa</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan=8" class="text-center">Không tìm thấy tài khoản</td>
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
