$(function () {
	// homepage slider
	$(".homepage-slider").owlCarousel({
		items: 1,
		loop: true,
		autoplay: true,
		nav: true,
		dots: false,
		lazyLoad: false,
		navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		responsive: {
			0: {
				items: 1,
				nav: false,
				loop: true
			},
			600: {
				items: 1,
				nav: true,
				loop: true
			},
			1000: {
				items: 1,
				nav: true,
				loop: true
			}
		}
	});
});
