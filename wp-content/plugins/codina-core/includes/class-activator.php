<?php
/**
 * Fired during plugin activation.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes
 */
class Codina_Core_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 */
	public static function activate() {
		// Flush rewrite rules to register custom post types.
		flush_rewrite_rules();
	}
}

