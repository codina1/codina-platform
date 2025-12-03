<?php
/**
 * Learning Path Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Learning_Path {

	/**
	 * Register the Learning Path custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'مسیرهای یادگیری', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'مسیر یادگیری', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'مسیرهای یادگیری', 'codina-core' ),
			'name_admin_bar'        => __( 'مسیر یادگیری', 'codina-core' ),
			'archives'              => __( 'آرشیو مسیرهای یادگیری', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های مسیر یادگیری', 'codina-core' ),
			'parent_item_colon'     => __( 'مسیر والد:', 'codina-core' ),
			'all_items'             => __( 'همه مسیرهای یادگیری', 'codina-core' ),
			'add_new_item'          => __( 'افزودن مسیر یادگیری جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'مسیر یادگیری جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش مسیر یادگیری', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی مسیر یادگیری', 'codina-core' ),
			'view_item'             => __( 'مشاهده مسیر یادگیری', 'codina-core' ),
			'view_items'            => __( 'مشاهده مسیرهای یادگیری', 'codina-core' ),
			'search_items'          => __( 'جستجوی مسیر یادگیری', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در مسیر یادگیری', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این مسیر یادگیری', 'codina-core' ),
			'items_list'            => __( 'فهرست مسیرهای یادگیری', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست مسیرهای یادگیری', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست مسیرهای یادگیری', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'مسیر یادگیری', 'codina-core' ),
			'description'           => __( 'مسیرهای یادگیری ساختاریافته', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => true, // Allows child posts (Phases)
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-welcome-learn-more',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'learning-paths',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array(
				'slug'       => 'learning-path',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			),
		);

		register_post_type( 'learning_path', $args );
	}
}

