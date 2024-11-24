@php
    $menu = config('page.main_menu', []);
    $sticking = isHomePage() ? '' : ' is-sticky';
@endphp

<div id="sticker-sticky-wrapper" class="sticky-wrapper{{ $sticking }}">
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">

                        <div class="site-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <nav class="main-menu" style="display: block;">
                            <ul>
                                @foreach ($menu as $item)
                                    <li class="{{ isCurrentRoute($item['route_name']) ? 'current-list-item' : '' }}">
                                        <a
                                            href="{{ $item['route_name'] ? route($item['route_name']) : '' }}">{{ $item['name'] }}</a>
                                        @if (isset($item['sub-menu']) && $item['sub-menu'])
                                            <ul class="sub-menu">
                                                @foreach ($item['sub-menu'] as $sItem)
                                                    <li><a
                                                            href="{{ $sItem['route_name'] ? route($sItem['route_name']) : '' }}">{{ $sItem['name'] }}</a>
                                                    </li>
                                                    @if ($sItem['divider'])
                                                        <hr class="m-0" />
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    @auth
                                        <button type="button"
                                            class="btn btn-mute border-0 dropdown-toggle">{{ 'Nhan' }}</button>
                                        <ul class="sub-menu">
                                            <li><a href="carot.html">Thông tin</a></li>
                                            <hr class="m-0" />
                                            <li><a href="ghepanh.html">Đăng xuất</a></li>
                                        </ul>
                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}">Đăng nhập</a>
                                    @endguest
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
