<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
		<footer id="footer" role="contentinfo">
				<div class="container-fluid">
					<div class="col-md-12">
						<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
							<?php dynamic_sidebar( 'footer-sidebar' );?>
						<?php endif;?>
						<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-sidebar-2' );?>
						<?php endif;?>
						<?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-sidebar-3' );?>
						<?php endif;?>
						<?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
							<?php dynamic_sidebar( 'footer-sidebar-4' );?>
						<?php endif;?>



					</div>

				</div><!-- .container -->
			</footer><!-- #footer -->

		</div><!-- .row -->
	</div><!-- #wrapper -->



	<?php wp_footer(); ?>


</body>
</html>
