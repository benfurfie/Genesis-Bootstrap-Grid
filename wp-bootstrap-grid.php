<?php
/*
 * Plugin Name: Genesis Bootstrap Grid
 * Plugin URI: https://github.com/benfurfie/Genesis-Bootstrap-Grid
 * 
 * Description: Adds the Bootstrap Grid to Genesis websites
 * Version: 0.2.3
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
add_filter( 'genesis_attr_site-header', 'gbg_attr_site_header', 99 );
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
add_filter( 'genesis_attr_site-inner', 'gbg_attr_container', 99 );
function gbg_attr_container( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' container';
	// return the attributes
	return $attributes;
}

add_filter( 'genesis_attr_structural-wrap', 'gbg_attributes_structural_wrap', 99 );
function gbg_attributes_structural_wrap( $attributes ) {
	$attributes['class'] = 'row';
	return $attributes;
}

// Amends the output of the site-header section.

add_filter( 'genesis_markup_site-header_output', 'gbg_header_new_markup', 99, 2 );
/**
 * Add container to Genesis header. [H/T Chinmoy Paul | https://github.com/cpaul007]
 *
 * @since 0.2.3
 *
 */
function gbg_header_new_markup( $tag, $args ) {
  $tag .= '<div class="container">' . "\n";
  
  return $tag;
}

add_action( 'genesis_header', 'gbg_header_new_div_close', 15 );
/**
 * Add container to Genesis header. [H/T Chinmoy Paul | https://github.com/cpaul007]
 *
 * @since 0.2.3
 *
 */
function gbg_header_new_div_close() {
  echo '</div>' . "\n";
}

// Amends the output of the primary nav.

add_filter( 'genesis_markup_nav-primary_output', 'gbg_nav_primary_new_markup', 99, 2 );
/**
 * Add container to the Primary Nav
 *
 * @since 0.2.3
 *
 */
function gbg_nav_primary_new_markup( $tag, $args ) {
  $tag .= '<div class="container">' . "\n";
  
  return $tag;
}

add_action( 'genesis_header', 'gbg_nav_primary_new_div_close', 15 );
/**
 * Add container to the Primary Nav
 *
 * @since 0.2.3
 *
 */
function gbg_nav_primary_new_div_close() {
  echo '</div>' . "\n";
}

// Amends the output of the primary nav.

add_filter( 'genesis_markup_site-footer_output', 'gbg_footer_new_markup', 99, 2 );
/**
 * Add container to the Primary Nav
 *
 * @since 0.2.3
 *
 */
function gbg_footer_new_markup( $tag, $args ) {
  $tag .= '<div class="container">' . "\n";
  
  return $tag;
}

add_action( 'genesis_footer', 'gbg_footer_new_div_close', 15 );
/**
 * Add container to the Primary Nav
 *
 * @since 0.2.3
 *
 */
function gbg_footer_new_div_close() {
  echo '</div>' . "\n";
}

add_filter( 'genesis_attr_content', 'gbg_attributes_content', 99 );
function gbg_attributes_content( $attributes ) {
    $attributes['class'] = 'content col-sm-9';
    return $attributes;
}

remove_filter( 'genesis_attr_sidebar-primary', 'genesis_attributes_sidebar_primary' );
add_filter( 'genesis_attr_sidebar-primary', 'gbg_sidebar_primary', 99 );
function gbg_sidebar_primary( $attributes ) {
	$attributes['class']     = 'col-sm-3 sidebar sidebar-primary widget-area';
	$attributes['role']      = 'complementary';
	$attributes['itemscope'] = '';
	$attributes['itemtype']  = '';
	return $attributes;
}