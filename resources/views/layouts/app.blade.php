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
    {{-- @include('components.slideshow') --}}

    @yield('content')

    @include('layouts.app-footer')

    @include('components.script')

    @stack('js')
</body>
