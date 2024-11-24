@extends('layouts.app')

@section('title', 'NickDaoQuan.VN | Shop Nick Ngọc Rồng Online Giá Rẻ, Uy Tín')

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
                            <p>Shop NickDaoQuan.vn luôn đặt uy tín và sự tin tưởng của khách hàng lên hàng đầu.</p>
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
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h3 id="categories"><span class="orange-text">Danh Mục</span> Game </h3>
                        <p class="m-auto"><b>Shop NickDaoQuan.Vn</b> luôn cập nhật liên tục cho các bạn có thể lựa chọn.<br>Các bạn có thể
                            liên hệ qua <b>Zalo <a href="https://zalo.me/0389946423" target="_blank">0389.946.423</a></b>
                            hoặc <b>FB <a href="https://www.facebook.com/nguyenthanhthuc.2k/" target="_blank">Nguyễn Thành Thức</a></b> để
                            được hổ trợ nhanh chóng (19h-24h thứ 2 đến thứ 6, cuối tuần cả ngày).</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($accountsList as $account)
                    <div class="col-lg-4 col-md-6 text-center">
                        @include('components.product-card', $account)
                    </div>
                @endforeach
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
