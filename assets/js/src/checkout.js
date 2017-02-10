jQuery(document).ready(function($) {
	// prevent script execution on another pages
	if( ! $( 'body' ).hasClass( 'woocommerce-checkout' ) ) {
		return;
	}
	// update user phone to add country code
	var updatePhone = function() {
		if ( $( '#get_sms_notification' ).length > 0 && $( '#get_sms_notification' ).is( ':checked' ) ) {
			var $input_phone = $( 'form.woocommerce-checkout #billing_phone' );
			var value = $input_phone.val();
			value = value.replace( '-', '' ).replace( /\s/g, '' );
			if ( value == '' ) {
				return;
			}
			if ( ! ( ( value.length >= 11 || value.indexOf( '+1' ) > -1 ) || value.indexOf( '+55' ) > -1 ) ) {
				var check_value = '+' + value;
				if ( check_value.substring( 0, 2 ) != '+1' || check_value.substring( 0, 3 ) != '+55' ) {
					value = '+1' + value;
				} else {
					value = check_value;
				}
				$input_phone.val( value );
			}
		}
	}
	$( window ).load( function() {
		updatePhone();
	});
	$( '#get_sms_notification' ).on( 'change', function(){
		updatePhone();
	} );
	var needStep3 = true;
	$( 'body' ).on( 'click', 'a.submit-checkout', function( e ) {
		e.preventDefault();
		updatePhone();
		if ( $( this ).attr( 'data-current') == '2' && needStep3 ) {
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
  	$( 'form.woocommerce-checkout' ).keydown( function( e ){
    	if( 13 == e.keyCode ) {
      		e.preventDefault();
      		$( 'a.submit-checkout' ).trigger( 'click' );
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
	// hidden step 3 if price is = 0
	$( document ).ajaxComplete(function( e, request, settings ) {
		if ( typeof request.responseJSON !== 'undefined' ) {
			setTimeout( function(){
				var $elem = $( '.order-total .woocommerce-Price-amount' );
				$( 'body' ).append( '<div id="temp-html-price" style="display:none;"></div>' );
				$( '#temp-html-price' ).html( $elem.html() );
				$( '#temp-html-price span' ).remove();
				var price = parseInt( $( '#temp-html-price' ).html() );
				console.log( price );
				if ( price == 0 ) {
					$( 'a.submit-checkout' ).html( $( 'a.submit-checkout' ).attr( 'data-step3' ) );
					needStep3 = false;
				}
				$( '#temp-html-price' ).remove();
			}, 300 );
		}
	});
	$( 'body').on( 'submit', 'form.woocommerce-checkout', function( e ) {
		e.preventDefault();
	});
});
