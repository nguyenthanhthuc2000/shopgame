@extends('layouts.app')

@section('title', 'Nick Ngọc Rồng Online Server ' . $account->server . '| NickDaoQuan.Vn')

@section('content')
    <div class="section-gap mt-5 pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="section-gap">
                    <div class="container">
                        <div class="row">
                            <h2 style="font-size: 24px; text-align: center;"><span>THÔNG TIN TÀI KHOẢN </span><span style="color:#e7505a;">#{{ $account->id }}</span></h2>
                            <div class="col-lg-7 col-12 mb-3">
                                <div class="game-images">
                                    <div class="nick-avatar_photo" id="detail-avatar_photo">
                                        <div class="preview-avatar_photo__item mb-3">
                                            @if ($account->images->isNotEmpty())
                                                <img src="{{ $account->images[0]->image_link }}&sz=w1000"
                                                class="img-fluid object-fit-cover" alt="Nick Ngọc Rồng Online VIP giá rẻ, NickDaoquan.Vn, Shop Nick Ngọc Rồng"
                                                loading="lazy">
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="game-images_thumb" id="detail-avatar_thumb">
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($account->images as $key => $image)
                                                <div class="item">
                                                    <img src="{{ $image->image_link }}&sz=w1000"
                                                        class="img-fluid object-fit-cover thumb-image {{ $key === 0 ? 'active' : '' }}" alt="Nick Ngọc Rồng Online VIP giá rẻ, NickDaoquan.Vn, Shop Nick Ngọc Rồng"
                                                        loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="col-lg-5 col-12">
                                <div class="game-detail mb-3">
                                    <div class="game-detail_top">
                                        <div class="game-detail_category">
                                            Danh Mục: <a
                                                href="{{ route('category.index', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                        </div>
                                    </div>
                                    <div class="game-detail_bottom">
                                        <div class="game-detail_price">
                                            <div class="game-detail_price--item">
                                                CARD
                                                <span>{{ number_format($account->price, 0, ',', '.') }}đ</span>
                                            </div>
                                            <div class="game-detail_price--item">
                                                ATM/MOMO
                                                <span>{{ number_format($account->price_atm, 0, ',', '.') }}đ</span>
                                            </div>
                                        </div>
                                        <div class="game-detail_meta">
                                            <div class="game-detail_meta--item">
                                                Server:
                                                <b>{{ $account->server }}</b>
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
                                        @if (!empty($account->note))
                                        <div class="desc mb-3">
                                            <b>Mô Tả</b>: <span class="">{{ $account->note }}</span>
                                        </div>
                                        @endif
                                        <div class="game-detail_buttons d-flex">
                                            <a href="{{ route('card.index') }}"
                                                class="game-detail_button game-detail_button--primary col-md-6 mb-2">
                                                Nạp thẻ cào
                                            </a>

                                            @if ($account->status === \App\Models\Account::STATUS_AVAILABLE)
                                                <a href="{{ route('account.buy', ['accountUuid' => $account->uuid]) }}"
                                                    class="game-detail_button game-detail_button--secondary col-md-6 mb-2">
                                                    Mua ngay
                                                </a>
                                            @else
                                                <a href="#"
                                                    class="game-detail_button game-detail_button--secondary col-md-6 mb-2">
                                                    Đã bán
                                                </a>
                                            @endif
                                            <br>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @foreach ($account->images as $key => $image)
                                <div class="mb-3" style="text-align: center;">
                                    <img src="{{ $image->image_link }}&sz=w1000"
                                        class="img-fluid object-fit-cover {{ $key === 0 ? 'active' : '' }}" alt="Nick Ngọc Rồng Online VIP giá rẻ, NickDaoquan.Vn, Shop Nick Ngọc Rồng"
                                        loading="lazy">
                                </div>
                            @endforeach
                            @if ($accountRefs->isNotEmpty())
                                <h3 style="font-size: 24px; text-align: center;" class="mt-80"><span>TÀI KHOẢN LIÊN QUAN </span></h3>
                                <div class="row">
                                    @foreach ($accountRefs as $account)
                                        <div class="col-xl-3 col-lg-4 col-md-6 text-center mb-4">
                                            <div class="bt-card-ui-3 account">
                                                <div class="card-image">
                                                    <img src="{{ $account->banner->image_link ?? "" }}&amp;sz=w1000" class="img-fluid object-fit-cotain clickable-image" alt="Image" style="object-fit: contain;" loading="lazy">
                                                    <span class="ms">Mã số: #{{ $account->id}}</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row" style="font-size: 14px;">
                                                        <div class="col-6 a_att">
                                                            Máy chủ: <b>Server {{ $account->server}}</b>
                                                        </div>
                                                        <div class="col-6 a_att">
                                                            Hành tinh: <b>{{ $account->class_name }}</b>
                                                        </div> 
                                                        <div class="col-6 a_att">
                                                            Đăng ký: <b>{{ $account->regis_type_name }}</b>
                                                        </div>
                                                        <div class="col-6 a_att">
                                                            Bông tai: <b>{{ $account->earring_name }}</b>
                                                        </div>
                                                    </div>
                    
                                                    <div class="card-btn-wrap">
                                                        <a href="#" class="card-btn card-btn--book">
                                                            {{ number_format($account->price_atm, 0, ',', '.') }} đ
                                                        </a>
                                                        <a href="{{ route('account.show', ['categorySlug' => $category->slug,'accountUuid' => $account->uuid]) }}" class="card-btn card-btn--more">
                                                            Chi Tiết
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
                nav: true, 
            });

            $(".thumb-image").on("click", function() {
                $(".thumb-image").removeClass('active');
                const selectedImageSrc = $(this).attr("src");
                $("#detail-avatar_photo img").attr("src", selectedImageSrc);
                $(this).addClass('active');
            });
        });
    </script>
@endpush
