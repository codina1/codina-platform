<?php
/**
 * Resource Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Resource {

	/**
	 * Register the Resource custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'منابع', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'منبع', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'منابع', 'codina-core' ),
			'name_admin_bar'        => __( 'منبع', 'codina-core' ),
			'archives'              => __( 'آرشیو منابع', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های منبع', 'codina-core' ),
			'parent_item_colon'     => __( 'منبع والد:', 'codina-core' ),
			'all_items'             => __( 'همه منابع', 'codina-core' ),
			'add_new_item'          => __( 'افزودن منبع جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'منبع جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش منبع', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی منبع', 'codina-core' ),
			'view_item'             => __( 'مشاهده منبع', 'codina-core' ),
			'view_items'            => __( 'مشاهده منابع', 'codina-core' ),
			'search_items'          => __( 'جستجوی منبع', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در منبع', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این منبع', 'codina-core' ),
			'items_list'            => __( 'فهرست منابع', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست منابع', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست منابع', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'منبع', 'codina-core' ),
			'description'           => __( 'منابع مراحل یادگیری', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => 'edit.php?post_type=learning_path',
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-book',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'resources',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		);

		register_post_type( 'learning_resource', $args );
	}
}

