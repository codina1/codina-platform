<?php
/**
 * Codina Theme Functions
 *
 * @package Codina
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Theme version.
 */
define( 'CODINA_THEME_VERSION', '1.0.0' );

/**
 * Theme directory path.
 */
define( 'CODINA_THEME_PATH', get_template_directory() );

/**
 * Theme directory URL.
 */
define( 'CODINA_THEME_URL', get_template_directory_uri() );

/**
 * Load theme setup functions.
 */
require_once CODINA_THEME_PATH . '/inc/class-theme-setup.php';

/**
 * Load assets management.
 */
require_once CODINA_THEME_PATH . '/inc/class-assets.php';

/**
 * Load template functions.
 */
require_once CODINA_THEME_PATH . '/inc/template-functions.php';

/**
 * Initialize theme.
 */
function codina_theme_init() {
	$theme_setup = new Codina_Theme_Setup();
	$theme_setup->init();

	$assets = new Codina_Assets();
	$assets->init();
}
add_action( 'after_setup_theme', 'codina_theme_init' );

