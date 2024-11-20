@php
    $accountsList = [
        [
            'image' => '',
            'account_name' => 'account',
            'account_price' => '1',
        ],
        [
            'image' => '',
            'account_name' => 'account',
            'account_price' => '1',
        ],
        [
            'image' => '',
            'account_name' => 'account',
            'account_price' => '1',
        ],
    ];

@endphp

@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

    {{-- feature list section --}}
    <div class="list-section pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="content">
                            <h3>Uy Tín</h3>
                            <p>Shop AvatarQN luôn đặt uy tín và sự tin tưởng của khách hàng lên hàng đầu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-smile-beam"></i>
                        </div>
                        <div class="content">
                            <h3>Hài Lòng</h3>
                            <p>Các sản phẩm của Shop đều cam kết cho khách hàng sự hài lòng.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="content">
                            <h3>Nhanh Chóng</h3>
                            <p>Giao dịch nhanh chóng không làm mất thời gian của khách hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end feature list section --}}

    {{-- product section --}}
    <div class="product-section mt-80 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Nick</span> Avatar 2D </h3>
                        <p><b>Shop Nick Avatar 2D</b> luôn cập nhật liên tục cho các bạn có thể lựa chọn.<br>Các bạn có thể
                            liên hệ qua <b>Zalo <a href="https://zalo.me/0889694460" target="_blank">0889.69.4460</a></b>
                            hoặc <b>FB <a href="https://www.messenger.com/t/Hello.QN" target="_blank">Quốc Ngân</a></b> để
                            xem Nick mới nhất hoặc tìm kiếm các Nick đúng với yêu cầu cá nhân.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                    @foreach ($accountsList as $account)
                        @component('components.product-card', $account)
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="shop.html" class="boxed-btn">Xem Thêm Nick Avatar 2D</a>
                </div>
            </div>
        </div>
        </div>

        {{-- endproduct section --}}
    @endsection
