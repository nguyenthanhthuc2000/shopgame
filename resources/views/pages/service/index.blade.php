@extends('layouts.app')

@section('title', 'Dịch vụ - NickDaoQuan.Vn')

@section('content')
    {{-- @dd($services) --}}
    <div class="product-section mt-150 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Danh sách</span> dịch vụ</h3>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                {{-- @include('components.search-product') --}}
            </div>

            <div class="row">
                @foreach ($services as $service)
                    <div class="col-lg-3 col-md-4 col-6 text-center">
                        <div class="single-card-item">
                            <div class="category__banner mb-2">
                                <a href="https://zalo.me/0389946423">
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" loading="lazy">
                                </a>
                            </div>
                            <h2 class="category__title mb-0">{{ $service->name }}</h2>
                            <div class="mb-3 buy-btn">
                                <a href="https://zalo.me/0389946423">
                                    <img src="{{ asset('assets/images/buy-now.png') }}" class="buy-img" alt="Mua ngay"
                                        loading="lazy">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="ms-auto">
                {{ $services->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
