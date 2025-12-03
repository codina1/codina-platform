<?php
/**
 * Fired during plugin deactivation.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes
 */
class Codina_Core_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 */
	public static function deactivate() {
		// Flush rewrite rules.
		flush_rewrite_rules();
	}
}

