@extends('layouts.app')

@section('title', 'Nạp tiền ATM - Ví điện tử | NickDaoQuan.Vn')

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
                                <div class="panel">
                                    <div class="panel">
                                        <div class="col-sm-12 text-center">
                                            <h1 style="font-size: 26px;">NẠP TIỀN ATM - VÍ ĐIỆN TỬ</h1>
                                        </div>
                                    </div>
                                    <div class="content_post" style="text-align: center;">
                                        <div class="row" style="justify-content: center; gap: 10px">
                                            <div class="card" style="width: 20rem;">
                                                <img src="{{ asset('assets/bank/momo.png') }}"
                                                    style="width: 260px; height: 260px; padding: 8px; margin: auto;"
                                                    class="card-img-top" alt="nickdaoquan.vn nạp tiền">
                                                <div class="card-body" style="text-align: center;">
                                                    <h5 class="card-title">MOMO: 0389946423</h5>
                                                    <h5 class="card-title">Nguyễn Thành Thức</h5>
                                                </div>
                                            </div>
                                            <div class="card" style="width: 18rem;">
                                                <img src="{{ asset('assets/bank/mbbank.png') }}"
                                                    style="width: 260px; height: 260px; padding: 8px; margin: auto;"
                                                    class="card-img-top" alt="nickdaoquan.vn nạp tiền">
                                                <div class="card-body" style="text-align: center;">
                                                    <h5 class="card-title">MBBANK: 0389946423</h5>
                                                    <h5 class="card-title">Nguyễn Thành Thức</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 header-title-buy">
                                                <div style=" padding: 20px 15px 20px 15px;background: #AFD275;">
                                                    <p class="mb-0" style="text-align:center"><strong><span
                                                                style="color:#e74c3c"><span style="font-size:20px">NẠP
                                                                    TIỀN QUA ATM, MOMO CỘNG THÊM 20%<br>
                                                                    Nạp 100k được 120k</span></span></strong></p>
                                                    <b>Nội dung thanh toán: nap tien nickdaoquan - "tài khoản đăng nhập của
                                                        bạn"</b>
                                                    <br>
                                                    <b>Ví dụ: <span style="color: #e74c3c;">nap tien nickdaoquan -
                                                            thuc@gmail.com</span></b>
                                                    <br>
                                                    <b>Chuyển xong chụp lại màn hình và liên hệ zalo để được hổ trợ nhanh
                                                        nhất: <a href="https://zalo.me/0389946423"
                                                            style="color: #e74c3c !important;">0389.946.423</a></b>
                                                    <p class="mb-0" style="text-align:center"><strong><span
                                                                style="color:#e74c3c"><span style="font-size:20px">Cảm ơn
                                                                    bạn đã tin
                                                                    tưởng ủng hộ nickdaoquan.vn</span></strong></p>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
