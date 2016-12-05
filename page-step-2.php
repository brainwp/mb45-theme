<?php
/**
 * Template Name: Step 2/Step 3
 *
 *
 * @package Odin
 * @since 2.2.0
 */
get_header( 'shop' );
$wc_content_col = 'col-md-7 wc-content';
if ( is_wc_endpoint_url( 'order-received' ) ) {
	$wc_content_col = 'col-md-12 wc-content';
}
?>
<div class="container-fluid">
	<?php while( have_posts() ) : the_post(); ?>


		<!-- PAGE TITLE, INFORMATIONS -->
	    <section class="initial-informations">
			<header class="product-infos col-md-12">

					<div class="col-md-6 product-title">

						<span class="general-title">
						<a href="#" class="col-md-12 back-button" style="display:none;">
				<?php _e( '< Back', 'odin' );?>
			</a>
							<?php _e( 'Book Appointment', 'odin' );?>
						</span>

					</div>
					<div class="col-md-6 pull-right checkout-steps">
						<?php for ( $i = 1; $i < 4; $i++ ) : ?>
							<span class="each-step <?php echo is_current_step( $i );?>" data-step="<?php $i;?>">
								<?php printf( __( 'Step %s', 'odin' ), $i );?>
							</span>
						<?php endfor;?>
					</div>

			</header>


			<!-- <div class="product-description col-md-12">
				<?php wc_print_notices();?>
			</div> -->

		</section>

		<div class="<?php echo $wc_content_col;?>">

			<?php the_content();?>
		</div><!-- .col-md-12 wc-content -->
		<?php if ( ! is_wc_endpoint_url( 'order-received' ) ) : ?>
			<div class="col-md-5 mini-cart woocommerce-checkout-review-order">
				<div class="col-md-9 cart-e">

					<span class="book-summary"><?php _e( 'Booking Summary', 'odin' );?></span>
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>



				</div>
				<a href="#" class="submit-checkout col-md-9" data-step2="<?php esc_attr_e( 'Make Payment', 'odin' );?>" data-step3="<?php esc_attr_e( 'Confirm', 'odin' );?>" data-current="2">
						<?php _e( 'Make Payment', 'odin' );?>
				</a>
			</div><!-- .col-md-4 pull-right mini-cart -->
		<?php endif;?>
		<!-- END: PAGE TITLE, INFORMATIONS -->

	<?php
	endwhile; ?>
</div>
	<?php get_footer( 'shop' );
