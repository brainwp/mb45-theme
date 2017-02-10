<?php
/**
 * odin WooCommerce hooks
 *
 * @package odin
 */

/**
 * Remove native styles
 *
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Content wrapper before and after
 * @see  odin_before_content()
 * @see  odin_after_content()
 * @since  2.2.6
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'odin_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'odin_after_content', 10 );

/**
 * Remove sidebar
 *
 * Tip:
 * Case you use this action, change template page for full-width style in inc/woocommerce/functions.php
 *
 * @see woocommerce_sidebars
 * @since  2.2.6
 */
// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Breadcrumb
 *
 * Use:
 * do_action( 'odin_content_top' ); on anywhere for show the breadcrumb
 *
 * @see woocommerce_breadcrumb
 * @since  2.2.6
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'odin_content_top', 'woocommerce_breadcrumb', 10 );

/**
 * Filters
 * @see  odin_thumbnail_columns()
 * @see  odin_products_per_page()
 * @see  odin_loop_columns()
 * @since  2.2.6
 */
add_filter( 'woocommerce_product_thumbnails_columns', 	'odin_thumbnail_columns' );
add_filter( 'loop_shop_per_page', 						'odin_products_per_page' );
add_filter( 'loop_shop_columns', 						'odin_loop_columns' );

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

/**
 * Remove cart item by $_GET param
 * @return null
 */
function mb45_remove_cart_item() {
	if ( isset( $_GET[ 'wc_remove_item'] ) ) {
		WC()->cart->remove_cart_item( $_GET[ 'wc_remove_item'] );
		// if cart is empty after remove item, back to home page
		if ( WC()->cart->get_cart_contents_count() == 0 ) {
			wp_redirect( home_url() );
		}
	}
}
add_action( 'get_header', 'mb45_remove_cart_item' );
/**
 * Reorder my account tab link list
 * @param array $items
 * @return array
 */
function mb45_reorder_account_menu_items( $items ) {
	unset( $items[ 'dashboard' ] );
	asort( $items );
	$logout_value = $items[ 'customer-logout' ];
	unset( $items[ 'customer-logout' ] );
	$items[ 'customer-logout' ] = $logout_value;
	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'mb45_reorder_account_menu_items' );
/**
 * Add body class if user is unlogged
 * @param array $classes
 * @return array
 */
function add_unlogged_body_class_my_account( $classes ) {
	if ( is_page_template( 'page-myaccount.php') && ! is_user_logged_in() ) {
		$classes[] = 'unlogged';
	}
	return $classes;
}
add_filter( 'body_class', 'add_unlogged_body_class_my_account' );

/**
 * Show a coupon link above the order details.
**/
function show_coupon_as_a_checkout_field() {
	echo '<div class="form-row form-row form-row-wide form-coupon-checkout col-md-12" style="clear:both;">';
	_e( '<label>Coupon/Gift Card</label>', 'odin' );
	echo '<input type="text" name="apply-wc-coupon">';
	printf( '<a href="#" class="btn btn-apply-coupon">%s</a>', __( 'Apply coupon', 'odin' ) );
	echo '</div>';
}
add_action( 'woocommerce_after_checkout_billing_form', 'show_coupon_as_a_checkout_field' );

/**
 *
 * Add class to redirect user after add product to cart
 *
*/
require_once( get_template_directory() . '/inc/woocommerce/class-redirect-after-add-to-cart.php' );
new Brasa_Redirect_After_Add_To_Cart( home_url( '/appointment/step-2' ), true );

/**
 * Get appointment post by order id
 * @param int $order_id
 */
function wc_get_appointment_id_by_order( $order_id ) {
	$args = array(
		'post_parent'		=> $order_id,
		'numberposts'		=> 1,
		'post_type'			=> 'wc_appointment',
		'post_status'		=> 'any'
	);
	$appointment = get_posts( $args );
	if ( $appointment && ! empty( $appointment ) ) {
		return $appointment[0]->ID;
	}
	return false;
}
/**
 * Show gift cards in a order object separated by comma
 * @param object $order
 * @param string|bool $message
 * @return string|bool
 */
function wc_get_all_gift_cards( $order, $message = false ) {
	if( ! is_object( $order ) ) {
		return false;
	}
	$items = $order->get_items();
	if ( ! is_array( $items ) || empty( $items ) ) {
		return false;
	}
	if ( false === $message ) {
		$message = __( 'Gift Card: %s', 'odin' );
	}
	$item_message = '';
	$i = 0;
	foreach ( $items as $item_key => $item_value ) {
		if ( isset( $item_value[ 'item_meta' ][ '_ywgc_gift_card_number' ] ) ) {
			if( $i > 0 ) {
				$item_message .= ', ' . $item_value[ 'item_meta' ][ '_ywgc_gift_card_number' ][0];
			} else {
				$item_message .= $item_value[ 'item_meta' ][ '_ywgc_gift_card_number' ][0];
			}
			$i++;
		}
	}
	if ( 0 === $i ) {
		return false;
	} else {
		$message = sprintf( $message, $item_message );
		return $message;
	}
}
/**
 * Add custom plivo variables
 * @param array $variables
 * @param int|bool $order_id
 * @return array
 */
function custom_wcp_variable_values( $variables, $order_id = false ) {
	if ( ! $order_id ) {
		$order_id = $variables[ 'order_id' ];
	}
	$order = new WC_Order( $order_id );
	$appointment_id = wc_get_appointment_id_by_order( $order_id );
	$variables[ 'appointment_date' ] = '';
	if ( $appointment_id ) {
		$appointment = get_wc_appointment( $appointment_id );

		$variables[ 'appointment_date' ] = sprintf( __( "Date: %s.\n", 'odin' ), $appointment->get_start_date( 'm/d/Y', '' ) );
		$variables[ 'appointment_date' ] = sprintf( __( "Time: %s.\n", 'odin' ), $appointment->get_start_date( 'h:i A', '' ) );
		$variables[ 'appointment_date' ] .= sprintf( __( "Appointment ID: %s.\n", 'odin' ), $appointment_id );
	}
	$gift_cards = wc_get_all_gift_cards( $order );
	$variables[ 'gift_card' ] = '';
	if ( $gift_cards ) {
		$variables[ 'gift_card' ] = $gift_cards;
	}
	return $variables;
}

add_filter( 'wcp_variable_values', 'custom_wcp_variable_values', 99999, 2 );

/**
 * Plivio Variables Description on dashboard
 * @param array $variables
 * @return array
 */
function custom_wcp_variable_description( $variables ) {
	$variables[ 'appointment_date' ] = 'Appointment Date';
	$variables[ 'gift_card' ] = 'Gift Card';

	return $variables;
}

add_filter( 'wcp_variables', 'custom_wcp_variable_description' );
