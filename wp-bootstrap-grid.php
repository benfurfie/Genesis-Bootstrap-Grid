<?php
/*
 * Plugin Name: Genesis Bootstrap Grid
 * Plugin URI: https://github.com/benfurfie/Genesis-Bootstrap-Grid
 * 
 * Description: Adds the Bootstrap Grid to Genesis websites
 * Version: 0.2.2
 * 
 * Author: Ben Furfie
 * Author URI: www.benfurfie.co.uk
 * 
 * License: GPL2
 * 
 */

//* Disable access to the plugin file
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	die('Sorry, but you can not access this page directly.');
}

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );


//* Adds the functionname section to the page template
add_action( 'wp_enqueue_scripts', 'gbg_enqueue_style' );
function gbg_enqueue_style() {
	wp_enqueue_style( 'bf-wpbscss', plugins_url('css/style.css', __FILE__) );
}

// Genesis Specific Code
// Overwrites the default Genesis structural CSS to ensure the Bootstrap Grid works correctly. 

// Adds container classes to header
add_filter( 'genesis_attr_site-header', 'gbg_attr_site_header' );
function gbg_attr_site_header() {
	// add original plus extra CSS classes
	$attributes['class'] .= 'site-header container-fluid';
	// return the attributes
	return $attributes;
}
/*
// Adds row classes to structural
add_filter( 'genesis_attr_wrap', 'gbg_attr_wrap_to_row' );
function gbg_attr_wrap_to_row() {
	// add original plus extra CSS classes
	$attributes['class'] .= 'row';
	// return the attributes
	return $attributes;
}*/

// Adds container to the site-inner class
add_filter( 'genesis_attr_site-inner', 'gbg_attr_container' );
function gbg_attr_container( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' container';
	// return the attributes
	return $attributes;
}

add_filter( 'genesis_attr_content-sidebar-wrap', 'gbg_attributes_content_sidebar_wrap' );
function gbg_attributes_content_sidebar_wrap( $attributes ) {
    $attributes['class'] = 'row';
    return $attributes;
}

add_filter( 'genesis_attr_structural-wrap', 'gbg_attributes_structural_wrap' );
function gbg_attributes_structural_wrap( $attributes ) {
	$attributes['class'] = 'row';
	return $attributes;
}


/* Removes the content-sidebar-wrap class and replaces it with row
add_filter( 'genesis_attr_content-sidebar-wrap', 'gbg_attr_row' );
function gbg_attr_row( $attributes ) {
	// Removes wrap and adds row instead
	$attributes['class'] = 'row';
	// return the attributes
	return $attributes;
} */