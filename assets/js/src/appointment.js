/**
 *
 * Page appointment
 *
*/
jQuery(document).ready(function($) {
	$( 'select[name="guests-num"]' ).on( 'change', function( e ) {
		console.log( 'FEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEL' );
		var value = parseInt( $( this ).val(), 10 );
		for (var i = 0; i < 3; i++ ) {
			console.log( 'SOLO DE GUITARRA' );
			if ( i == 0 ) {
				continue;
			}
			if ( i > value ) {
				$( '#customer-' + i ).fadeOut( 2000 );
				$( '#is-selected-' + i ).val( 'false' );
			} else {
				$( '#customer-' + i ).fadeIn( 2000 );
				$( '#is-selected-' + i ).val( 'true' );
			}

		};
	});
});
