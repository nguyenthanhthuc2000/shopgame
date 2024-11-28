@extends('layouts.app')

@section('title', 'Detail')
@section('content')
    <div class="section-gap mt-5 pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="section-gap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 mb-3">
                                <div class="game-images">
                                    <div class="nick-avatar_photo" id="detail-avatar_photo">
                                        <div class="preview-avatar_photo__item">
                                            <span class="ratio ratio-1x1">
                                                <img src="https://drive.google.com/thumbnail?id=10mnwAT8jIRjCKwTqSG_xswjglpt4MTQl&sz=w1000"
                                                    class="img-fluid object-fit-cotain clickable-image" alt="Image"
                                                    style="object-fit: contain;" loading="lazy">
                                                {{-- <img src="https://nick24s.com/storage/nicks/8346/501871-Screenshot 2024-11-18 220032.png"
                                                    class="img-fluid object-fit-cover clickable-image" alt="Image"
                                                    loading="lazy"> --}}
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

                            <div class="col-lg-5 col-md-6">
                                <div class="game-detail">
                                    <div class="game-detail_top">
                                        <div class="game-detail_code">
                                            Mã Số: #{{ $account->id }}
                                        </div>
                                        <div class="game-detail_category">
                                            Danh Mục: <a href="{{ route('category.list', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                        </div>
                                    </div>
                                    <div class="game-detail_bottom">
                                        <div class="game-detail_price">
                                            <div class="game-detail_price--item">
                                                Giá thẻ cào
                                                <span>{{ number_format($account->price, 0, ',', '.') }}đ</span>
                                            </div>
                                            <div class="game-detail_price--item">
                                                Giá ATM/MOMO
                                                <span>{{ number_format($account->price_atm, 0, ',', '.') }}đ</span>
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
                                        <div class="game-detail_buttons d-flex">
                                            <a href="https://nick24s.com/deposit/card"
                                                class="game-detail_button game-detail_button--primary col-md-6 mb-2">
                                                Nạp thẻ cào
                                            </a>
                                            <a href="https://nick24s.com/nick/ngoc-rong-online/101150/buynow"
                                                class="game-detail_button game-detail_button--secondary col-md-6 mb-2">
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
