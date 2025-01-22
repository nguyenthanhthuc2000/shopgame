<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="mdl-js">

<head>
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
    {{-- CKEditor --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5V70YRDLZB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5V70YRDLZB');
        </script>
        <script type="text/javascript">
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "pdc7ubacnv");
    </script>
    @include('components.style')
    @vite(['resources/sass/app.scss'])
    @stack('css')
</head>

<body>
    <div class="loader">
        <div class="loader-inner">
        </div>
    </div>

    @include('layouts.app-menu')

    @include('components.slideshow')

    @yield('content')

    @include('layouts.app-footer')

    @include('components.script')

    @stack('js')
</body>
