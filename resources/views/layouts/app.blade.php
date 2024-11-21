<!DOCTYPE html>
<html lang={{ config('app.locale') }} class="mdl-js">

<head>
    <base href={{ config('app.url') }}>
    <meta charset="utf-8">
    <meta name="download_date" content="2024-11-15T16:50:50.923Z" />
    <title>@yield('title', 'AvatarQN - Shop Nick AVATAR')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/sass/app.scss'])
    @yield('css')
</head>

<body>
    <div class="snow-container"></div>
    <div class="loader" style="display: none;">
        <div class="loader-inner">
        </div>
    </div>

    @include('components.slideshow')

    @include('components.menu')

    @yield('content')

    @include('components.script')

    @yield('js')
</body>
