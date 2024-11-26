@extends('layouts.app')

@section('title', 'Nạp thẻ cào | NickDaoQuan.Vn')

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
                                <div class="">
                                    <div class="panel">
                                        <div class="col-sm-12 text-center">
                                            <h1 style="font-size: 26px;">NẠP THẺ CÀO</h1>
                                        </div>
                                        <br>
                                        <form id="frmDonate" method="post" action="">
                                            <div class="row">
                                                <div class="col-md-12 text-center" style="padding-bottom: 20px;">
                                                    <div class="m-auto"
                                                        style="width: 300px;padding: 10px; background-color: #AFD275;border: 1px solid #d1ef33;margin-bottom: 30px;border-radius: 6px;">
                                                        <b class="t18" style="color:#ffffff;">SỐ DƯ: 0 VNĐ</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <spam class="col-md-2 control-label bb ar">Nhà mạng:</spam>
                                                            <div class="col-md-10">
                                                                <select class="form-control" data-live-search="true"
                                                                    id="Network" name="Network">
                                                                    <option value="">Chọn nhà mạng</option>
                                                                    <option value="VTT">Viettel</option>
                                                                    <option value="VNP">Vinaphone</option>
                                                                    <option value="VMS">Mobiphone</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <spam class="col-md-2 control-label bb ar">Mệnh giá:</spam>
                                                            <div class="col-md-10">
                                                                <select class="form-control t14" data-live-search="true"
                                                                    placeholder="Chọn mệnh giá" name="CardValue"
                                                                    id="CardValue">
                                                                    <option>Chọn mệnh giá</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <spam class="col-md-2 control-label bb ar">Số seri:</spam>
                                                            <div class="col-md-10">
                                                                <input type="text" name="NetworkSeri" id="NetworkSeri"
                                                                    class="form-control t14"
                                                                    placeholder="Nhập mã serial nằm sau thẻ" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <spam class="col-md-2 control-label bb ar">Mã thẻ: </spam>
                                                            <div class="col-md-10">
                                                                <input type="text" name="NetworkCode" id="NetworkCode"
                                                                    class="form-control t14"
                                                                    placeholder="Nhập mã số sau lớp bạc mỏng"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <spam class="col-md-2 control-label bb ar"></spam>
                                                            <div class="col-md-10">
                                                                <a href="/dang-nhap?refURL=/nap-tien"
                                                                    class="btn btn-danger col-xs-12 btn4">Đăng nhập để nạp
                                                                    thẻ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-12 header-title-buy">
                                                <div style=" padding: 20px 15px 20px 15px;background: #AFD275;">
                                                    <p class="mb-0" style="text-align:center"><strong><span
                                                                style="color:#e74c3c"><span style="font-size:20px">NẠP
                                                                    THẺ KHÔNG CHIẾT KHẤU<br>
                                                                    Nạp 10k được 10k ...100k được
                                                                    100k</span></span></strong></p>

                                                    <p style="text-align:center"><strong><span
                                                                style="color:#e74c3c"><span style="font-size:20px">SAI
                                                                    MỆNH GIÁ&nbsp;-50%
                                                                    THẺ</span></span></strong></p>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-heading clearfix text-center"
                                        style="color: #fdfdfd; background: #AFD275; padding: 10px 15px;">
                                        <span class="t24 bb" style=""><b>LỊCH SỬ NẠP THẺ</b></span>
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
