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
                                                color: #FFFFFF;"
                                        >
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 2C10.2386 2 8 4.23858 8 7C8 7.55228 8.44772 8 9 8C9.55228 8 10 7.55228 10 7C10 5.34315 11.3431 4 13 4H17C18.6569 4 20 5.34315 20 7V17C20 18.6569 18.6569 20 17 20H13C11.3431 20 10 18.6569 10 17C10 16.4477 9.55228 16 9 16C8.44772 16 8 16.4477 8 17C8 19.7614 10.2386 22 13 22H17C19.7614 22 22 19.7614 22 17V7C22 4.23858 19.7614 2 17 2H13Z" fill="#FFFFFF"/>
                                            <path d="M3 11C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11.2821C11.1931 13.1098 11.1078 13.2163 11.0271 13.318C10.7816 13.6277 10.5738 13.8996 10.427 14.0945C10.3536 14.1921 10.2952 14.2705 10.255 14.3251L10.2084 14.3884L10.1959 14.4055L10.1915 14.4115C10.1914 14.4116 10.191 14.4122 11 15L10.1915 14.4115C9.86687 14.8583 9.96541 15.4844 10.4122 15.809C10.859 16.1336 11.4843 16.0346 11.809 15.5879L11.8118 15.584L11.822 15.57L11.8638 15.5132C11.9007 15.4632 11.9553 15.3897 12.0247 15.2975C12.1637 15.113 12.3612 14.8546 12.5942 14.5606C13.0655 13.9663 13.6623 13.2519 14.2071 12.7071L14.9142 12L14.2071 11.2929C13.6623 10.7481 13.0655 10.0337 12.5942 9.43937C12.3612 9.14542 12.1637 8.88702 12.0247 8.7025C11.9553 8.61033 11.9007 8.53682 11.8638 8.48679L11.822 8.43002L11.8118 8.41602L11.8095 8.41281C11.4848 7.96606 10.859 7.86637 10.4122 8.19098C9.96541 8.51561 9.86636 9.14098 10.191 9.58778L11 9C10.191 9.58778 10.1909 9.58773 10.191 9.58778L10.1925 9.58985L10.1959 9.59454L10.2084 9.61162L10.255 9.67492C10.2952 9.72946 10.3536 9.80795 10.427 9.90549C10.5738 10.1004 10.7816 10.3723 11.0271 10.682C11.1078 10.7837 11.1931 10.8902 11.2821 11H3Z" fill="#FFFFFF"/>
                                        </svg>
                                        Đăng nhập</a>
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
