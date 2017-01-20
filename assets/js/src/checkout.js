jQuery(document).ready(function($) {
	$( 'body' ).on( 'click', 'a.submit-checkout', function( e ) {
		e.preventDefault();
		if ( $( this ).attr( 'data-current') == '2' ) {
			var next = true;
			$( 'form.woocommerce-checkout .validate-required' ).each( function() {
				if ( ! $( this ).hasClass( 'validate-state' ) ) {
					if ( $( this ).find( 'input' ).val().trim() == '' && $( this ).is( ':visible' ) ) {
						$( this ).addClass( 'woocommerce-invalid' );
						$( this ).addClass( 'woocommerce-invalid-required-field' );
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
					$('.step-3').addClass('current');
				});
			}
		} else {
			$( 'form.woocommerce-checkout' ).submit();
		}
	});
	$( 'body' ).on( 'click', 'a.back-button', function( e ) {
		e.preventDefault();
		$button = $( 'a.submit-checkout' );
		if ( $button.attr( 'data-current' ) == '3' ) {

			$( '#step-3' ).fadeOut( 'slow', function() {
				$('.step-3').removeClass('current');
				$('.step-2').addClass('current');
				$( '#step-2').fadeIn( 'slow' );
			});
			$button.html( $button.attr( 'data-step2' ) );
			$button.attr( 'data-current', '2' );
			$( 'a.back-button' ).fadeOut( 'slow' );
		}
	});
	// Apply coupons
	var couponVisibleTimer;
	$( 'body' ).on( 'keyup mouseover click', 'input[name="apply-wc-coupon"]', function( e ){
		if ( $( this ).val().trim() == '' ) {
			return;
		}
		if ( $( '.btn-apply-coupon' ).hasClass( 'visible' ) ) {
			clearTimeout( couponVisibleTimer );
		}
		$( '.btn-apply-coupon' ).addClass( 'visible' );
		couponVisibleTimer = setTimeout( function(){
			$( '.btn-apply-coupon' ).removeClass( 'visible' );
		}, 5000 );
	});
	// Send coupons to ajax
	$( 'body' ).on( 'click', 'a.btn-apply-coupon', function( e ){
		var $coupon_input = $( 'input[name="apply-wc-coupon"]' );
		var $coupon_ajax_input = $( '#coupon_code' );
		if ( $coupon_input.val().trim() == '' ) {
			return;
		}
		$coupon_ajax_input.val( $coupon_input.val() );
		$( 'input[name="apply_coupon"]' ).trigger( 'click' );
	});
});
