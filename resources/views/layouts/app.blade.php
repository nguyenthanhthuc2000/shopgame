<!DOCTYPE html>
<html lang={{ config('app.locale') }} class="mdl-js">

<head>
    <base href={{ config('app.url') }}>
    <meta charset="utf-8">
    <title>@yield('title', 'NickDaoQuan.VN | Shop Nick Ngọc Rồng Online Giá Rẻ, Uy Tín')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="description" content="NickDaoQuan.vn - Shop bán nick game online uy tín, giá rẻ. Tài khoản game chất lượng với đầy đủ tựa game hot như Ngọc Rồng Online, Liên Quân Mobile. Hỗ trợ giao dịch nhanh chóng, bảo hành uy tín.">
    <meta name="keywords"content="shop nick game, nickdaoquan.vn, mua bán tài khoản game, nick game giá rẻ, shop game uy tín, bán nick game online">
    <meta name="author" content="Nguyễn Thành Thức">
    <meta property="og:title" content="Mua Nick Ngọc Rồng Online Giá Rẻ - nickdaoquan.vn">
    <meta property="og:description" content="Shop nick Ngọc Rồng Online giá rẻ, đầy đủ sức mạnh, giao dịch nhanh chóng, bảo hành uy tín tại nickdaoquan.vn.">
    <meta property="og:image" content="{{ asset('assets/images/avatar.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    @include('components.style')
    @vite(['resources/sass/app.scss'])
    @stack('css')
</head>

<body>
    <div class="snow-container"></div>
    <div class="loader" style="display: none;">
        <div class="loader-inner">
        </div>
    </div>

    @include('layouts.app-menu')
    @include('components.slideshow')

    @yield('content')

    @include('layouts.app-footer')

    @include('components.script')

    @stack('js')

    

    <script>
        $(document).ready(function () {
            $('.homepage-bg-1').css(
                'background-image',
                'url("'+ "{{ asset('assets/images/homepage-bg-1.jpg') }}" +'")'
            );
        });

        const styleElement = document.createElement('style');
        styleElement.textContent = `
        .snow-container {
            position: fixed;
            width: 100%;
            max-width: 100%;
            z-index: 99999;
            pointer-events: none;
            overflow: hidden;
            top: 0;
            height: 100%;
        }
        .snow {
            display: block;
            position: absolute;
            z-index: 2;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            pointer-events: none;
            -webkit-transform: translate3d(0,-100%,0);
            transform: translate3d(0,-100%,0);
            -webkit-animation: snow linear infinite;
            animation: snow linear infinite;
        }
        .snow.foreground {
            background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
            -webkit-animation-duration: 15s;
            animation-duration: 10s;
        }
        .snow.foreground.layered {
            -webkit-animation-delay: 7.5s;
            animation-delay: 7.5s;
        }
        .snow.middleground {
            background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
            -webkit-animation-duration: 20s;
            animation-duration: 15s;
        }
        .snow.middleground.layered {
            -webkit-animation-delay: 10s;
            animation-delay: 10s;
        }
        .snow.background {
            background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
            -webkit-animation-duration: 25s;
            animation-duration: 20s;
        }
        .snow.background.layered {
            -webkit-animation-delay: 12.5s;
            animation-delay: 12.5s;
        }
        @-webkit-keyframes snow {
            0% { -webkit-transform: translate3d(0,-100%,0); transform: translate3d(0,-100%,0); }
            100% { -webkit-transform: translate3d(5%,100%,0); transform: translate3d(5%,100%,0); }
        }
        @keyframes snow {
            0% { -webkit-transform: translate3d(0,-100%,0); transform: translate3d(0,-100%,0); }
            100% { -webkit-transform: translate3d(5%,100%,0); transform: translate3d(5%,100%,0); }
        }
        `;

        // Append the <style> element to the <head>
        document.head.appendChild(styleElement);

        // Create the snow container div
        const snowContainer = document.createElement('div');
        snowContainer.className = 'snow-container';
        snowContainer.innerHTML = `
        <div class="snow foreground"></div>
        <div class="snow foreground layered"></div>
        <div class="snow middleground"></div>
        <div class="snow middleground layered"></div>
        <div class="snow background"></div>
        <div class="snow background layered"></div>
        `;

        // Append the snow container to the body
        document.body.appendChild(snowContainer);

    </script>
</body>
