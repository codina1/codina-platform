<?php
/**
 * Define the internationalization functionality.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes
 */
class Codina_Core_i18n {

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'codina-core',
			false,
			dirname( CODINA_CORE_BASENAME ) . '/languages/'
		);
	}
}

