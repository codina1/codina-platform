<?php
/**
 * Plugin Name: Codina Core
 * Plugin URI: https://codina.ir
 * Description: پلاگین اصلی پلتفرم آموزشی Codina - مدیریت مسیرهای یادگیری، دوره‌ها و دروس
 * Version: 1.0.0
 * Author: Codina Team
 * Author URI: https://codina.ir
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: codina-core
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Network: false
 *
 * @package Codina_Core
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'CODINA_CORE_VERSION', '1.0.0' );

/**
 * Plugin directory path.
 */
define( 'CODINA_CORE_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin directory URL.
 */
define( 'CODINA_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Plugin basename.
 */
define( 'CODINA_CORE_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_codina_core() {
	require_once CODINA_CORE_PATH . 'includes/class-activator.php';
	Codina_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_codina_core() {
	require_once CODINA_CORE_PATH . 'includes/class-deactivator.php';
	Codina_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_codina_core' );
register_deactivation_hook( __FILE__, 'deactivate_codina_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require CODINA_CORE_PATH . 'includes/class-codina-core.php';

/**
 * Begins execution of the plugin.
 */
function run_codina_core() {
	$plugin = new Codina_Core();
	$plugin->run();
}
run_codina_core();

