@extends('layouts.app')

@section('title', 'Trang Chủ | NickDaoQuan.VN Shop Nick Ngọc Rồng Online Giá Rẻ, Uy Tín')

@section('content')
    {{-- product section --}}
    <div class="product-section mt-80 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="mb-3">
                        <h3 id="categories"><span class="orange-text">DANH MỤC</span> GAME </h3>
                        <p class="m-auto"><b>Shop NickDaoQuan.Vn</b> luôn cập nhật liên tục cho các bạn có thể lựa chọn.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-4 col-6 text-center">
                        <div class="single-card-item">
                            <div class="category__banner mb-2">
                                <a href="{{ route('category.index', ['category' => $category->slug]) }}">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->title }}" loading="lazy">
                                </a>
                            </div>
                            <h2 class="category__title mb-0">{{ $category['name'] ?? '' }}</h2>
                            <p class="mb-1 category-total">Đang bán: <b>{{ $category->sold_count }}</b></p>
                            <div class="mb-3 buy-btn">
                                <a href="{{ route('category.index', ['category' => $category->slug]) }}">
                                    <img src="{{ asset('assets/images/buy-now.png') }}" class="buy-img" alt="Mua ngay"
                                        loading="lazy">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="product-section mt-80 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="mb-3">
                        <h3 id="categories"><span class="orange-text">DỊCH VỤ</span> GAME </h3>
                    </div>
                </div>
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
        </div>
    </div>

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

    {{-- <div class="latest-news mt-80 mb-80">
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
        </div>
    </div> --}}
    <button type="button" class="btn btn-primary showPopup" data-toggle="modal" data-target="#exampleModal"hidden>
        Launch demo modal
    </button>

    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                </div>
                <div class="modal-body">
                    <p><strong>SĂN ĐỆ TỬ THUÊ SERVER 1 - 11 GIÁ 20K, SĂN CHO NICK SƠ SINH 30K <img src="{{ asset('assets/images/hot.gif') }}" alt="nickdaoquan.vn"></strong></p>

                    <p><strong><span>NHẬP NICK NGỌC RỒNG GIÁ CAO <img src="{{ asset('assets/images/hot.gif') }}" alt="nickdaoquan.vn"></span></strong></p>

                    <p><strong>NẠP ATM/MOMO 100K = 115K SHOP <a href="{{ route('home.deposit') }}">tại đây <img src="{{ asset('assets/images/hot.gif') }}" alt="nickdaoquan.vn"></a></strong></p>

                    <p><strong>ZALO: <a href="https://zalo.me/0389946423">038.9946.423</a></strong></p>

                    <p><strong>LƯU Ý: NẠP SAI MỆNH GIÁ THẺ SẼ BỊ TRỪ 50% TIỀN</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.showPopup').click();
        });
    </script>
@endpush
