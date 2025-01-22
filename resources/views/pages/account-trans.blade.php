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
                            <div class="col-xs-12 col-md-3">
                                @include('components.app-sub-menu')
                            </div>
                            {{-- END LEFT MENU --}}
                            <div class="col-xs-12 col-md-9">
                                @include('components.admin.alert')
                                <div class="col-sm-12 text-center">
                                    <h1 style="font-size: 26px;">LỊCH SỬ MUA NICK GAME</h1>
                                </div>
                                <div class="">
                                    @auth
                                        <div class="panel-heading clearfix text-center"
                                            style="color: #fdfdfd; background: #AFD275; padding: 10px 15px;">
                                            <span class="t24 bb" style=""><b>LỊCH SỬ MUA NICK GAME</b></span>
                                        </div>
                                        <div id="historyCard" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="min-width: 100px;">Mã Nick</th>
                                                        <th scope="col" style="min-width: 200px;">Tài Khoản</th>
                                                        <th scope="col" style="min-width: 100px;">Mật Khẩu</th>
                                                        <th scope="col" style="min-width: 200px;">Loại</th>
                                                        <th scope="col" style="min-width: 100px;">Giá</th>
                                                        <th scope="col" style="min-width: 100px;">Trước GD</th>
                                                        <th scope="col" style="min-width: 100px;">Sau GD</th>
                                                        <th scope="col" style="min-width: 100px;">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($accountTrans as $index => $accountTran)
                                                        <tr>
                                                            <td><a href="{{ route('account.show', ['category' => $accountTran->account->category->slug, 'account' => $accountTran->account->uuid]) }}">#{{ $accountTran->account_id }}</a></td>
                                                            <td style="min-width: 200px;">
                                                                {{ $accountTran->account->username }}</td>
                                                            <td style="min-width: 100px;">
                                                                {{ $accountTran->account->password }}</td>
                                                            <td style="min-width: 200px;">
                                                                <a href="{{ route('category.index', ['category' => $accountTran->account->category->slug]) }}">{{ $accountTran->account->category->name }}</a>
                                                            </td>
                                                            <td style="min-width: 100px;">
                                                                {{ number_format($accountTran->price, 0, ',', '.') }}
                                                            </td>
                                                            <td style="min-width: 100px;">
                                                                {{ number_format($accountTran->buyer_vnd_before, 0, ',', '.') }}
                                                            </td>
                                                            <td style="min-width: 100px;">
                                                                {{ number_format($accountTran->buyer_vnd_after, 0, ',', '.') }}
                                                            </td>
                                                            <td style="min-width: 100px;">
                                                                {{ date('d/m/Y H:i', strtotime($accountTran->created_at)) }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">Không tìm thấy lịch sử mua nick</td>
                                                        </tr>
                                                    @endforelse
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
    </div>
@endsection
