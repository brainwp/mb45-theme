jQuery(document).ready(function($) {
	$( 'body' ).on( 'click', 'a.submit-checkout', function( e ) {
		e.preventDefault();
		if ( $( this ).attr( 'data-current') == '2' ) {
			var next = true;
			$( 'form.woocommerce-checkout .validate-required' ).each( function() {
				if ( ! $( this ).hasClass( 'validate-state' ) ) {
					if ( $( this ).find( 'input' ).val().trim() == '' ) {
						$( this ).addClass( 'woocommerce-invalid' );
						$( this ).addClass( 'woocommerce-invalid-required-field' );
						console.log( $( this ).find( 'input' ) );
						next = false;
					}
				}
			});
			if ( next ) {
				$button = $( this );
				$button.html( $button.attr( 'data-step3' ) );
				$button.attr( 'data-current', '3' );
				$( '.checkout-steps span.current').removeClass( 'current' );
				$( '.checkout-steps span[data-step="3"]' ).addClass( 'current' );
				$( 'a.back-button' ).fadeIn( 'slow' );
				$( '#step-2' ).fadeOut( 'slow', function() {
					$( '#step-3').fadeIn( 'slow' );
				});
			}
		}
	});
	$( 'body' ).on( 'click', 'a.back-button', function( e ) {
		e.preventDefault();
		$button = $( 'a.submit-checkout' );
		if ( $button.attr( 'data-current' ) == '3' ) {
			$( '#step-3' ).fadeOut( 'slow', function() {
				$( '#step-2').fadeIn( 'slow' );
			});
			$button.html( $button.attr( 'data-step2' ) );
			$button.attr( 'data-current', '2' );
			$( 'a.back-button' ).fadeOut( 'slow' );
		}
	});
});
