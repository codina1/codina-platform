<?php
/**
 * Phase Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Phase {

	/**
	 * Register the Phase custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'فازها', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'فاز', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'فازها', 'codina-core' ),
			'name_admin_bar'        => __( 'فاز', 'codina-core' ),
			'archives'              => __( 'آرشیو فازها', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های فاز', 'codina-core' ),
			'parent_item_colon'     => __( 'فاز والد:', 'codina-core' ),
			'all_items'             => __( 'همه فازها', 'codina-core' ),
			'add_new_item'          => __( 'افزودن فاز جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'فاز جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش فاز', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی فاز', 'codina-core' ),
			'view_item'             => __( 'مشاهده فاز', 'codina-core' ),
			'view_items'            => __( 'مشاهده فازها', 'codina-core' ),
			'search_items'          => __( 'جستجوی فاز', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در فاز', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این فاز', 'codina-core' ),
			'items_list'            => __( 'فهرست فازها', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست فازها', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست فازها', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'فاز', 'codina-core' ),
			'description'           => __( 'فازهای مسیر یادگیری', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => true, // Allows child posts (Steps)
			'public'                => false, // Not publicly accessible
			'show_ui'               => true,
			'show_in_menu'          => 'edit.php?post_type=learning_path', // Show under Learning Paths menu
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-list-view',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'phases',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		);

		register_post_type( 'learning_phase', $args );
	}
}

