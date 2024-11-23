@extends('layouts.app')

@section('title', 'Detail')

@section('content')
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <div class="section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="game-images">
                        <div class="nick-avatar_photo" id="detail-avatar_photo">
                            <div class="preview-avatar_photo__item">
                                <span class="ratio ratio-1x1">
                                    <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                        class="img-fluid object-fit-cover" alt="">
                                </span>
                                <a href="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                    data-index="01" data-fancybox="game-images" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="game-images_thumb" id="detail-avatar_thumb">
                            <div class="owl-carousel owl-theme">
                                {{-- Ảnh --}}
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="preview-avatar_thumb__item">
                                    <div class="game-images position-relative ratio ratio-1x1">
                                        <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                            class="img-fluid object-fit-cover" alt="">
                                    </div>
                                </div>
                                {{-- ảnh --}}
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="game-detail">
                                <div class="game-detail_top">
                                    <div class="game-detail_code">
                                        Mã số: <b>#101150</b>
                                    </div>
                                    <div class="game-detail_category">
                                        Danh mục: <a href="https://nick24s.com/nick/ngoc-rong-online">NICK NRO TRUNG -
                                            VIP</a>
                                    </div>
                                </div>
                                <div class="game-detail_bottom">
                                    <div class="game-detail_price">
                                        <div class="game-detail_price--item">
                                            Giá thẻ cào
                                            <span>120,000đ</span>
                                        </div>
                                        <div class="game-detail_price--item">
                                            Giá ATM/Momo
                                            <span>99,000đ</span>
                                        </div>

                                    </div>
                                    <div class="game-detail_meta">
                                        <div class="game-detail_meta--item">
                                            Máy chủ:
                                            <b>5sao</b>
                                        </div>
                                        <div class="game-detail_meta--item">
                                            Hành tinh:
                                            <b>Nm</b>
                                        </div>
                                        <div class="game-detail_meta--item">
                                            Bông tai:
                                            <b>Có</b>
                                        </div>
                                        <div class="game-detail_meta--item">
                                            Đăng ký:
                                            <b>Ảo</b>
                                        </div>
                                    </div>
                                    <div class="game-detail_buttons">
                                        <a href="https://nick24s.com/deposit/card"
                                            class="game-detail_button game-detail_button--primary">
                                            Nạp thẻ cào
                                        </a>
                                        <a href="https://nick24s.com/nick/ngoc-rong-online/101150/buynow"
                                            class="game-detail_button game-detail_button--secondary">
                                            Mua ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
    </script>
@endsection
