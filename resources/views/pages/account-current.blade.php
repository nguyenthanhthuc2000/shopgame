@extends('layouts.app')

@section('title', 'Lịch Sử Mua Nick | NickDaoQuan.Vn')

@section('content')
    <div class="list-section app-sub-menu" style="padding-top: 130px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="row-flex-safari game-list">
                    <section id="cardbody" class="section">
                        <div class="row">
                            {{-- LEFT MENU --}}
                            @include('components.app-sub-menu')
                            {{-- END LEFT MENU --}}

                            <div class="col-xs-12 col-md-9">
                                <div class="col-sm-12 text-center">
                                    <h1 style="font-size: 26px;">TÀI KHOẢN NGỌC RỒNG</h1>
                                </div>
                                <div class="">
                                    @auth
                                        <div id="historyCard" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="min-width: 200px;">Tài Khoản</th>
                                                        <th scope="col" style="min-width: 200px;">Mật Khẩu</th>
                                                        <th scope="col" style="min-width: 70px;">Sửa</th>
                                                        <th scope="col" style="min-width: 70px;">Xóa</th>
                                                        <th scope="col" style="min-width: 60px;">Trạng Thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse($accountTrans as $index => $accountTran)
                                                        <tr>
                                                            <td>{{ $accountTran->uuid }}</td>
                                                            <td>#{{ $accountTran->account_id }}</td>
                                                            <td style="min-width: 200px;">#{{ $accountTran->account->username }}
                                                            </td>
                                                            <td style="min-width: 100px;">#{{ $accountTran->account->password }}
                                                            </td>
                                                            <td style="min-width: 200px;">
                                                                #{{ $accountTran->account->category->name }}</td>
                                                            <td style="min-width: 100px;">
                                                                {{ number_format($accountTran->price, 0, ',', '.') }}</td>
                                                            <td style="min-width: 100px;">
                                                                {{ date('d/m/Y H:i', strtotime($accountTran->created_at)) }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">Không tìm thấy lịch sử mua
                                                                nick</td>
                                                        </tr>
                                                    @endforelse --}}
                                                </tbody>
                                            </table>
                                        </div>
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
