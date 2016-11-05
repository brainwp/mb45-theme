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
			</div>
		</section>
		<form class="col-md-12 form-appo" id="page-appointment" method="post" enctype="multipart/form-data">
			<input type="hidden" name="is-appointment-form" value="true" />
			<div class="col-md-12 select-field">
				<label>
					<?php _e( 'How many guests?', 'odin' );?>
				</label>
				<div class="select-area col-md-2">
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
			</div><!-- .col-md-12 select-field -->
			<?php for ( $i = 0; $i < 3; $i++ ) : ?>
				<?php $style = '';
				$value = 'false';
				if ( $i > 0 ) {
					$style = sprintf( 'style="display:none;"');
					$value = 'true';
				}
				?>
				<div class="col-md-12 each-customer" <?php echo $style;?> id="customer-<?php echo $i;?>" data-customer="<?php echo $i;?>">
					<input type="hidden" name="selected[<?php echo $i;?>]" value="<?php echo $value;?>" id="is-selected-<?php echo $i;?>" />
					<h3 class="guest-name">
						<?php if ( $i == 0 ) : ?>
							<?php _e( 'You', 'odin' );?>
						<?php else : ?>
							<?php printf( __( 'Guest %s', 'odin' ), $i );?>
						<?php endif;?>
					</h3>
					<div class="col-md-9 pull-left select-field">
						<div class="col-md-5 select-field">
							<label><?php _e( 'Não sei a label disso', 'odin' );?></label>
							<?php $terms = get_terms( array( 'product_cat' ), array( 'hide_empty' => true ) );?>
							<?php if ( $terms && is_array( $terms ) ) : ?>
							<select name="product_id[<?php echo $i;?>]" class="product-id-select col-md-2 select-guest" data-num="<?php echo $i;?>">
								<option value="" selected>
									<?php _e( 'Select a product', 'odin' );?>
								</option>
								<?php foreach ( $terms as $term ) : ?>
									<?php $args = array(
										'post_type' 	=> 'product',
										'product_cat'	=> $term->slug
									);
									$query = new WP_Query( $args );?>
									<optgroup label="<?php echo apply_filters( 'the_title', $term->name );?>">
										<?php if ( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();?>
											<option value="<?php echo get_the_ID();?>">
												<?php the_title();?>
											</option>
										<?php endwhile; endif;?>
										<?php wp_reset_postdata();?>
									</optgroup>
								<?php endforeach;?>
							</select>
							<?php endif;?>
						</div><!-- .col-md-12 select-field -->
						<div class="col-md-4 select-field appointment-date-fields" id="appointment-fields-<?php echo $i;?>">
						</div><!-- .col-md-4 pull-right select-field -->
						<div class="col-md-3 custom-fields pull-right" id="appointment-custom-fields-<?php echo $i;?>"></div><!-- .col-md-3 custom-fields -->
					</div><!-- .col-md-5 pull-left select-field -->
				</div><!-- .col-md-12 each-customer -->
			<?php endfor;?>
			<button class="primary" id="send-step-1"><?php _e( 'Next', 'odin' );?></button>
		</form><!-- #page-appointment.col-md-12 -->

	<?php
	endwhile; ?>
</div>
	<?php get_footer( 'shop' );