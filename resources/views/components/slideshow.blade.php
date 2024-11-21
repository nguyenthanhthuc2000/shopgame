<div class="homepage-slider owl-carousel owl-theme">
    <div class="single-homepage-slider homepage-bg-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subtitle animated fadeInUp" style="">Chất Lượng - Uy Tín - Hài Lòng</p>
                            <h1 class="animated fadeInUp" style=" animation-delay: 0.3s;">NICKDAOQUAN.VN</h1>
                            <p class="subdesc animated fadeInUp" style="">Hệ thống mua bán nick game uy tín số một Việt Nam!</p>
                            <div class="hero-btns animated fadeInUp" style=" animation-delay: 0.5s;">
                                <a href="{{url()->current()}}#categories" class="boxed-btn">Xem Nick Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                // nav: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 1000,
                autoplayHoverPause: true,
                dots: false,
                // navText: [
                //     '<i class="fas fa-angle-left"></i>',
                //     '<i class="fas fa-angle-right"></i>'
                // ],
            })
        })
    </script>
@endpush
