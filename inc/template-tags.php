<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar() {
		return 'col-md-9';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar_aside() {
		return 'col-md-3 hidden-xs hidden-print widget-area';
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_posted_on() {
		// Set up and print post meta information.
		echo '<div class="col-md-12 each-post-info">';
		printf( '<span class="entry-date">%s <time class="entry-date" datetime="%s">%s</time></span></span>',
			__( 'Posted in', 'odin' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		echo '</div>';
		if ( has_category() ) {
			echo '<div class="col-md-12 each-post-info">';
			printf( '<span class="post-categories">%s %s</span>',
				__( 'Categories:', 'odin' ),
				get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'odin' ) )
			);
			echo '</div>';
		}
		if ( has_tag() ) {
			echo '<div class="col-md-12 each-post-info">';
			printf( '<span class="post-categories">%s %s</span>',
				__( 'Tags:', 'odin' ),
				get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'odin' ), '', get_the_ID() )
			);
			echo '</div>';
		}

	}
}

if ( ! function_exists( 'odin_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo odin_pagination( $mid, $end, false );
	}
}

if ( ! function_exists( 'odin_the_custom_logo' ) ) {

	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Odin 2.2.10
	 */
	function odin_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}
