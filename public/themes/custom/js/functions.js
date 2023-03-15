; (function ($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function () {
		// Fixed nav resize padding
		$("body").css("padding-top", $(".header").height());


		// if ($(window).width() < 991) {
		// 	let $header_height = $(".header").height();
		// 	$('.navbar-toggler-m').css('height',$header_height);

		// } else {
		// 	$('.navbar-toggler-m').css('height','auto');
		// }

		// Bs modal close
		$(document).on('click.bs.dropdown.data-api', '.dropdown.dropdown-close', function (e) {
			e.stopPropagation();
		});

		// Remove scrolling body when nav is open
		$('.navbar-main').on('shown.bs.collapse', function () {
			$("body").css('overflow', 'hidden');
		});

		$('.navbar-main').on('hidden.bs.collapse', function () {
			$("body").css('overflow', 'inherit');
		});

		// Mobile nav animated
		(function ($) {
			let $window = $(window);
			function resize() {
				if ($window.width() < 1199) {
					$(".navbar-collapse-c").addClass('animate__animated animate__slideInLeft');
					$(".navbar-collapse-c").addClass('blue-transperant-dark');
					return true;
				}
			}
			$window
				.resize(resize)
				.trigger('resize');
		})(jQuery);


		// Slider responsive breakpoints
		const breakpoints = {
			sm: 575,
			md: 767,
			lg: 992,
			xl: 1199,
			xxl_2: 1499
		};

		// Slider-main 
		$('.slider-main').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			cssEase: 'linear',
			speed: 500,
			adaptiveHeight: true,
			dots: false,
			autoplay: true,
			autoplaySpeed: 2500,
			arrows: false
		});

		// slider-services
		$slick_slider = $('.slider-services');
		settings_slider = {
			dots: true,
			arrows: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 2500,
		}
		slick_on_mobile($slick_slider, settings_slider);

		// slider-services on mobile
		function slick_on_mobile(slider, settings) {
			$(window).on('load resize', function () {
				if ($(window).width() > 767) {
					if (slider.hasClass('slick-initialized')) {
						slider.slick('unslick');
					}
					return
				}
				if (!slider.hasClass('slick-initialized')) {
					return slider.slick(settings);
				}
			});
		};

		// Counter
		new PureCounter({
			selector: '.number_1',
			start: 0,
			end: 15.,
			duration: 5,
			delay: 50,
			once: false,
			repeat: false,
			decimals: 3,
			filesizing: false,
			currency: false,
			// separator: '+',
			once: true,
			legacy: true,
		});

		// Counter
		new PureCounter({
			selector: '.number_2',
			start: 0,
			end: 50,
			duration: 5,
			delay: 50,
			once: false,
			repeat: false,
			decimals: 2,
			filesizing: false,
			currency: false,
			// separator: '+',
			once: true,
			legacy: true,
		});

		// Counter
		new PureCounter({
			selector: '.number_3',
			start: 0,
			end: 40,
			duration: 5,
			delay: 50,
			once: false,
			repeat: false,
			decimals: 2,
			filesizing: false,
			currency: false,
			// separator: '+',
			once: true,
			legacy: true,
		});

		// Counter
		new PureCounter({
			selector: '.number_4',
			start: 0,
			end: 100.,
			duration: 5,
			delay: 50,
			once: false,
			repeat: false,
			decimals: 1,
			filesizing: false,
			currency: false,
			// separator: '+',
			once: true,
			legacy: true,
		});

		// slider-teaser
		$('.slider-teaser').slick({
			mobileFirst: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			infinite: true,
			autoplay: true,
			speed: 1000,
			responsive: [{
				breakpoint: breakpoints.lg,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				}
			},
			{
				breakpoint: breakpoints.xl,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4,
					arrows: true,
				}
			}]
		});

		// slider-gallery
		$('.slider-gallery').slick({
			mobileFirst: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			infinite: true,
			autoplay: true,
			speed: 1000,
			responsive: [{
				breakpoint: breakpoints.lg,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				}
			}]
		});

		// slider-gallery
		let $slickElement = $('.slider-gallery');

		$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
			let i = (currentSlide ? currentSlide : 0) + 1;
			console.log(slick.slideCount)

			if (slick.slideCount <= 1) {
				$(".slider-gallery .slick-track").removeClass('d-flex w-100');
				$(".slider-gallery .slick-track").addClass('d-flex w-100');
				$(".slider-gallery .slide").removeClass('w-100');
				$(".slider-gallery .slide").addClass('w-100');
			}
		});

		// slider-gallery-inner
		$('.slider-gallery-inner').slick({
			mobileFirst: true,
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			rows: 2,
			dots: true,
			arrows: false,
			// infinite: true,
			// autoplay: true,
			speed: 1000,
			responsive: [{
				breakpoint: breakpoints.lg,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					rows: 2,
					centerPadding: '100px'
				}
			}]
		});

		// slider-gallery-inner
		let $slickElementGallery = $('.slider-gallery-inner');

		$slickElementGallery.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
			let i = (currentSlide ? currentSlide : 0) + 1;
			console.log(slick.slideCount)

			if (slick.slideCount <= 1) {
				$(".slider-gallery-inner .slick-track").removeClass('d-flex w-100');
				$(".slider-gallery-inner .slick-track").addClass('d-flex w-100');
				$(".slider-gallery-inner .slide").removeClass('w-100');
				$(".slider-gallery-inner .slide").addClass('w-100');
			}
		});

		// SLider-services-inner
		$('.slider-services-inner').slick({
			mobileFirst: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			infinite: true,
			autoplay: true,
			speed: 3000,
			arrows: false,
			responsive: [{
				breakpoint: breakpoints.md,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			]
		});

		// SLider-services-inner
		let $slickSlider = $('.slider-services-inner');

		$slickSlider.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
			let i = (currentSlide ? currentSlide : 0) + 1;
			console.log(slick.slideCount)

			if (slick.slideCount <= 3) {
				$(".slider-services-inner .slick-track").removeClass('d-flex w-100');
				$(".slider-services-inner .slick-track").addClass('d-flex w-100');
				$(".slider-services-inner .slide").removeClass('w-100');
				$(".slider-services-inner .slide").addClass('w-100');
			}
		});

		// Fancybox
		$('[data-fancybox="gallery"]').fancybox({
			protect: true
		})

		// Wow js
		new WOW().init();

	});
})(jQuery, window, document);
