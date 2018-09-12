<?php
/**
 * Functions
 *
 * @package      base-child-theme
 * @since        1.0.0
 * @author       Matt Whiteley <matt@whiteleydesigns.com>
 * @copyright    Copyright (c) 2018, Matt Whiteley
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Base Child Theme' );
define( 'CHILD_THEME_URL', 'http://whiteleydesigns.com/' );
define( 'CHILD_THEME_VERSION', '2.0.0' );

//* Add Proper Theme Support Options
add_theme_support( 'html5' );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Ensure jQuery loads
add_action('init', 'wd_load_scripts', 0);
function wd_load_scripts() {
	wp_enqueue_script( 'jquery' );
}

//* Register & Enqueue Additional Scripts
add_action( 'wp_enqueue_scripts', 'wd_enqueue_scripts' );
function wd_enqueue_scripts() {

	//Google Fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i|Niconne|Lora:400,400i,700,700i|Parisienne', array(), CHILD_THEME_VERSION );

	// Flickity Slideshow Script
     //wp_register_script( 'flickity', get_stylesheet_directory_uri() . '/js/flickity.pkgd.min.js', array('jquery'), '1.9.3', true ); // flickity
     //wp_enqueue_script( 'flickity' );

	// Whiteley Designs Slideshow Script
     //wp_register_script('wd-slideshow', get_stylesheet_directory_uri() . '/js/wd-slideshow.js' ); // WD Slideshow
     //wp_enqueue_script( 'wd-slideshow' );

}

//* allow SVG uploads and fix back end media styling for SVGs
//add_filter('upload_mimes', 'wd_mime_types');
function wd_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
//add_action('admin_head', 'wd_admin_head');
function wd_admin_head() {
	$css = '';
	$css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';
	echo '<style type="text/css">'.$css.'</style>';
}

//* Add custom logo to login page (optional)
//add_action('login_head', 'wd_login_logo');
function wd_login_logo() {
	echo '<style type="text/css">
	h1 a {background-image: url('.get_stylesheet_directory_uri().'/images/logo-name-here.png) !important; }
	</style>';
}

//* Remove admin bar for non-admins
add_action('after_setup_theme', 'wd_remove_admin_bar');
function wd_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
  		show_admin_bar(false);
	}
}

//* Call each function file from the functions directory
require_once( __DIR__ . '/includes/widget-functions.php');
require_once( __DIR__ . '/includes/genesis-functions.php');
require_once( __DIR__ . '/includes/gravityforms-functions.php');
require_once( __DIR__ . '/includes/acf-functions.php');
