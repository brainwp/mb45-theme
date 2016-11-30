<?php
/**
 * Template Name: Appointment
 *
 *
 * @package Odin
 * @since 2.2.0
 */
get_header( 'shop' );
?>
<div class="container-fluid">
	<?php while( have_posts() ) : the_post(); ?>


		<!-- PAGE TITLE, INFORMATIONS -->
	    <section class="initial-informations">
			<header class="product-infos col-md-12">

					<div class="col-md-6 product-title">

						<span class="general-title">
							<?php _e( 'Book Appointment', 'odin' );?>
						</span>

					</div>
					<div class="col-md-6 pull-right checkout-steps">
						<?php for ( $i = 1; $i < 4; $i++ ) : ?>
							<span class="each-step <?php echo is_current_step( $i );?>">
								<?php printf( __( 'Step %s', 'odin' ), $i );?>
							</span>
						<?php endfor;?>
					</div>

			</header>


			<div class="product-description col-md-3">
					<?php the_content();?>
					<?php wc_print_notices();?>
			</div>

		</section>
		<!-- END: PAGE TITLE, INFORMATIONS -->



		<!-- GENERAL FORM -->
		<form class="col-md-12 form-appo" id="page-appointment" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="is-appointment-form" value="true" />
			<?php if ( $value = get_post_meta( get_the_ID(), 'appointment_product', true ) ) : ?>
				<input type="hidden" name="appointment-product" value="<?php echo $value[0];?>" />
				<?php global $product, $post;
				$product_id = $value[0];
				$product = wc_get_product( $product_id );
				$post = get_post( $product_id );
				$form = new MB45_Change_Appointment_Form_Loader( $product );

			else : ?>
				<?php _e( 'Oooops, the appointment product is not set yet!', 'odin' );?>
				<?php wp_die();?>
			<?php endif;?>

			<!-- AREA 1 -->
			<div class="col-md-4 select-field">
				<label>
					<?php _e( 'How many guests?', 'odin' );?>
				</label>
				<div class="select-area col-md-7">
					<select name="guests-num" class="select-guest">
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
				</div>
			</div>
			<!-- END: AREA 1 -->

			<div class="col-md-4 control">
				<?php for ( $i = 0; $i < 1; $i++ ) : ?>
					<?php $style = '';
						$value = 'false';
						if ( $i > 0 ) {
							$style = sprintf( 'style="display:none;"');
							$value = 'true';
						}
					?>


					<!-- AREA 2 -->
					<div class="col-md-12 each-customer" <?php echo $style;?> id="customer-<?php echo $i;?>" data-customer="<?php echo $i;?>">
						<input type="hidden" name="selected[<?php echo $i;?>]" value="<?php echo $value;?>" id="is-selected-<?php echo $i;?>" />
						<div class="select-field">
							<div class="select-field col-md-12">
								<?php _e( '<label>When?</label>', 'odin' );?>
								<?php printf( __( '<div class="select-area col-md-7"><a href="#" class="btn show-options-btn col-md-12" data-show="false" data-id="#show-%s">Choose a date</a></div>', 'odin' ), $id );
								printf( '<div id="show-%s" class="col-md-7 show-options" style="display:none;">', $id );
									$form->output();
								echo '</div>';?>
							</div>

							<div class="col-md-3 custom-fields pull-right" id="appointment-custom-fields-<?php echo $i;?>"></div>
						</div>
					</div>
					<!-- END: AREA 2 -->



					<!-- END CALENDAR -->


<!-- CALENDAR -->
				<?php endfor;?>
			</div>
			<div class="col-md-8 select-field appointment-date-fields">
				<?php $GLOBALS['Product_Addon_Display']->display();?>
			</div>

			<div class="col-md-4 tes">
				<input type="submit" value="<?php _e( 'Next', 'odin' );?>" class="primary nxt-step col-md-8 pull-right" id="send-step-1">
			</div>
		</form>
		</div>

		<!-- END: GENERAL FORM -->

	<?php
	endwhile; ?>
</div>
	<?php get_footer( 'shop' );
