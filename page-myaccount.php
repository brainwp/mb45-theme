<?php
/**
 * Template Name: MyAccount Page
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
					get_template_part( 'content', 'account' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			?>

	</main><!-- #main -->

<?php
get_footer();
