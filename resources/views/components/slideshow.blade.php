@if (isHomePage())
    {{-- <div class="homepage-slider owl-carousel owl-theme">
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Chất Lượng - Uy Tín - Hài Lòng</p>
                                <h1 class="title">NICKDAOQUAN.VN</h1>
                                <p class="subdesc">Hệ thống mua bán nick game uy tín số
                                    một Việt Nam!</p>
                                <div class="hero-btns">
                                    <a href="{{ url()->current() }}#categories" class="boxed-btn">Xem Nick Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="homepage-slider owl-carousel owl-theme">
        <div class="single-homepage-slider">
            <img src="{{ asset('assets/images/homepage-bg-1.jpg') }}" alt="Banner 1" class="slider-img">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Chất Lượng - Uy Tín - Hài Lòng</p>
                                <h1 class="title">NICKDAOQUAN.VN</h1>
                                <p class="subdesc">Hệ thống mua bán nick game uy tín số một Việt Nam!</p>
                                <div class="hero-btns">
                                    <a href="{{ url()->current() }}#categories" class="boxed-btn">Xem Nick Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </div>
@endif