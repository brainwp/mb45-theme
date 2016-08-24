jQuery(document).ready(function($) {
	//FRONT-END
	$('#fullpage').fullpage({
		menu: '#header',
		navigation: true,
		navigationPosition: 'left',
		scrollBar: true,
		autoScrolling: true,
	});
	// Get window size
	$height = $(window).height();
	$(window).on("scroll", function(){
  	 if( $(window).scrollTop() > $height ) {
      	 $('header').addClass('header-active',150);
  	 }else{
  	 	$('header').removeClass('header-active',150)
  	 }
	});













	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();

});
