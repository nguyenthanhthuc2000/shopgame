const config = {
    header: {
        elements: {
            sticker: '#sticker'
        }
    }
}

$(function () {
    // testimonial sliders
    $(".testimonial-sliders").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: true
            }
        }
    });

    // logo carousel
    $(".logo-carousel-inner").owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        margin: 30,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: true
            }
        }
    });

    // count down
    if ($('.time-countdown').length) {
        $('.time-countdown').each(function () {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                var $this = $(this).html(event.strftime('' + '<div class="counter-column"><div class="inner"><span class="count">%D</span>Ngày</div></div> ' + '<div class="counter-column"><div class="inner"><span class="count">%H</span>Giờ</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%M</span>Phút</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%S</span>Giây</div></div>'));
            });
        });
    }

    // projects filters isotop
    // $(".product-filters li").on('click', function () {

    //     $(".product-filters li").removeClass("active");
    //     $(this).addClass("active");

    //     var selector = $(this).attr('data-filter');

    //     $(".product-lists").isotope({
    //         filter: selector,
    //     });

    // });
    // chuyển động khi click vào phân trang
    // isotop inner
    // $(".product-lists").isotope();

    // magnific popup
    // $('.popup-youtube').magnificPopup({
    //     disableOn: 700,
    //     type: 'iframe',
    //     mainClass: 'mfp-fade',
    //     removalDelay: 160,
    //     preloader: false,
    //     fixedContentPos: false
    // });

    // light box
    // $('.image-popup-vertical-fit').magnificPopup({
    //     type: 'image',
    //     closeOnContentClick: true,
    //     mainClass: 'mfp-img-mobile',
    //     image: {
    //         verticalFit: true
    //     }
    // });

    // homepage slides animations
    $(".homepage-slider").on("translate.owl.carousel", function () {
        $(".hero-text-tablecell .subtitle").removeClass("animated fade-in-up").css({ 'opacity': '0' });
        $(".hero-text-tablecell h1").removeClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.3s' });
        $(".hero-text-tablecell .subdesc").removeClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.4s' });
        $(".hero-btns").removeClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.7s' });
    });

    $(".homepage-slider").on("translated.owl.carousel", function () {
        $(".hero-text-tablecell .subtitle").addClass("animated fade-in-up").css({ 'opacity': '0' });
        $(".hero-text-tablecell h1").addClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.3s' });
        $(".hero-text-tablecell .subdesc").addClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.5s' });
        $(".hero-btns").addClass("animated fade-in-up").css({ 'opacity': '0', 'animation-delay': '0.7s' });
    });

    // stikcy js
    // $("#sticker").sticky({
    //     topSpacing: 0
    // });

    //mean menu
    // $('.main-menu').meanmenu({
    //     meanMenuContainer: '.mobile-menu',
    //     meanScreenWidth: "992"
    // });

    // search form
    $(".search-bar-icon").on("click", function () {
        $(".search-area").addClass("search-active");
    });

    $(".close-btn").on("click", function () {
        $(".search-area").removeClass("search-active");
    });

    jQuery(window).on("load", function () {
        jQuery(".loader").fadeOut(1000);
    });

    // $('#sticker').on('sticky-start', function () { console.log("Started"); });
    // $('#sticker').on('sticky-end', function () { console.log("Ended"); });
    // $('#sticker').on('sticky-update', function () { console.log("Update"); });
    // $('#sticker').on('sticky-bottom-reached', function () { console.log("Bottom reached"); });
    // $('#sticker').on('sticky-bottom-unreached', function () { console.log("Bottom unreached"); });
});
