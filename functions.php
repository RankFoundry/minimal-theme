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
    define('MINIMAL_THEME_VERSION', '1.0.20');
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
	$minimalUpdateChecker->setBranch('main');
}

/*--------------------------------------------------------------*/
/*--------------------- WP Auto Updates ------------------------*/
/*--------------------------------------------------------------*/

// allows WP plugins to automatically update.
add_filter('auto_update_plugin', '__return_true');

// allow themes to automatically update.
add_filter('auto_update_theme', '__return_true');

// allow WP core updates.
add_filter('allow_minor_auto_core_updates', '__return_true');
add_filter('allow_major_auto_core_updates', '__return_true');

// force auto updates even for version controlled code enviroments.
add_filter('automatic_updates_is_vcs_checkout', '__return_false', 1);


/*---------------------------------------------------------------*/
/*---------------------- Theme Styles ---------------------------*/
/*---------------------------------------------------------------*/
function minimal_enqueue_styles() {
	wp_enqueue_style( 'minimal', get_stylesheet_directory_uri() . '/style.css', array() );
    wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/assets/css/custom.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


add_action( 'wp_enqueue_scripts', 'minimal_enqueue_styles' ); 


/*---------------------------------------------------------------*/
/*--------------------- Mobile Trigger --------------------------*/
/*---------------------------------------------------------------*/
add_filter( 'kadence_svg_icon', 'change_menu_icon', 10, 4 );
function change_menu_icon( $output, $icon, $icon_title, $base ) {
    if ( 'menu' === $icon ) {
        // Define the path to your SVG file. Adjust the path accordingly.
        $svg_path = MINIMAL_THEME_DIR . 'assets/images/minimal-logo.svg';
        
        // Check if the file exists before reading.
        if ( file_exists( $svg_path ) ) {
            return file_get_contents( $svg_path );
        }
    }
    return $output;
}
