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
                                    <h1 style="font-size: 26px;">LỊCH SỬ BÁN NICK</h1>
                                </div>
                                <div class="d-flex justify-content-end my-3">
                                    <form action="{{ route('account.sell.history') }}" method="get" autocomplete="off" novalidate>
                                        <div class="input-group w-100">
                                            <input type="text" name="account_id" id="searchInput" class="form-control"
                                                placeholder="Tìm kiếm mã số..." aria-label="Search" value="{{ request('account_id') }}"
                                                aria-describedby="searchIcon">
                                            <span class="input-group-text" id="searchIcon">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    @auth
                                        <div id="accountList" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="min-width: 50px;">Mã Nick</th>
                                                        <th scope="col" style="min-width: 150px;">Game</th>
                                                        <th scope="col" style="min-width: 70px;">Giá</th>
                                                        <th scope="col" style="min-width: 70px;">Thực Nhận</th>
                                                        <th scope="col" style="min-width: 60px;">Chiếc Khấu</th>
                                                        <th scope="col" style="min-width: 60px;">Trước GD</th>
                                                        <th scope="col" style="min-width: 60px;">Sau GD</th>
                                                        <th scope="col" style="min-width: 60px;">Ngày Tạo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($accounts as $account)
                                                        <tr>
                                                            <td>#{{ $account->account_id }}</td>
                                                            <td>{{ $account->account->category->name }}</td>
                                                            <td>{{ getPrice($account->price) }}</td>
                                                            <td>{{ getPrice($account->seller_profit) }}</td>
                                                            <td>{{ $account->profit_rate }}%</td>
                                                            <td>{{ getPrice($account->seller_vnd_before) }}</td>
                                                            <td>{{ getPrice($account->seller_vnd_after) }}</td>
                                                            <td>{{ date('d/m/Y H:i', strtotime($account->created_at)) }}</td>
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
