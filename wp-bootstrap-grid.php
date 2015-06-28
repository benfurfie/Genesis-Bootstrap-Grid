<?php
/*
 * Plugin Name: WordPress Bootstrap Grid
 * Plugin URI: www.benfurfie.co.uk/wp-bootstrap-grid
 * 
 * Description: Adds the Bootstrap Grid to Genesis websites
 * Version: 0.2
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

//* Adds the functionname section to the page template
add_action( 'wp_enqueue_scripts', 'bf_enqueue_style' );
function bf_enqueue_style() {
	wp_enqueue_style( 'bf-wpbscss', plugins_url('css/style.css', __FILE__) );
}

// Genesis Specific Code
// Overwrites the default Genesis structural CSS to ensure the Bootstrap Grid works correctly. 

// Adds container to the site-inner class
add_filter( 'genesis_attr_site-inner', 'ic_attr_container' );
function ic_attr_container( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' container';
	// return the attributes
	return $attributes;
}

// Removes the content-sidebar-wrap class and replaces it with row
add_filter( 'genesis_attr_content-sidebar-wrap', 'ic_attr_row' );
function ic_attr_row( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] = 'row';
	// return the attributes
	return $attributes;
}