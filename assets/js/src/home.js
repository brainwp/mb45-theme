jQuery(document).ready(function($) {
	//FRONT-END
	$('.navbar-toggle').on("click", function(g){
		$('.header').toggleClass('backgroundMenu', 1000);
		$('.navbar-toggle').toggleClass('activeButtom', 1000);
	});
	$('#fullpage').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,
		// DO NOT DELETE THE COMENT BELOW. THE CLIENT CAN CHANGE THE IDEA. IF THERE'S NOT COMENT, HE CHANGE THE IDEA :D.
		// onLeave: function(index, nextIndex, direction){
  //           var leavingSection = $(this);
  //           if(index == 1 && direction =='down'){
  //              $('#header').addClass('header-active',150);
  //           }

  //           else if(index == 2 && direction == 'up'){
  //               $('#header').removeClass('header-active',150);
  //           }
  //       }
	});

	$('#fullpage-nails').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: false,
		autoScrolling: true,
		// onLeave: function(index, nextIndex, direction){
  //           var leavingSection = $(this);
  //           if(index == 1 && direction =='down'){
  //              $('#header').addClass('header-active',150);
  //           }

  //           else if(index == 2 && direction == 'up'){
  //               $('#header').removeClass('header-active',150);
  //           }
  //       }
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


	$( '.hair-name' ).center();

	$height = $(window).height() - 100;
	$(window).on("scroll", function(e){
		if($(window).scrollTop() > $height) {
			$('#header').addClass('header-active',150);
		}else{
			$('#header').removeClass('header-active',150);
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
