<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';
// carrega os fields do odin
require_once get_template_directory() . '/inc/odin-fields.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';
require_once get_template_directory() . '/inc/custom-widgets.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Footer 1', 'odin' ),
			'id' => 'footer-sidebar',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '<div class="footerMenu col-md-3">',
			'after_widget' => '</div>',
			'before_title' => '<span class="footerMenuTitle">',
			'after_title' => '</span>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Footer 2', 'odin' ),
			'id' => 'footer-sidebar-2',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '<div class="footerMenu col-md-3">',
			'after_widget' => '</div>',
			'before_title' => '<span class="footerMenuTitle">',
			'after_title' => '</span>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Footer 3', 'odin' ),
			'id' => 'footer-sidebar-3',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '<div class="footerMenu col-md-3">',
			'after_widget' => '</div>',
			'before_title' => '<span class="footerMenuTitle">',
			'after_title' => '</span>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Footer 4', 'odin' ),
			'id' => 'footer-sidebar-4',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '<div class="footerMenu col-md-3">',
			'after_widget' => '</div>',
			'before_title' => '<span class="footerMenuTitle">',
			'after_title' => '</span>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'WooCommerce Pages', 'odin' ),
			'id' => 'wc-pages-sidebar',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '<div class="col-md-12 wc-pages-sidebar>',
			'after_widget' => '</div>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	//Slider
	wp_enqueue_style( 'fullpage', $template_url . '/assets/css/jquery.fullpage.min.css', array(), null, 'all' );
	wp_enqueue_style( 'selector', $template_url . '/assets/css/selectric.css', array(), null, 'all' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );


	// Grunt main file with Bootstrap, FitVids and others libs.
	wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	wp_localize_script( 'odin-main-min', 'odin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}

/**
 * Load customizer fields + Kirki
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Advanced Custom Fields
 */
require_once get_template_directory() . '/inc/acf/acf.php';
require_once get_template_directory() . '/inc/fields.php';

/**
 * Load Appointment stuff
 */
require_once get_template_directory() . '/inc/appointment-form-loader-class.php';
require_once get_template_directory() . '/inc/appointment-form-class.php';

/**
 * Remove admin bar on dev & localhost server
 * @return null
 */
function remove_admin_bar_on_dev() {
	$site_url = home_url();
	if ( isset( $_GET[ 'show_wpheader' ] ) ) {
		return;
	}
	if ( strstr( $site_url, 'dev.' ) ) {
		show_admin_bar( false );
		return;
	}
	if ( strstr( $site_url, 'localhost' ) ) {
		show_admin_bar( false );
		return;
	}

}
add_action( 'init', 'remove_admin_bar_on_dev', 9999 );

/**
 * Show widget cart on checkout
 * @param boolean $show
 * @return boolean
 */

function show_widget_cart_on_checkout( $show ) {
	return true;
}
add_filter( 'woocommerce_widget_cart_is_hidden', 'show_widget_cart_on_checkout' );


add_filter( 'woocommerce_checkout_fields' , 'custom_billing_fields' );



function custom_billing_fields( $fields )  {
	$fields['billing']['billing_company']['placeholder'] = 'Company';
	$fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	$fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	$fields['billing']['billing_email']['placeholder'] = 'Email';
	$fields['billing']['billing_phone']['placeholder'] = 'Phone';
	$fields['billing']['billing_address_1']['placeholder'] = 'Street';
	$fields['billing']['billing_address_2']['placeholder'] = 'Number';
	$fields['billing']['billing_postcode']['placeholder'] = 'Postcode';
	$fields['billing']['billing_city']['placeholder'] = 'City';
	unset($fields['billing']['billing_company']);


	return $fields;
}

