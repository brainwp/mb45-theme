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
		<?php if ( is_singular() ) : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink();?>">
					<?php the_title();?>
				</a>
			</h1><!-- .entry-title -->
		<?php else : ?>
			<h3 class="entry-title">
				<a href="<?php the_permalink();?>">
					<?php the_title();?>
				</a>
			</h3><!-- .entry-title -->
		<?php endif;?>
	</header><!-- .entry-header -->

	<div class="entry-content line col-md-8 col-xs-10">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
	<?php if( is_singular() && comments_open() ) : ?>
		<div class="entry-content line col-md-8 col-xs-10">
			<?php comments_template();?>
		</div><!-- .entry-content line col-md-6 col-xs-10 -->
	<?php endif;?>
</article><!-- #post-## -->
