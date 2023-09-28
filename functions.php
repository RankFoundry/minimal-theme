<?php
/**
 * Minimal Theme
 *
 * @package   Minimal_Theme
 * @link      https://rankfoundry.com
 * @copyright Copyright (C) 2021-2023, Rank Foundry LLC - support@rankfoundry.com
 * @since     1.0.0
 * @license   GPL-2.0+
 *
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/*--------------------------------------------------------------*/
/*---------------------- Theme Setup ---------------------------*/
/*--------------------------------------------------------------*/
// Define theme version
if (!defined('MINIMAL_THEME_VERSION')) {
    define('MINIMAL_THEME_VERSION', '1.0.5');
}

// Define theme directory path
if (!defined('MINIMAL_THEME_DIR')) {
    define('MINIMAL_THEME_DIR', trailingslashit( get_stylesheet_directory() ));
}

// Define theme directory URI
if (!defined('MINIMAL_THEME_DIR_URI')) {
    define('MINIMAL_THEME_DIR_URI', trailingslashit( esc_url( get_stylesheet_directory_uri() )));
}

// Define current theme name
if (!defined('CURRENT_THEME_NAME')) {
    $current_theme_obj = wp_get_theme();
    define('CURRENT_THEME_NAME', $current_theme_obj->get('Name'));
}

// Load the Composer autoloader.
require_once MINIMAL_THEME_DIR . 'vendor/autoload.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;


/*--------------------------------------------------------------*/
/*------------------ Theme Update Checker ----------------------*/
/*--------------------------------------------------------------*/
if ( 'minimal' === CURRENT_THEME_NAME ) {
	$minimalUpdateChecker = PucFactory::buildUpdateChecker(
		'https://github.com/rankfoundry/minimal-theme/',
		MINIMAL_THEME_DIR . '/functions.php',
		'minimal',
		48
	);
	$minimalUpdateChecker->setBranch('master');
}


/*---------------------------------------------------------------*/
/*---------------------- Theme Styles ---------------------------*/
/*---------------------------------------------------------------*/
function minimal_enqueue_styles() {
	wp_enqueue_style( 'minimal', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

add_action( 'wp_enqueue_scripts', 'minimal_enqueue_styles' ); 


// Function that will return our Wordpress menu
function minimal_menu($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            =&gt; '', 
		'container'       =&gt; 'div', 
		'container_class' =&gt; '', 
		'container_id'    =&gt; '', 
		'menu_class'      =&gt; 'menu', 
		'menu_id'         =&gt; '',
		'echo'            =&gt; true,
		'fallback_cb'     =&gt; 'wp_page_menu',
		'before'          =&gt; '',
		'after'           =&gt; '',
		'link_before'     =&gt; '',
		'link_after'      =&gt; '',
		'depth'           =&gt; 0,
		'walker'          =&gt; '',
		'theme_location'  =&gt; ''), 
		$atts));
 
 
	return wp_nav_menu( array( 
		'menu'            =&gt; $menu, 
		'container'       =&gt; $container, 
		'container_class' =&gt; $container_class, 
		'container_id'    =&gt; $container_id, 
		'menu_class'      =&gt; $menu_class, 
		'menu_id'         =&gt; $menu_id,
		'echo'            =&gt; false,
		'fallback_cb'     =&gt; $fallback_cb,
		'before'          =&gt; $before,
		'after'           =&gt; $after,
		'link_before'     =&gt; $link_before,
		'link_after'      =&gt; $link_after,
		'depth'           =&gt; $depth,
		'walker'          =&gt; $walker,
		'theme_location'  =&gt; $theme_location));
}
//Create the shortcode
add_shortcode("minimalmenu", "minimal_menu");

