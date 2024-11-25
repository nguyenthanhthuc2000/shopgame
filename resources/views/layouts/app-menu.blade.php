@php
    $menu = config('page.main_menu', []);
    $sticking = isHomePage() ? '' : ' is-sticky-menu';
@endphp

<div id="sticker-sticky-wrapper" class="sticky-wrapper {{ $sticking }}">
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
                                        <a href="/" class="menu__balance" style="
                                            font-weight: 500;
                                            background: unset;
                                            color: #FFFFFF;"
                                        ><span class="d-flex align-items-center gap-2">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C22 8.34315 22 10.2288 22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14Z" stroke="#FFFFFF" stroke-width="1.5"/>
                                                <path d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6" stroke="#FFFFFF" stroke-width="1.5"/>
                                                <path d="M12 17.3333C13.1046 17.3333 14 16.5871 14 15.6667C14 14.7462 13.1046 14 12 14C10.8954 14 10 13.2538 10 12.3333C10 11.4129 10.8954 10.6667 12 10.6667M12 17.3333C10.8954 17.3333 10 16.5871 10 15.6667M12 17.3333V18M12 10V10.6667M12 10.6667C13.1046 10.6667 14 11.4129 14 12.3333" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>  {{ number_format(auth()->user()->buyer_vnd, 0, ',', '.') }}
                                        </span></a>
                                        <a href="{{ route('auth.logout') }}"
                                            style="    
                                            font-weight: 500;
                                            border-radius: 20px;
                                            color: #FFFFFF;"
                                        ><span class="d-flex align-items-center gap-2">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 12L13 12" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        Đăng xuất</span></a>
                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}"
                                            style="    
                                                font-weight: 500;
                                                border-radius: 20px;
                                                color: #FFFFFF;
                                                border: 1px solid #FFFFFF;"
                                        >Đăng nhập</a>
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
