<?php
/**
 * Redirect user to a custom URL after add a product to cart
 */
class Brasa_Redirect_After_Add_To_Cart {
	/**
	 * @var string
	 */
	private $url = '';
	/**
	 * @var bool
	 */
	private $redirect_only_single_product = true;
	/**
	 * Init the class
	 * @param string $url
	 * @param bool $redirect_only_single_product
	 */
	public function __construct( $url = '', $redirect_only_single_product = true ) {
		$this->url = $url;
		$this->redirect_only_single_product = $redirect_only_single_product;
		// after add to cart
		add_action( 'woocommerce_add_to_cart', array( &$this, 'after_add' ) );
	}
	/**
	 * Add action after add to cart
	 * @param string $cart_item_key
	 */
	public function after_add( $cart_item_key = '' ) {
		add_action( 'get_header', array( &$this, 'redirect_to_url' ) );
	}
	public function redirect_to_url() {
		if ( $this->redirect_only_single_product ) {
			if ( is_singular( 'product' ) ) {
				wp_redirect( $this->url );
				exit;
			}
		} else {
			wp_redirect( $this->url );
			exit;
		}
	}
}
