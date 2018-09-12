<?php
/**
 * ACF Options Page
 *
 * Add options page for ACF Fields
 *
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'position'     => '58.997', // Adds under Genesis options page
		'icon_url'     => 'dashicons-image-filter', // https://developer.wordpress.org/resource/dashicons/
		'redirect'	=> false
	));
}

/**
 * ACF Custom Fields Visibility
 *
 * Hide "Custom Fields" from WordPress dashboard except for specified user
 *
 */
add_filter( 'acf/settings/show_admin', 'wd_acf_show_admin' );
function wd_acf_show_admin( $show ) {
     $current_user = wp_get_current_user();
     if ( $current_user->user_email == 'matt@whiteleydesigns.com' ){
          return true; // show it
     } else {
          return false; // hide it
     }
}
