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
				</div>

						<div class="row">
							<div class="col-md-6 image1"></div>
							<div class="col-md-6 image1"></div>
						</div>

						<div class="row hidden-xs">
							<div class="col-md-6 image1"></div>
							<div class="col-md-6 image1"></div>
						</div>



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


