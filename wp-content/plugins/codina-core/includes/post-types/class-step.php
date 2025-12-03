<?php
/**
 * Step Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Step {

	/**
	 * Register the Step custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'مراحل', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'مرحله', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'مراحل', 'codina-core' ),
			'name_admin_bar'        => __( 'مرحله', 'codina-core' ),
			'archives'              => __( 'آرشیو مراحل', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های مرحله', 'codina-core' ),
			'parent_item_colon'     => __( 'مرحله والد:', 'codina-core' ),
			'all_items'             => __( 'همه مراحل', 'codina-core' ),
			'add_new_item'          => __( 'افزودن مرحله جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'مرحله جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش مرحله', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی مرحله', 'codina-core' ),
			'view_item'             => __( 'مشاهده مرحله', 'codina-core' ),
			'view_items'            => __( 'مشاهده مراحل', 'codina-core' ),
			'search_items'          => __( 'جستجوی مرحله', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در مرحله', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این مرحله', 'codina-core' ),
			'items_list'            => __( 'فهرست مراحل', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست مراحل', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست مراحل', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'مرحله', 'codina-core' ),
			'description'           => __( 'مراحل فازهای یادگیری', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => true, // Allows child posts (Resources)
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => 'edit.php?post_type=learning_path',
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-arrow-right-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'steps',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		);

		register_post_type( 'learning_step', $args );
	}
}

