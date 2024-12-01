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
                                        <div class="preview-avatar_photo__item mb-3">
                                            <img src="{{ $account->images[0]->image_link }}&sz=w1000"
                                                class="img-fluid object-fit-cover thumb-image" alt="Preview Image"
                                                loading="lazy">
                                        </div>
                                    </div>
                                    <div class="game-images_thumb" id="detail-avatar_thumb">
                                        <!-- Owl Carousel -->
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($account->images as $image)
                                                <div class="item">
                                                    <img src="{{ $image->image_link }}&sz=w1000"
                                                        class="img-fluid object-fit-cover thumb-image" alt="Preview Image"
                                                        loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-6">
                                <div class="game-detail">
                                    <div class="game-detail_top">
                                        <div class="game-detail_code">
                                            Mã số: <b>#{{ $account->id }}</b>
                                        </div>
                                        <div class="game-detail_category">
                                            Danh Mục: <a
                                                href="{{ route('category.index', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                        </div>
                                    </div>
                                    <div class="game-detail_bottom">
                                        <div class="game-detail_price">
                                            <div class="game-detail_price--item">
                                                Giá thẻ cào
                                                <span>{{ number_format($account->price, 0, ',', '.') }}đ</span>
                                            </div>
                                            <div class="game-detail_price--item">
                                                Giá ATM/Momo
                                                <span>{{ number_format($account->price_atm, 0, ',', '.') }}đ</span>
                                            </div>
                                        </div>
                                        <div class="game-detail_meta">
                                            <div class="game-detail_meta--item">
                                                Máy chủ:
                                                <b>Server {{ $account->server }}</b>
                                            </div>
                                            <div class="game-detail_meta--item">
                                                Hành tinh:
                                                <b>{{ $account->class_name }}</b>
                                            </div>
                                            <div class="game-detail_meta--item">
                                                Bông tai:
                                                <b>{{ $account->earring_name }}</b>
                                            </div>
                                            <div class="game-detail_meta--item">
                                                Đăng ký:
                                                <b>{{ $account->regis_type_name }}</b>
                                            </div>
                                        </div>
                                        <div class="game-detail_buttons d-flex">
                                            <a href="{{ route('card.index') }}"
                                                class="game-detail_button game-detail_button--primary col-md-6 mb-2">
                                                Nạp thẻ cào
                                            </a>
                                            <a href="{{ route('account.buy', ['accountUuid' => $account->uuid]) }}"
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
@push('js')
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                dots: true,
            });

            $(".thumb-image").on("click", function() {
                const selectedImageSrc = $(this).attr("src");
                $("#detail-avatar_photo img").attr("src", selectedImageSrc);
            });
        });
    </script>
@endpush
