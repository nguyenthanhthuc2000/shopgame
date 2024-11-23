@php
    $menu = config('page.main_menu', []);
@endphp

<div id="sticker-sticky-wrapper" class="sticky-wrapper" style="height: 105px;">
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">

                        <div class="site-logo">
                            <a href="{{url()->current()}}">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                            </a>
                        </div>

                        <nav class="main-menu" style="display: block;">
                            <ul>
                                @foreach ($menu as $item)
                                    <li class="{{ isCurrentRoute($item['route_name']) ? 'current-list-item' : ''}}">
                                        <a href="{{ $item['route_name'] ? route($item['route_name']) : '' }}">{{ $item['name'] }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    {{-- @auth --}}
                                    <div class="dropdown">
                                        <button class="btn btn-mute dropdown-toggle border-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                          Dropdown link
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <li><a class="dropdown-item" href="#">Action</a></li>
                                          <li><a class="dropdown-item" href="#">Another action</a></li>
                                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                    {{-- @endauth --}}

                                    {{-- @guest
                                        <p>Cần đăng nhập</p>
                                    @endguest --}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
