<?php
/**
 * Appointment product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/appointment.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<noscript><?php _e( 'Your browser must support JavaScript in order to schedule an appointment.', 'woocommerce-appointments' ); ?></noscript>

<form class="cart" method="post" enctype='multipart/form-data'>
	<div class="col-md-12 form-fields">
		<label>
			<?php _e( 'How many guests?', 'odin' );?>
		</label>
		<select name="guests-num">
			<?php for ( $i = 0; $i < 3; $i++ ) : ?>
				<option value="<?php echo esc_attr( $i );?>">
					<?php if ( $i == 0 ) : ?>
						<?php _e( 'Just me', 'odin' );?>
					<?php else: ?>
						<?php echo $i;?>
					<?php endif;?>
				</option>
			<?php endfor;?>
		</select>
	</div><!-- .col-md-12 form-fields -->
	<?php for ( $i = 0; $i < 3; $i++ ) : ?>
		<div id="wc-appointments-appointment-form-<?php echo $i;?>" class="col-md-12 wc-appointments-appointment-form" style="display:none">
 			<?php do_action( 'woocommerce_before_appointment_form_output' ); ?>

			<?php $appointment_form->output(); ?>

			<div class="wc-appointments-appointment-hook"><?php do_action( 'woocommerce_before_add_to_cart_button' ); ?></div>

			<div class="wc-appointments-appointment-cost"></div>
		</div>
	<?php endfor;?>
 	<div id="wc-appointments-appointment-form" class="col-md-12 wc-appointments-appointment-form" style="display:none">
 		<?php do_action( 'woocommerce_before_appointment_form_output' ); ?>

		<?php $appointment_form->output(); ?>

		<div class="wc-appointments-appointment-hook"><?php do_action( 'woocommerce_before_add_to_cart_button' ); ?></div>

		<div class="wc-appointments-appointment-cost"></div>

	</div>

	<?php
		/* Show quantity only when maximum qty is larger than 1 ... duuuuuuh
		 */
		if ( $product->get_qty() > 1 && $product->get_qty_max() > 1 ) {
			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_qty_min(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_qty_max(), $product ),
				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
			) );
		}
	?>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" class="wc-booking-product-id" />

 	<button type="submit" class="wc-appointments-appointment-form-button single_add_to_cart_button button alt disabled" style="display:none"><?php echo $product->single_add_to_cart_text(); ?></button>

 	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
