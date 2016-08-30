<?php
/**
 * Template Name: Menu Page
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
		<div class="box">

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

				<?php the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' ); ?>

				<div class="entry-content line col-md-6 col-xs-10">
						<?php the_content();?>
				</div>
				<?php
						endwhile;
					endif;
				?>
				<?php if ( $value = get_post_meta( get_the_ID(), 'bottom_text', true ) ) : ?>
					<div class="container entry-btt-txt">
						<div class="bottom-text col-md-6 col-xs-10">
								 <?php echo apply_filters( 'bottom_text', $value );
				?>		</div>
					</div>
				<?php endif; ?>

		</div>
	</main><!-- #main -->

<?php
get_footer();
