@php
    $menu = config('page.main_menu', []);
    $sticking = isHomePage() ? '' : ' is-sticky-menu';
@endphp

<div id="sticker-sticky-wrapper" class="sticky-wrapper {{ $sticking }}">
    <div class="top-header-area" id="sticker">
        <nav class="navbar navbar-expand-lg main-menu" style="display: block;">
            <div class="container">
                <div class="site-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        @foreach ($menu as $item)
                            @php
                                $isAuthenticated = isset($item['is_login']) && $item['is_login'] === true;
                                $shouldRender = !$isAuthenticated || Auth::check();
                            @endphp

                            @if ($shouldRender)
                                <li class="{{ isCurrentRoute($item['route_name']) ? 'current-list-item' : '' }}">
                                    <a
                                        href="{{ $item['route_name'] ? route($item['route_name']) : '#' }}">{{ $item['name'] }}</a>

                                    @if (!empty($item['sub-menu']))
                                        <ul class="sub-menu">
                                            @foreach ($item['sub-menu'] as $sItem)
                                                <li>
                                                    <a
                                                        href="{{ $sItem['route_name'] ? route($sItem['route_name']) : '#' }}">{{ $sItem['name'] }}</a>
                                                </li>
                                                @if (!empty($sItem['divider']))
                                                    <hr class="m-0" />
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="ps-3 ps-lg-0 d-lg-flex user-action" style="display: flex; gap: 16px;">
                        @auth
                            <a href="{{ route('home.deposit') }}" class="d-block btn-auth" style="max-width: fit-content;">
                                <span class="d-flex align-items-center gap-2">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 14C2 10.2288 2 8.34315 3.17157 7.17157C4.34315 6 6.22876 6 10 6H14C17.7712 6 19.6569 6 20.8284 7.17157C22 8.34315 22 10.2288 22 14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14Z"
                                            stroke="#FFFFFF" stroke-width="1.5" />
                                        <path
                                            d="M16 6C16 4.11438 16 3.17157 15.4142 2.58579C14.8284 2 13.8856 2 12 2C10.1144 2 9.17157 2 8.58579 2.58579C8 3.17157 8 4.11438 8 6"
                                            stroke="#FFFFFF" stroke-width="1.5" />
                                        <path
                                            d="M12 17.3333C13.1046 17.3333 14 16.5871 14 15.6667C14 14.7462 13.1046 14 12 14C10.8954 14 10 13.2538 10 12.3333C10 11.4129 10.8954 10.6667 12 10.6667M12 17.3333C10.8954 17.3333 10 16.5871 10 15.6667M12 17.3333V18M12 10V10.6667M12 10.6667C13.1046 10.6667 14 11.4129 14 12.3333"
                                            stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" />
                                    </svg> {{ number_format(auth()->user()->buyer_vnd, 0, ',', '.') }}
                                </span></a>
                            <a href="{{ route('auth.logout') }}" class="btn-auth d-block"
                                style="max-width: fit-content;"><span class="d-flex align-items-center gap-2">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 12L13 12" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg> ĐĂNG XUẤT</span></a>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn-auth">
                                <i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP / <i class="fas fa-user-plus"></i> ĐĂNG KÝ</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
