<?php
/**
*
*/
class MB45_Appointment_Form {
	/**
	 * Construct class
	 */
	public function __construct() {
		// add ajax for form
		add_action( 'wp_ajax_mb45_appointment_form', array( &$this, 'run_ajax_frontend' ) );
		add_action( 'wp_ajax_nopriv_mb45_appointment_form', array( &$this, 'run_ajax_frontend' ) );

		// scripts
		add_action( 'init', array( &$this, 'scripts' ) );
	}
	/**
	 * Show form on frontend
	 * @return null
	 */
	public function run_ajax_frontend() {
		if ( ! isset( $_REQUEST[ 'product_id' ] ) ) {
			return;
		}
		global $product, $post;
		$product_id = $_REQUEST[ 'product_id' ];
		$product = wc_get_product( $product_id );
		$post = get_post( $product_id );

		$form = new MB45_Change_Appointment_Form_Loader( $product );
		$form->output();
		echo '<div id="cf">';
			$GLOBALS['Product_Addon_Display']->display();
		echo '</div>';
		wp_die();
	}
	public function scripts() {

		wp_enqueue_script( 'jquery-blockui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

		wp_enqueue_script( 'wc-appointments-appointment-form', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/appointment-form' . $suffix . '.js', array( 'jquery', 'jquery-blockui' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-timezone', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/timezone' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-staff-picker', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/staff-picker' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-select2', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/select2' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_style( 'dashicons' );
	}
}
new MB45_Appointment_Form();
