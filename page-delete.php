<?php
/**
 * Template Name: Custompage mine.
 *
 *
 * @package Odin
 * @since 2.2.0
 */
get_header();
?>

<div class="container-fluid">
	<?php while( have_posts() ) : the_post(); ?>

				<?php the_content();?>

	<?php
	endwhile; ?>
</div>

	<?php get_footer(  );
