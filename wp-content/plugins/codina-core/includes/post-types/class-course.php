<?php
/**
 * Course Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Course {

	/**
	 * Register the Course custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'دوره‌ها', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'دوره', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'دوره‌ها', 'codina-core' ),
			'name_admin_bar'        => __( 'دوره', 'codina-core' ),
			'archives'              => __( 'آرشیو دوره‌ها', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های دوره', 'codina-core' ),
			'parent_item_colon'     => __( 'دوره والد:', 'codina-core' ),
			'all_items'             => __( 'همه دوره‌ها', 'codina-core' ),
			'add_new_item'          => __( 'افزودن دوره جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'دوره جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش دوره', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی دوره', 'codina-core' ),
			'view_item'             => __( 'مشاهده دوره', 'codina-core' ),
			'view_items'            => __( 'مشاهده دوره‌ها', 'codina-core' ),
			'search_items'          => __( 'جستجوی دوره', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در دوره', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این دوره', 'codina-core' ),
			'items_list'            => __( 'فهرست دوره‌ها', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست دوره‌ها', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست دوره‌ها', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'دوره', 'codina-core' ),
			'description'           => __( 'دوره‌های آموزشی', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => true, // Allows child posts (Lessons)
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-book-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'courses',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array(
				'slug'       => 'course',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
			),
		);

		register_post_type( 'codina_course', $args );
	}
}

