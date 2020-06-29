(function ($) {
    "use strict";

	/** Define Mobile Enviroment */
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};
  	
  	/** Navigation Dropdown */
  	$('#header .menu').dropdown_menu();
  	
  	/** Mobile Menu */
  	if( isMobile.any() ){
  		$( '.menu li:has(ul)' ).doubleTapToGo();
  	}
	  	
  	/** Main Navigation Sticky */
  	if ( !isMobile.any() ) {
  		$('#main-nav').waypoint('sticky', {
  			handler : function (direction) {
  				if ( direction == "down" ) {
  					var offset = $('#site').offset();
  					$('#main-nav').css('left', offset.left );
  				} else {
  					$('#main-nav').css('left', 0 );
  				}
  				
  			}
  		});
  	}
  	
  	/** Sticky Booking Rom */
  	if ( !isMobile.any() ) {
	  	$('#header').waypoint({
	  		handler:  function (direction) {
	  			if ( direction == 'down' ) {
	  				$('.booking-row').css('position', 'absolute');
	  			} else {
	  				$('.booking-row').css('position', 'fixed');
	  			}
	  		},
	  		offset: 'bottom-in-view'
	  	});
  	} else {
  		$('.booking-row').css('position', 'absolute');
  	}
  	
  	/** Services Carousel */
  	if ( $(".services-carousel").length > 0 ) {
  		$(".services-carousel").owlCarousel({
  			items				: 4,
  			margin				: 20,
  			loop 				: true,
  			autoplay 			: true,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true,
  			responsive			: {
  				0 : {
  					items 	: 1,
  					dots	: true
  				},
  				767 : {
  					items 	: 2,
  					dots	: false
  				},
  				992 : {
  					items 	: 3,
  					dots	: false
  				},
  				1200 : {
  					items 	: 4,
  					dots	: false
  				}
  			}
  		});
  	}
  	
  	/** Testimonials Carousel */
  	if ( $('.testimonials-carousel').length > 0 ) {
  		$(".testimonials-carousel").owlCarousel({
  			items				: 3,
  			margin				: 20,
  			nav					: true,
  			loop 				: true,
  			autoplay 			: true,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true,
  			responsive			: {
  				0 : {
  					items 	: 1,
  					dots	: true,
  					nav		: false
  				},
  				767 : {
  					items 	: 2,
  					dots	: true
  				},
  				992 : {
  					items 	: 3,
  					dots	: true
  				}
  			}
  		});
  	}
  	
  	/** Testimonials Carousel */
  	if ( $('.content-carousel').length > 0 ) {
  		$(".content-carousel").owlCarousel({
  			items				: 1,
  			nav					: false,
  			loop 				: false,
  			dots				: false,
  			URLhashListener		: true,
  			autoplay 			: false,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true
  		});
  	}
  	
  	/** Gallery Carousel */
  	if ( $('.gallery-carousel').length > 0 ) {
  		$(".gallery-carousel").owlCarousel({
  			items				: 1,
  			nav					: true,
  			stagePadding		: 3,
  			margin				: 5,
  			dots				: true,
  			loop 				: true
  		});
  	}
  	
  	/** Stellar */  	
  	if( ! isMobile.any() && $('.parallax-container, .parallax, .parallax-bg').length > 0 ){
  		$.stellar({
  			horizontalScrolling: false,
  			parallaxBackgrounds: true,
  			hideDistantElements: false
  		});
  	}
  	
  	/** Contact Map */
  	if ( $('#map-holder').length > 0 ) {
		$('#map-container').width('100%').height('100%').gmap3({
			map:{
				options:{
						center: [51.5085300,-0.1257400],
						zoom:15,
						disableDefaultUI: true,
						draggable: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						mapTypeControl: false,
						mapTypeControlOptions: {},
						navigationControl: false,
						scrollwheel: false,
						streetViewControl: false,
						styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}]
				}
			},
			marker:{
				latLng:[51.5085300,-0.1257400]
			}
		});
  	}
  	
  	/** Coming Soon */
  	if ( $('#coming-soon').length > 0 ) {
  		$('#coming-soon').css( 'margin-top', - ( $('#coming-soon').outerHeight() / 2 ) );
  	}
  	
  	/** Nice Self Scroll */
  	$('a[target="_self"]').on('click', function (e) {
  		e.preventDefault();
  		var target = $(this).attr('href');
  		$(target).velocity("scroll", { duration: 1000, easing: "easeOutCubic", offset: -( $('#main-nav').outerHeight() + 30 ) });
  	});
  	
  	/** Lightbox */
  	if ( $('a[rel="lightbox"]').length > 0 ) {
  		$(function () {
  		    $('a[rel="lightbox"]').boxer({
  		        fixed: true
  		    });
  		});
  	}
  	
  	/** Booking Select */
  	if ( !isMobile.any() && $('.select-or-die').length > 0 ) {
  		$('.select-or-die').selectOrDie();
  	}
  	
  	/** Video Bg */
  	if ( $("#video-bg").length > 0 ) {
  		$("#video-bg").wallpaper({
  			source: {
  				poster	: "images/sunny.jpg",
				mp4		: "video/sunny.mp4",
				ogg		: "video/sunny.ogv",
				webm	: "video/sunny.webm"
  			}
  		});
  	}
  	
  	/** 404 Video Bg */
  	if ( $("#videobg-2").length > 0 ) {
  		$("#videobg-2").wallpaper({
  			source: {
  				poster	: "images/birds.jpg",
  				mp4		: "video/birds.mp4",
  				ogg		: "video/birds.ogv",
  				webm	: "video/birds.webm"
  			}
  		});
  	}
  	
  	/** Recreation Video Bg */
  	if ( $("#videobg-3").length > 0 ) {
  		$("#videobg-3").wallpaper({
  			source: {
  				poster	: "images/snorkelling.jpg",
  				mp4		: "video/snorkelling.mp4",
  				ogg		: "video/snorkelling.ogv",
  				webm	: "video/snorkelling.webm"
  			}
  		});
  	}
  	
  	/** Search Form */
  	$('.search-button').on('click', function (e) {
  		e.preventDefault();
  		
		$('#search-form').velocity('fadeIn');
		$('.search-field').focus();
  		
  		$('#main-nav').mouseleave(function () {
  			$('#search-form').velocity('fadeOut');
  		});
  	});
  	
  	$('.close-search').on('click', function (e) {
  		e.preventDefault();
  		
  		$('#search-form').velocity('fadeOut');
  	});
  	
  	/** Tooltips */
  	$("[data-toggle='tooltip']").tooltip();
  	
  	/** Date Picker */
  	if ( $('.form-control[data-provide="datepicker"]').length > 0 ) {
  		$('.form-control[data-provide="datepicker"]').datepicker().on('show', function(e){
  			$('.datepicker').css('min-width', $(this).outerWidth() );
  		});
  	}
  	
  	/** Animations */
  	if ( $('.animated').length > 0 && ! isMobile.any() ) {
  		$('.animated').waypoint(function() {
  			var target = $(this);
  			if ( ! target.hasClass( 'animated_off' ) ) {
  				$(target).delay(150).velocity("transition.slideUpIn");
  				target.addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('.animated').css('opacity', 1);
  	}
  	if ( $('.animated-children').length > 0 && ! isMobile.any() ) {
  		$('.animated-children').waypoint(function() {
  			var target = $(this);
  			if ( ! target.hasClass( 'animated_off' ) ) {
  				$('[class*="col-"]', target).children().velocity("transition.slideUpIn", { stagger: 100 });
  				target.addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('[class*="col-"]', '.animated-children').css( 'opacity', 1 );
  	}
  	if ( ! isMobile.any() ) {
  		$('#footer').waypoint(function() {
  			if ( ! $('#footer').hasClass( 'animated_off' ) ) {
  				$('aside', '#footer').delay(50).velocity("transition.slideUpIn", { drag: true, stagger: 50 });
  				$('#footer').addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('aside', '#footer').css( 'opacity', 1 );
  	}
  	
  	/** Mobile Navigation */
  	if ( isMobile.any() ) {
  		$('#toggle-secondary-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-main-nav').prop('checked', false);
  			}
  		});
  		$('#toggle-main-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-secondary-nav').prop('checked', false);
  			}
  		});
  	}
  	
  	/** Attractions Isotope */
  	if ( $('#isotope').length > 0 ) {
  		$('#isotope').isotope();
  		$('#isotope-filter a').on('click', function (e) {
  			e.preventDefault();
  			var filterValue = $(this).attr('data-filter');
  			$('#isotope').isotope({ filter: filterValue });
  			$(this).parent().siblings().removeClass('selected');
  			$(this).parent().addClass('selected');
  			if ( ! $('#footer').hasClass( 'animated_off' ) ) {
  				$('aside', '#footer').delay(150).velocity("transition.slideUpIn", { drag: true, stagger: 50 });
  				$('#footer').addClass( 'animated_off' );
  			}
  		});
  	}
  	
})(jQuery);
