<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h3 class="entry-title">
			<a href="<?php the_permalink();?>">
				<?php the_title();?>
			</a>
		</h3><!-- .entry-title -->
	</header><!-- .entry-header -->

	<div class="entry-content line col-md-6 col-xs-10">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
