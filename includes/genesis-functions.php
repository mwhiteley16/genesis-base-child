<?php
/*
 * Cache bust stylesheet
 *
 * Function appends datetimestamp at end of stylesheet url when file is updated
 * This will cache bust each time file is updated
 *
*/
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'wd_genesis_child_stylesheet' );
function wd_genesis_child_stylesheet() {

	$theme_name = defined('CHILD_THEME_NAME') && CHILD_THEME_NAME ? sanitize_title_with_dashes(CHILD_THEME_NAME) : 'child-theme';
	$stylesheet_uri = get_stylesheet_directory_uri() . '/style.css';
	$stylesheet_dir = get_stylesheet_directory() . '/style.css';
	$last_modified = date ( "njYHi", filemtime( $stylesheet_dir ) );

	wp_enqueue_style( $theme_name, $stylesheet_uri, array(), $last_modified );

}

/*
 * Rename Genesis Menus
 *
 * Rename the default menus as needed
 *
*/
add_theme_support( 'genesis-menus', array(
	'primary' => __( 'Primary Navigation Menu', 'genesis-sample' ),
	'secondary' => __( 'Footer Menu', 'genesis-sample' )
) );

/*
 * Remove unused Genesis items
 *
*/

// Sub navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

// Page templates
add_filter( 'theme_page_templates', 'wd_remove_genesis_page_templates' );
function wd_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

// Page Layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Widget Areas
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'footer-1' );
unregister_sidebar( 'footer-2' );
unregister_sidebar( 'footer-3' );

// Content-sidebar Div
add_filter( 'genesis_markup_content-sidebar-wrap_open', '__return_false' );
add_filter( 'genesis_markup_content-sidebar-wrap_close', '__return_false' );

/*
 * Register additional sidebars
 *
*/
//genesis_register_sidebar(array(
//	'name'=>'Footer 1',
//	'id' => 'footer-widget-1',
//	'description' => 'Footer widget number 1.',
//	'before_widget' => '<div class="widget-wrap %2$s">',
//	'after_widget'  => "</div>\n",
//	'before_title'  => '<h3 class="widgettitle">',
//	'after_title'   => "</h3>\n"
//));

/*
 * Remove default Genesis header
 * Replace with custom header found in sections/header in child theme
 *
*/
remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'genesis_do_new_header' );
function genesis_do_new_header() {
     get_template_part( 'sections/header' );
}

/*
 * Move navigation within header wrap
 *
*/
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

/*
 * Remove default Genesis footer
 * Replace with custom footer found in sections/footer in child theme
 *
*/
//* GENESIS -- Remove default footer and replace with custom footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'genesis_do_new_footer' );
function genesis_do_new_footer() {
     get_template_part( 'sections/footer' );
}

/*
 * Remove default Genesis comment form allowed tags
 *
*/
add_filter( 'comment_form_defaults', 'bg_remove_comment_form_allowed_tags' );
function bg_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}
