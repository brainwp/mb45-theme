<?php
/**
*
*/
class MB45_Change_Appointment_Form_Loader extends WC_Appointment_Form {
/**
	 * Appointment form scripts
	 */
	public function scripts() {
		global $wp_locale;

		// Variables for JS scripts
		$appointment_form_params = array(
			'closeText'						=> __( 'Close', 'woocommerce-appointments' ),
			'currentText'					=> __( 'Today', 'woocommerce-appointments' ),
			'prevText'						=> __( 'Previous', 'woocommerce-appointments' ),
			'nextText'						=> __( 'Next', 'woocommerce-appointments' ),
			'monthNames'					=> array_values( $wp_locale->month ),
			'monthNamesShort'				=> array_values( $wp_locale->month_abbrev ),
			'dayNames'						=> array_values( $wp_locale->weekday ),
			'dayNamesShort'					=> array_values( $wp_locale->weekday_abbrev ),
			'dayNamesMin'					=> array_values( $wp_locale->weekday_initial ),
			'firstDay'						=> get_option( 'start_of_week' ),
			'current_time'					=> date( 'Ymd', current_time( 'timestamp' ) ),
			'availability_span' 			=> $this->product->wc_appointment_availability_span,
			'duration_unit'					=> $this->product->wc_appointment_duration_unit,
			'has_staff'       		 		=> $this->product->has_staff(),
			'staff_assignment'       		=> ! $this->product->has_staff() ? 'customer' : $this->product->get_staff_assignment_type(),
			'nonce_staff_html'				=> wp_create_nonce( 'appointable-staff-html' ),
			'is_autoselect'       		 	=> $this->product->wc_appointment_availability_autoselect,
			'ajax_url'						=> admin_url( 'admin-ajax.php' ),
			'i18n_date_unavailable'			=> __( 'This date is unavailable', 'woocommerce-appointments' ),
			'i18n_date_fully_scheduled'		=> __( 'This date is fully scheduled and unavailable', 'woocommerce-appointments' ),
			'i18n_date_partially_scheduled'	=> __( 'This date is partially scheduled - but appointments still remain', 'woocommerce-appointments' ),
			'i18n_date_available'			=> __( 'This date is available', 'woocommerce-appointments' ),
			'i18n_start_date'				=> __( 'Choose a Start Date', 'woocommerce-appointments' ),
			'i18n_end_date'					=> __( 'Choose an End Date', 'woocommerce-appointments' ),
			'i18n_dates'					=> __( 'Dates', 'woocommerce-appointments' ),
			'i18n_choose_options'			=> __( 'Please select the options for your appointment above first', 'woocommerce-appointments' ),
			'chooseTime'					=> __( 'Choose Hour', 'odin' ),
			'selectedText'					=> __( 'MM/DD/AAAA HOUR', 'odin' )
		);
		$json_params = json_encode( $appointment_form_params );
		if ( defined('DOING_AJAX') && DOING_AJAX ) {
			header( 'json-string: ' . $json_params );
		}
	}
}
