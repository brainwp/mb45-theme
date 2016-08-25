<?php
/**
 * Template Name: About Me Page
 *
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>
	<!-- <?php echo odin_classes_page_full(); ?> -->
	<main id="content" class="" tabindex="-1" role="main">
		<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			?>
		<div class="box col-md-12">

				<?php
					$args = array(
						'post_parent' => get_the_ID(),
						'post_type' => 'page'
						);

					$posts = new WP_Query($args);

					if ($posts -> have_posts()):
						while($posts -> have_posts()):
							$posts -> the_post();

				?>
			<div class="subBox col-md-4">
				<div class="person">
					<div class="imageLimiter">
						<img src="<?php the_post_thumbnail_url();?>" class="personImg">
					</div>
					<span class="nameBout col-md-7">
						<span class="nameB">
							<?php the_title();?>
						</span>
						<span class="bout">
							<?php
								if ( $value = get_post_meta( get_the_ID(), 'sub_title', true ) ) : echo apply_filters( 'the_title', $value ); endif;?>
						</span>
					</span>
				</div>
				<div class="pageContent">
					<?php the_content();?>
				</div>
			</div>
				<?php
						endwhile;
					endif;
				?>

		</div>
	</main><!-- #main -->

<?php
get_footer();
