
$(function() {
    $(".homepage-slider").owlCarousel({
        items: 1,
        loop: true,
        autoplay: false,
        nav: true,
        dots: false,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true
            },
            3000: {
                items: 1,
                nav: true,
                loop: true
            },
            6000: {
                items: 1,
                nav: true,
                loop: true
            }
        }
    });
});
