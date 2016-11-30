<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<aside id="sidebar" class="<?php echo odin_classes_page_sidebar_aside(); ?>" role="complementary">
	<?php
		if ( ! is_page_template( 'page-wc.php' ) ) {
			dynamic_sidebar( 'main-sidebar' );
		}
	?>
	<div class="woocommerce-checkout-review-order-table col-md-12">
	</div><!-- .woocommerce-checkout-review-order-table col-md-12 -->
</aside><!-- #sidebar -->
