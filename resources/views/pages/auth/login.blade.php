@extends('layouts.app')

@section('title', 'Đăng nhập')
@vite('resources/sass/pages/_login.scss')

@section('content')
<section id="login-form" class="mt-5">
    <h2 class="font-lg">Chào mừng bạn đến với <a href="{{ route('home') }}" class="font-lg">nickdaoquan.vn</a></h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('auth.register') }}" id="register-form" method="POST">
                <h1>Tạo tài khoản</h1>
                @csrf
                <div id="message_register"></div>
                <input type="text" placeholder="Tên" name="name" />
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Mật khẩu" name="password" />
                <input type="password" name="password_confirmation" placeholder="Nhập mật khẩu xác nhận" />
                <button class="mt-2">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ route('auth.login') }}" id="login-form" method="POST">
                <h1>Đăng nhập</h1>
                @csrf
                <div id="message_login"></div>
                <input type="email" name="email" placeholder="Nhập tài khoản" />
                <input type="password" name="password" placeholder="Nhập mật khẩu" />
                <button class="mt-2">Đăng Nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào bạn!</h1>
                    <p>Để giao dịch nhanh chóng tự động an toàn, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng Nhập Ngay</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu tìm nick ngon giá rẽ của chúng tôi.</p>
                    <button class="ghost" id="signUp">Đăng Ký Ngay</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@vite('resources/js/pages/login.js')
