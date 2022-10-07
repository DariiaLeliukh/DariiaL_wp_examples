<?php
/**
 * riverviewhc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package riverviewhc
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'riverviewhc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function riverviewhc_setup() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'riverviewhc' ),
				'top-nav' => esc_html__( 'Top Navigation', 'riverviewhc' ),
				'footer-1' => esc_html__( 'Footer 1', 'riverviewhc' ),
				'footer-2' => esc_html__( 'Footer 2', 'riverviewhc' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'riverviewhc_setup' );

// Custom Menu Walker
include( get_template_directory() . '/inc/classes.php' );

// Scripts
include( get_template_directory() . '/inc/scripts.php' );

// Script file
include( get_template_directory() . '/inc/ajax/example.php' );

// Sidebars
include( get_template_directory() . '/inc/sidebars.php' );

// Theme Functions
include( get_template_directory() . '/inc/theme_functions.php' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

