jQuery(document).ready(function($) {
	//FRONT-END
	$('#fullpage').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: true,
		autoScrolling: true,
	});
	$height = $(window).height();
	$(window).on("scroll", function(e){
		if($(window).scrollTop() > $height) {
			$('header').addClass('header-active',150);
		}else{
			$('header').removeClass('header-active',150);
		};
	});


});
