@extends('layouts.app')

@section('title', 'Danh Mục Game | NickDaoQuan.VN Shop Nick Ngọc Rồng Online Giá Rẻ, Uy Tín')

@section('content')

    <div class="product-section mt-150 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h3 id="categories"><span class="orange-text">DANH MỤC</span> GAME </h3>
                        <p class="m-auto"><b>Shop NickDaoQuan.Vn</b> luôn cập nhật liên tục cho các bạn có thể lựa
                            chọn.<br>Các bạn có thể
                            liên hệ qua <b><a href="https://zalo.me/0389946423" target="_blank">Zalo</a></b>
                            hoặc <b><a href="https://www.facebook.com/nguyenthanhthuc.2k/" target="_blank">Facebook</a></b> để
                            được hổ trợ nhanh chóng (19h-24h thứ 2 đến thứ 6, cuối tuần cả ngày).</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-4 col-6 text-center">
                        <div class="single-card-item">
                            <div class="category__banner mb-2">
                                <a href="/">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->title }}" loading="lazy">
                                </a>
                            </div>
                            <h2 class="category__title mb-0">{{ $category['name'] ?? '' }}</h2>
                            <p class="mb-1 category-total">Đang bán: <b>{{ $category->sold_count }}</b></p>
                            {{-- <p class="mb-2 category-total">Đã bán: <b>{{ $category->unsold_count }}</b></p> --}}
                            <div class="mb-3 buy-btn">
                                <a href="{{ route('category.index', ['category' => $category->slug]) }}">
                                    <img src="{{ asset('assets/images/buy-now.png') }}" class="buy-img" alt="Mua ngay" loading="lazy">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
