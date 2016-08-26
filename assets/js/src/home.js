jQuery(document).ready(function($) {
	//FRONT-END
	$('.navbar-toggle').on("click", function(g){
		$('.header').toggleClass('backgroundMenu', 1000);
	});

	$('#fullpage').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: true,
		autoScrolling: true,
	});

	$('#fullpage-nails').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: true,
		autoScrolling: true,
	});

	$height = $(window).height() - 100;
	$(window).on("scroll", function(e){
		if($(window).scrollTop() > $height) {
			$('header').addClass('header-active',150);
		}else{
			$('header').removeClass('header-active',150);
		};
	});


	$width = $(window).width();
	$mobileHeight = $(window).height();
	if($width <= 991) {
		$('.in').css({
			height: "$mobileHeight"
		});
	}



});
