<?php
/**
 * The core plugin class.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes
 */
class Codina_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks.
	 *
	 * @var Codina_Core_Loader
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @var string
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {
		if ( defined( 'CODINA_CORE_VERSION' ) ) {
			$this->version = CODINA_CORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'codina-core';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_post_types();
	}

	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once CODINA_CORE_PATH . 'includes/class-codina-core-loader.php';

		/**
		 * The class responsible for defining internationalization functionality.
		 */
		require_once CODINA_CORE_PATH . 'includes/class-codina-core-i18n.php';

		/**
		 * Post Type classes.
		 */
		require_once CODINA_CORE_PATH . 'includes/post-types/class-learning-path.php';
		require_once CODINA_CORE_PATH . 'includes/post-types/class-phase.php';
		require_once CODINA_CORE_PATH . 'includes/post-types/class-step.php';
		require_once CODINA_CORE_PATH . 'includes/post-types/class-resource.php';
		require_once CODINA_CORE_PATH . 'includes/post-types/class-course.php';
		require_once CODINA_CORE_PATH . 'includes/post-types/class-lesson.php';

		/**
		 * Meta Box classes.
		 */
		require_once CODINA_CORE_PATH . 'includes/meta-boxes/class-meta-box-handler.php';
		require_once CODINA_CORE_PATH . 'includes/meta-boxes/learning-path-meta.php';
		require_once CODINA_CORE_PATH . 'includes/meta-boxes/phase-meta.php';
		require_once CODINA_CORE_PATH . 'includes/meta-boxes/step-meta.php';
		require_once CODINA_CORE_PATH . 'includes/meta-boxes/resource-meta.php';

		/**
		 * Admin classes.
		 */
		require_once CODINA_CORE_PATH . 'includes/admin/class-admin.php';

		/**
		 * Dashboard classes.
		 */
		require_once CODINA_CORE_PATH . 'includes/dashboard/class-dashboard-helpers.php';

		$this->loader = new Codina_Core_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 */
	private function set_locale() {
		$plugin_i18n = new Codina_Core_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to custom post types.
	 */
	private function define_post_types() {
		$learning_path = new Codina_Learning_Path();
		$phase         = new Codina_Phase();
		$step          = new Codina_Step();
		$resource      = new Codina_Resource();
		$course        = new Codina_Course();
		$lesson        = new Codina_Lesson();

		$this->loader->add_action( 'init', $learning_path, 'register_post_type' );
		$this->loader->add_action( 'init', $phase, 'register_post_type' );
		$this->loader->add_action( 'init', $step, 'register_post_type' );
		$this->loader->add_action( 'init', $resource, 'register_post_type' );
		$this->loader->add_action( 'init', $course, 'register_post_type' );
		$this->loader->add_action( 'init', $lesson, 'register_post_type' );

		// Initialize meta boxes.
		new Codina_Learning_Path_Meta();
		new Codina_Phase_Meta();
		new Codina_Step_Meta();
		new Codina_Resource_Meta();

		// Initialize admin.
		$admin = new Codina_Core_Admin();
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
		$this->loader->add_action( 'add_meta_boxes', $admin, 'add_hierarchy_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $admin, 'add_parent_selection_meta_box' );
		$this->loader->add_action( 'save_post', $admin, 'save_parent_selection', 10, 2 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return Codina_Core_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return string The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

