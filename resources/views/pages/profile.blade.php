@extends('layouts.app')

@section('title', 'Thông tin tài khoản | NickDaoQuan.Vn')

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
                                <div class="panel">
                                    <div class="panel">
                                        <div class="col-sm-12 text-center">
                                            <h1 style="font-size: 26px;">THÔNG TIN TÀI KHOẢN</h1>
                                        </div>
                                    </div>
                                    <div class="content_post">
                                        <div class="row" style="justify-content: center;">
                                            <div class="col-lg-4 col-12">
                                            </div>
                                            <div class="col-lg-8 col-12">
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Tên tài khoản:
                                                        </span>
                                                        <span class="col-8 control-label al bb">{{ auth()->user()->name }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Email:</span>
                                                        <span
                                                            class="col-8 control-label al">{{ auth()->user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Mật khẩu:</span>
                                                        <span class="col-8 control-label al">**********</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Số dư:</span>
                                                        <span class="col-8 control-label al bb"
                                                            style="color:#d70f0f;">{{ number_format(auth()->user()->buyer_vnd, 0, ',', '.') }}
                                                            - VNĐ</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Ngày tham gia:
                                                        </span>
                                                        <span
                                                            class="col-8 control-label al">{{ auth()->user()->created_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 header-title-buy">
                                        <div style=" padding: 20px 15px 20px 15px;background: #AFD275;">
                                            <p class="mb-0" style="text-align:center"><strong><span
                                                        style="color:#e74c3c"><span style="font-size:20px">Cảm ơn bạn đã tin
                                                            tưởng ủng hộ nickdaoquan.vn</span></strong></p>
                                        </div>
                                        <br>
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
