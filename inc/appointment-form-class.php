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

		// process form
		add_action( 'get_header', array( &$this, 'process_form' ) );

		// scripts
		add_action( 'init', array( &$this, 'scripts' ), 9999 );
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
		$form->scripts();
		echo '<div class="custom-fields-temp" style="display:none;">';
			$form->output();
		echo '</div>';
		wp_die();
	}
	/**
	 * Validate post data
	 * @return boolean
	 */
	private function validate_post_data() {
		if ( ! isset( $_POST[ 'wc_appointments_field_start_date_time'] ) ) {
			return false;
		}
		if ( empty( $_POST[ 'wc_appointments_field_start_date_time'] ) ) {
			return false;
		}
		if ( ! isset( $_POST[ 'wc_appointments_field_start_date_year'] ) ) {
			return false;
		}
		if ( empty( $_POST[ 'wc_appointments_field_start_date_year'] ) ) {
			return false;
		}
		if ( ! isset( $_POST[ 'wc_appointments_field_start_date_month'] ) ) {
			return false;
		}
		if ( empty( $_POST[ 'wc_appointments_field_start_date_month'] ) ) {
			return false;
		}
		if ( ! isset( $_POST[ 'wc_appointments_field_start_date_day'] ) ) {
			return false;
		}
		if ( empty( $_POST[ 'wc_appointments_field_start_date_day'] ) ) {
			return false;
		}

		// if all fields are ok, send true
		return true;
	}
	/**
	 * Load appointment scripts on front-end
	 * @return null
	 */
	public function scripts() {

		wp_enqueue_script( 'jquery-blockui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

		wp_enqueue_script( 'wc-appointments-appointment-form', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/appointment-form' . $suffix . '.js', array( 'jquery', 'jquery-blockui' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-timezone', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/timezone' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-staff-picker', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/staff-picker' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_script( 'wc-appointments-select2', WC_APPOINTMENTS_PLUGIN_URL . '/assets/js/select2' . $suffix . '.js', array( 'wc-appointments-appointment-form' ), WC_APPOINTMENTS_VERSION, true );
		wp_enqueue_style( 'dashicons' );
	}
	/**
	 * Process appointment form
	 * @return null
	 */
	public function process_form() {
		if ( ! isset( $_REQUEST[ 'is-appointment-form'] ) ) {
			return;
		}
		// Make a backup of global $_POST var
		$posted_data = $_POST;
		$guests = intval( $_REQUEST[ 'guests-num' ] );
		$guests++;
		$has_notice = false;
		for ( $guest = 0; $guest < 1; $guest++ ) {
			// Empty global $_POST and then add each variable
			$_POST = array();
			foreach ( $_REQUEST as $key => $value ) {
				if ( is_array( $_REQUEST[ $key ] ) && isset( $_REQUEST[ $key ][ $guest ] ) ) {
					$_POST[ $key ] = $_REQUEST[ $key ][ $guest ];
				}
			}
			if ( $this->validate_post_data() ) {
				WC()->cart->add_to_cart( $_POST[ 'product_id'] );
			} else {
				wc_add_notice( __( 'The date is not filled in correctly', 'odin' ), 'error' );
			}
		}
		// Restore original $_POST;
		$_POST = $posted_data;
	}
}
new MB45_Appointment_Form();
