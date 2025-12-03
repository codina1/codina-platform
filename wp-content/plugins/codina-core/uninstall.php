<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package    Codina_Core
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Perform uninstall actions here.
// For example: delete options, remove custom tables, etc.

// Flush rewrite rules.
flush_rewrite_rules();

