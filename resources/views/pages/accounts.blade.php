@extends('layouts.app')

@section('title', $category->name . ' - NickDaoQuan.Vn')

@section('content')
    <div class="product-section mt-150 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Danh sách</span> {{ $category->name }}</h3>
                    </div>
                </div>
            </div>

            <div class="alert-custom alert alert-success">
                <p class="mb-0"><strong>Nạp từ ATM/MOMO vào shop cộng thêm 20% giá trị</strong> <a
                        href="{{ route('home.deposit') }}">tại đây <img src="{{ asset('assets/images/hot.gif') }}"
                            alt="nickdaoquan.vn"></a> (nạp 100k nhận 115k)</p>

                <p class="mb-0"><strong>Chú ý:&nbsp;Sau khi mua tài khoản thành công, bạn hãy thực hiện đổi mật
                        khẩu</strong></p>

                <p class="mb-0">Link đổi mật khẩu:&nbsp;<a
                        href="https://forum.ngocrongonline.com/app/?for=event&do=changepass">https://forum.ngocrongonline.com/app/?for=event&do=changepass</a>
                </p>

                <p class="mb-0">Liên hệ nhập acc giá cao <a
                        href="https://www.facebook.com/profile.php?id=61569589252659">tại đây <img
                            src="{{ asset('assets/images/hot.gif') }}" alt="nickdaoquan.vn"></a></a></p>
            </div>

            <div class="row mb-4">
                @include('components.search-product')
            </div>
            <div class="row">
                @foreach ($accounts as $account)
                    <div class="col-xl-3 col-lg-4 col-md-6 text-center mb-4">
                        <div class="bt-card-ui-3 account">
                            <div class="card-image">
                                <img src="{{ $account->banner->image_link ?? '' }}&amp;sz=w1000"
                                    class="img-fluid object-fit-cotain clickable-image" alt="{{ $account->uuid }}"
                                    style="object-fit: contain;" loading="lazy">
                                <span class="ms">Mã số: {{ $account->id }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row" style="font-size: 14px;">
                                    <div class="col-6 a_att">
                                        Máy chủ: <b>Server {{ $account->server }}</b>
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
                                    <a href="{{ route('account.show', ['category' => $category->slug, 'account' => $account->uuid]) }}"
                                        class="card-btn card-btn--more">
                                        Chi Tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="ms-auto">
                {{ $accounts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
