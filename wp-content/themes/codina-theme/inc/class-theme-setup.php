<?php
/**
 * Theme setup functionality.
 *
 * @package Codina
 */
class Codina_Theme_Setup {

	/**
	 * Initialize theme setup.
	 */
	public function init() {
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		add_filter( 'language_attributes', array( $this, 'add_rtl_language_attributes' ) );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	public function setup_theme() {
		// Make theme available for translation.
		load_theme_textdomain( 'codina', CODINA_THEME_PATH . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'منوی اصلی', 'codina' ),
				'footer'  => __( 'منوی فوتر', 'codina' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}

	/**
	 * Add RTL and Persian language attributes to HTML tag.
	 *
	 * @param string $output The language attributes output.
	 * @return string Modified language attributes.
	 */
	public function add_rtl_language_attributes( $output ) {
		// Force RTL and Persian language.
		$output = 'lang="fa" dir="rtl"';
		return $output;
	}
}

