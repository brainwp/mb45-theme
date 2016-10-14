<?php
/**
 * Template Name: Hair Page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

<div id="fullpage-hair">
	<?php $args = array(
			'post_type'      =>  'page',
			'posts_per_page'	=> 500,
			'post_parent'		=> get_the_ID(),
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC'

		);
	$query = new WP_Query($args);
	?>
	<?php if( $query -> have_posts() ) : ?>
		<?php while( $query -> have_posts() ): $query -> the_post(); ?>
	<div class="section">
		<div class="container-fluid">
			<div class="hold">
				<div class="hair-name">
					<?php the_content(); ?>
					<!-- <span>DOWN</span><span> 1</span> -->
				</div>
				<?php if ( $value = get_post_meta( get_the_ID(), 'gallery_hair', true ) ) : ?>
					<?php $images = explode( ',', $value );?>
					<?php if ( is_array( $images ) && ! empty( $images ) ) : ?>
							<div class="row">
								<?php $i = 0;?>
								<?php foreach( $images as $image_id ) : ?>
									<?php $image = wp_get_attachment_image_src( $image_id, 'large' ); ?>
									<?php if ( ! $image || ! is_array( $image ) ) {
										continue;
									}?>
									<?php if ( $i == 2 ) : ?>
										</div>
										<div class="row hidden-xs">
									<?php endif;?>
									<?php $style = sprintf( 'background-image:url( %s );', $image[0] );?>
									<div class="col-md-6 each-image" style="<?php echo esc_attr( $style );?>"></div>
									<?php $i++;?>
								<?php endforeach;?>
							</div>
						<?php endif;?>
				<?php endif;?>

			</div>
		</div>
		<!-- //MOBILE -->
		<div class="col-xs-12 hair-nameM hidden-lg-down">
				<?php the_content(); ?>
		</div>

	</div>
		<?php wp_reset_postdata();?>
		<?php endwhile;?>
	<?php endif; ?>

	<div class="section fp-auto-height">
		<?php get_footer();?>
	</div>

</div>


