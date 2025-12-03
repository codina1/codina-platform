<?php
/**
 * Base class for meta box handlers.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
abstract class Codina_Meta_Box_Handler {

	/**
	 * The post type this meta box is for.
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * The meta box ID.
	 *
	 * @var string
	 */
	protected $meta_box_id;

	/**
	 * The meta box title.
	 *
	 * @var string
	 */
	protected $meta_box_title;

	/**
	 * The screen context.
	 *
	 * @var string
	 */
	protected $context = 'normal';

	/**
	 * The priority.
	 *
	 * @var string
	 */
	protected $priority = 'high';

	/**
	 * Initialize the meta box.
	 */
	public function __construct() {
		$this->init();
		$this->register_hooks();
	}

	/**
	 * Initialize meta box properties.
	 */
	abstract protected function init();

	/**
	 * Register WordPress hooks.
	 */
	protected function register_hooks() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ), 10, 2 );
	}

	/**
	 * Add the meta box.
	 *
	 * @param string $post_type The post type.
	 */
	public function add_meta_box( $post_type ) {
		if ( $post_type === $this->post_type ) {
			add_meta_box(
				$this->meta_box_id,
				$this->meta_box_title,
				array( $this, 'render_meta_box' ),
				$post_type,
				$this->context,
				$this->priority
			);
		}
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	abstract public function render_meta_box( $post );

	/**
	 * Save the meta box data.
	 *
	 * @param int     $post_id The post ID.
	 * @param WP_Post $post    The post object.
	 */
	abstract public function save_meta_box( $post_id, $post );

	/**
	 * Verify nonce.
	 *
	 * @param string $nonce_name The nonce name.
	 * @param string $nonce_action The nonce action.
	 * @return bool
	 */
	protected function verify_nonce( $nonce_name, $nonce_action ) {
		if ( ! isset( $_POST[ $nonce_name ] ) ) {
			return false;
		}

		if ( ! wp_verify_nonce( $_POST[ $nonce_name ], $nonce_action ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if this is an autosave.
	 *
	 * @return bool
	 */
	protected function is_autosave() {
		return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE;
	}

	/**
	 * Check user permissions.
	 *
	 * @param int    $post_id The post ID.
	 * @param string $capability The capability to check.
	 * @return bool
	 */
	protected function can_edit( $post_id, $capability = 'edit_post' ) {
		if ( ! current_user_can( $capability, $post_id ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Sanitize text field.
	 *
	 * @param string $value The value to sanitize.
	 * @return string
	 */
	protected function sanitize_text( $value ) {
		return sanitize_text_field( $value );
	}

	/**
	 * Sanitize textarea.
	 *
	 * @param string $value The value to sanitize.
	 * @return string
	 */
	protected function sanitize_textarea( $value ) {
		return sanitize_textarea_field( $value );
	}

	/**
	 * Sanitize URL.
	 *
	 * @param string $value The value to sanitize.
	 * @return string
	 */
	protected function sanitize_url( $value ) {
		return esc_url_raw( $value );
	}

	/**
	 * Sanitize integer.
	 *
	 * @param mixed $value The value to sanitize.
	 * @return int
	 */
	protected function sanitize_int( $value ) {
		return absint( $value );
	}

	/**
	 * Get meta value.
	 *
	 * @param int    $post_id The post ID.
	 * @param string $key     The meta key.
	 * @param bool   $single  Whether to return a single value.
	 * @return mixed
	 */
	protected function get_meta( $post_id, $key, $single = true ) {
		return get_post_meta( $post_id, $key, $single );
	}

	/**
	 * Update meta value.
	 *
	 * @param int    $post_id The post ID.
	 * @param string $key     The meta key.
	 * @param mixed  $value   The value to save.
	 * @return bool|int
	 */
	protected function update_meta( $post_id, $key, $value ) {
		return update_post_meta( $post_id, $key, $value );
	}

	/**
	 * Delete meta value.
	 *
	 * @param int    $post_id The post ID.
	 * @param string $key     The meta key.
	 * @return bool
	 */
	protected function delete_meta( $post_id, $key ) {
		return delete_post_meta( $post_id, $key );
	}
}

