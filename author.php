<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
			get_template_part( 'content' );
		endwhile;
		// Post navigation.
		odin_paging_nav();
	?>
	</main><!-- #main -->

<?php
get_footer();
