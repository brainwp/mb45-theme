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
		onLeave: function(index, nextIndex, direction){
            var leavingSection = $(this);
            //after leaving section 2
            if(index == 1 && direction =='down'){
               $('#header').addClass('header-active',150);
            }

            else if(index == 2 && direction == 'up'){
                $('#header').removeClass('header-active',150);
            }
        }
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


	$( '.hair-name' ).center();

	$height = $(window).height() - 100;
	$width = $(window).width();
	$mobileHeight = $(window).height();
	if($width <= 991) {
		$('.in').css({
			height: "$mobileHeight"
		});
	}

});
