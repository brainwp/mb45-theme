jQuery(document).ready(function($) {
	//FRONT-END

	$('.navbar-toggle').on("click", function(g){
		$('.header').toggleClass('backgroundMenu', 1000);
		$('.navbar-toggle').toggleClass('activeButtom', 1000);
	});
	$('select').selectric({
		inheritOriginalWidth: false,
	});



	$('#fullpage').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,



	});
	$('#fullpage-nails').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,

	});
	$('#fullpage-hair').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,
	});
	$('#fullpage-brands').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,
	});


	if ( $(window).width() <= 921 ){
		$.fn.fullpage.setAutoScrolling(false);

	}

	$( '.hair-name' ).center();

	$width = $(window).width();
	$mobileHeight = $(window).height();
	if($width <= 991) {
		$('.in').css({
			height: "$mobileHeight"
		});
	}



	$('.woocommerce-checkout p.form-row').addClass('col-md-9');
	$('.wc-appointments-date-picker').addClass('col-md-7 no-float no-padding');



});
