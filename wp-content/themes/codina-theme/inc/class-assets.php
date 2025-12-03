<?php
/**
 * Assets management (CSS, JS, fonts).
 *
 * @package Codina
 */
class Codina_Assets {

	/**
	 * Initialize assets.
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'add_font_preload' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		// Main compiled Tailwind CSS.
		wp_enqueue_style(
			'codina-main',
			CODINA_THEME_URL . '/assets/css/main.css',
			array(),
			CODINA_THEME_VERSION,
			'all'
		);

		// Custom styles (if any).
		if ( file_exists( CODINA_THEME_PATH . '/assets/css/custom.css' ) ) {
			wp_enqueue_style(
				'codina-custom',
				CODINA_THEME_URL . '/assets/css/custom.css',
				array( 'codina-main' ),
				CODINA_THEME_VERSION,
				'all'
			);
		}
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		// Check if we need Alpine.js (only on pages with accordions/interactive components)
		$needs_alpine = false;
		if ( is_singular( array( 'codina_course', 'learning_path' ) ) || is_page_template( 'page-my-learning.php' ) ) {
			$needs_alpine = true;
		}

		if ( $needs_alpine ) {
			// Alpine.js for interactive components (accordions)
			wp_enqueue_script(
				'alpinejs',
				'https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js',
				array(),
				'3.13.0',
				true
			);
		}
		
		// Main JavaScript (minimal, only essential functionality)
		wp_enqueue_script(
			'codina-main',
			CODINA_THEME_URL . '/assets/js/main.js',
			array(),
			CODINA_THEME_VERSION,
			true
		);
	}

	/**
	 * Add font preload for better performance.
	 */
	public function add_font_preload() {
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<?php
	}
}

