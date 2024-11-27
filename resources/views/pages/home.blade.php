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
                        <p class="m-auto"><b>Shop NickDaoQuan.Vn</b> luôn cập nhật liên tục cho các bạn có thể lựa
                            chọn.<br>Các bạn có thể
                            liên hệ qua <b>Zalo <a href="https://zalo.me/0389946423" target="_blank">0389.946.423</a></b>
                            hoặc <b>FB <a href="https://www.facebook.com/nguyenthanhthuc.2k/" target="_blank">Nguyễn Thành
                                    Thức</a></b> để
                            được hổ trợ nhanh chóng (19h-24h thứ 2 đến thứ 6, cuối tuần cả ngày).</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="5G0ld.html"><img src="{{ asset('assets/images/avatar.jpg') }}" alt=""
                                        loading="lazy"></a>
                            </div>
                            <h3><b>Danh mục:</b> {{ $category['name'] ?? '' }}</h3>
                            <p>Đang bán :xxx</p>
                            <p>Đã bán :xxx</p>
                            <a href="{{ route('accounts.list', $category['id']) }}" class="cart-btn"><i
                                    class="fas fa-shopping-cart"></i> XEM THÊM</a>
                            <a href="{{ route('product.show', ['slug', 'uuid']) }}">
                                View Product
                            </a>
                        </div>
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

    <div class="latest-news mt-80 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">BLOG</span> NickDaoQuan.VN</h3>
                        <p class="m-auto">Trang <b>Blog NickDaoQuan.VN</b> cập nhập thông tin và hướng dẫn về game cũng như
                            các tính năng của game. Trang Blog được xây dựng dựa trên các câu hỏi mà khách hàng hay gặp cũng
                            như thu thập ý kiến của mọi người.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                    <div class="single-latest-news">
                        <a href="/" target="_blank">
                            <img style="width: 100%;height: 200px; object-fit: cover;"
                                src="{{ asset('assets/images/avatar.jpg') }}" alt="">
                        </a>
                        <div class="news-text-box">
                            <h3><a href="/" target="_blank">Luyện Rồng Nguyên Tố là gì?</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Quốc Ngân </span>
                                <span class="date"><i class="fas fa-calendar"></i> 28 / 01 / 2023</span>
                            </p>
                            <p class="excerpt">Luyện Rồng Nguyên Tố là chức năng được ra mắt vào ngày 24 / 02 / 2022 với sự
                                nâng cấp từ chú Rồng Tí Nị.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <a href="/" target="_blank">
                            <img style="width: 100%;height: 200px; object-fit: cover;"
                                src="{{ asset('assets/images/avatar.jpg') }}" alt="" loading="lazy">
                        </a>
                        <div class="news-text-box">
                            <h3><a href="/" target="_blank">Trứng Rồng để làm gì?</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Quốc Ngân </span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 / 01 / 2023</span>
                            </p>
                            <p class="excerpt">Trứng Rồng là vật phẩm được ra mắt vào ngày 31/12/2020 và được đổi lần đầu
                                tiên tại Sự Kiện Giáng Sinh 2020.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <a href="/" target="_blank">
                            <img style="width: 100%;height: 200px; object-fit: cover;"
                                src="{{ asset('assets/images/avatar.jpg') }}" alt="" loading="lazy">
                        </a>
                        <div class="news-text-box">
                            <h3><a href="/" target="_blank">Đá Ngũ Hành để làm gì?</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Quốc Ngân </span>
                                <span class="date"><i class="fas fa-calendar"></i> 26 / 01 / 2023</span>
                            </p>
                            <p class="excerpt">Đá Ngũ Hành là loại đá xuất hiện lần đầu trong game Avatar vào ngày
                                09/06/2020 với nhiều chức năng và công dụng khác nhau.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <a href="/" class="boxed-btn mt-0">Xem Thêm Tin Tức</a>
                </div>
            </div>
        </div>
    </div>
@endsection
