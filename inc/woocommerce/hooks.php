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
