@extends('layouts.app')

@section('title', 'Detail')
<style>
    /* Bố cục tổng thể */
    .col-lg-5 .game-detail {
        background: #fff;
        /* Nền trắng */
        border: 1px solid #ddd;
        /* Viền mờ */
        border-radius: 8px;
        /* Bo góc */
        padding: 20px;
        /* Khoảng cách trong */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Đổ bóng */
    }

    /* Phần đầu (Top Section) */
    .game-detail_top {
        margin-bottom: 15px;
        /* Khoảng cách dưới */
    }

    .game-detail_code b {
        color: #e74c3c;
        /* Mã số màu đỏ */
        font-size: 18px;
        /* Kích thước chữ */
    }

    .game-detail_category a {
        color: #3498db;
        /* Màu xanh */
        text-decoration: none;
    }

    .game-detail_category a:hover {
        text-decoration: underline;
    }

    /* Phần giá (Bottom Section) */
    .game-detail_price {
        margin-bottom: 20px;
    }

    .game-detail_price--item span {
        font-weight: bold;
        font-size: 18px;
        color: #27ae60;
        /* Màu xanh lá */
    }

    /* Thông tin meta */
    .game-detail_meta {
        margin-bottom: 20px;
    }

    .game-detail_meta--item b {
        font-size: 16px;
        color: #2c3e50;
        /* Màu đậm */
    }

    /* Nút hành động */
    .game-detail_buttons a {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        margin-right: 10px;
        transition: all 0.3s ease-in-out;
    }

    .game-detail_button--primary {
        background: #e74c3c;
        color: #fff;
        text-decoration: none;
    }

    .game-detail_button--primary:hover {
        background: #c0392b;
    }

    .game-detail_button--secondary {
        background: #3498db;
        color: #fff;
        text-decoration: none;
    }

    .game-detail_button--secondary:hover {
        background: #2980b9;
    }
</style>
@section('content')

    <div class="section-gap">
        <div class="container">
            <div class="row">
                <div class="section-gap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="game-images">
                                    <div class="nick-avatar_photo" id="detail-avatar_photo">
                                        <div class="preview-avatar_photo__item">
                                            <span class="ratio ratio-1x1">
                                                <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                                    class="img-fluid object-fit-cover clickable-image" alt="Image"
                                                    loading="lazy">
                                            </span>
                                            {{-- <a href="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                                data-index="01" data-fancybox="game-images" class="stretched-link"
                                                loading="lazy">
                                            </a> --}}
                                        </div>
                                    </div>
                                    <div class="game-images_thumb" id="detail-avatar_thumb">
                                        <!-- Owl Carousel -->
                                        <div class="owl-carousel owl-theme">
                                            <div class="item">
                                                <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                                    class="img-fluid object-fit-cover thumb-image" alt="Preview Image 1"
                                                    loading="lazy">
                                            </div>
                                            <div class="item">
                                                <img src="https://nick24s.com/storage/nicks/8346/screenshot-2024-11-26-195417-6745c55c8ecbe.png"
                                                    class="img-fluid object-fit-cover thumb-image" alt="Preview Image 2"
                                                    loading="lazy">
                                            </div>
                                            <!-- Thêm các ảnh khác nếu cần -->
                                        </div>
                                    </div>
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
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".thumb-image").on("click", function() {
            const selectedImageSrc = $(this).attr("src");
            $("#detail-avatar_photo img").attr("src", selectedImageSrc);
        });
    });
</script>
