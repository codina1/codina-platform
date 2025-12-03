<?php
/**
 * Lesson Custom Post Type.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/post-types
 */
class Codina_Lesson {

	/**
	 * Register the Lesson custom post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'دروس', 'Post Type General Name', 'codina-core' ),
			'singular_name'         => _x( 'درس', 'Post Type Singular Name', 'codina-core' ),
			'menu_name'             => __( 'دروس', 'codina-core' ),
			'name_admin_bar'        => __( 'درس', 'codina-core' ),
			'archives'              => __( 'آرشیو دروس', 'codina-core' ),
			'attributes'            => __( 'ویژگی‌های درس', 'codina-core' ),
			'parent_item_colon'     => __( 'درس والد:', 'codina-core' ),
			'all_items'             => __( 'همه دروس', 'codina-core' ),
			'add_new_item'          => __( 'افزودن درس جدید', 'codina-core' ),
			'add_new'               => __( 'افزودن جدید', 'codina-core' ),
			'new_item'              => __( 'درس جدید', 'codina-core' ),
			'edit_item'             => __( 'ویرایش درس', 'codina-core' ),
			'update_item'           => __( 'به‌روزرسانی درس', 'codina-core' ),
			'view_item'             => __( 'مشاهده درس', 'codina-core' ),
			'view_items'            => __( 'مشاهده دروس', 'codina-core' ),
			'search_items'          => __( 'جستجوی درس', 'codina-core' ),
			'not_found'             => __( 'یافت نشد', 'codina-core' ),
			'not_found_in_trash'    => __( 'در سطل زباله یافت نشد', 'codina-core' ),
			'featured_image'        => __( 'تصویر شاخص', 'codina-core' ),
			'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'codina-core' ),
			'remove_featured_image' => __( 'حذف تصویر شاخص', 'codina-core' ),
			'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'codina-core' ),
			'insert_into_item'      => __( 'درج در درس', 'codina-core' ),
			'uploaded_to_this_item' => __( 'آپلود شده در این درس', 'codina-core' ),
			'items_list'            => __( 'فهرست دروس', 'codina-core' ),
			'items_list_navigation' => __( 'ناوبری فهرست دروس', 'codina-core' ),
			'filter_items_list'     => __( 'فیلتر فهرست دروس', 'codina-core' ),
		);

		$args = array(
			'label'                 => __( 'درس', 'codina-core' ),
			'description'           => __( 'دروس دوره‌های آموزشی', 'codina-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
			'taxonomies'            => array(),
			'hierarchical'          => false, // Lessons are children of Courses, but not hierarchical themselves
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => 'edit.php?post_type=codina_course', // Show under Courses menu
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-video-alt3',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false, // Lessons typically not in nav menus
			'can_export'            => true,
			'has_archive'           => false, // Lessons don't have archive pages
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'lessons',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array(
				'slug'       => 'lesson',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => false,
			),
		);

		register_post_type( 'codina_lesson', $args );
	}
}

