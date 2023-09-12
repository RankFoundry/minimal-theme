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
    define('MINIMAL_THEME_VERSION', '1.0.2');
}

// Define theme directory path
if (!defined('MINIMAL_THEME_DIR')) {
    define('MINIMAL_THEME_DIR', trailingslashit( get_stylesheet_directory() ));
}

// Define theme directory URI
if (!defined('MINIMAL_THEME_DIR_URI')) {
    define('MINIMAL_THEME_DIR_URI', trailingslashit( esc_url( get_stylesheet_directory_uri() )));
}

// Load the Composer autoloader.
require_once MINIMAL_THEME_DIR . 'vendor/autoload.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;


/*--------------------------------------------------------------*/
/*------------------ Theme Update Checker ----------------------*/
/*--------------------------------------------------------------*/
$minimalUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/rankfoundry/minimal-theme/',
	MINIMAL_THEME_DIR . '/functions.php',
	'minimal',
	0
);
$minimalUpdateChecker->setBranch('master');


/*---------------------------------------------------------------*/
/*---------------------- Theme Styles ---------------------------*/
/*---------------------------------------------------------------*/
function minimal_enqueue_styles() {
	wp_enqueue_style( 'minimal', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

add_action( 'wp_enqueue_scripts', 'minimal_enqueue_styles' ); 




