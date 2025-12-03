<?php
/**
 * Dashboard helper functions.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/dashboard
 */
class Codina_Dashboard_Helpers {

	/**
	 * Get purchased courses for current user.
	 *
	 * @return array Array of course posts with progress data.
	 */
	public static function get_user_purchased_courses() {
		if ( ! is_user_logged_in() ) {
			return array();
		}

		$user_id = get_current_user_id();
		$purchased_courses = array();

		// Get all courses
		$courses = get_posts(
			array(
				'post_type'      => 'codina_course',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
			)
		);

		foreach ( $courses as $course ) {
			$wc_product_id = get_post_meta( $course->ID, '_codina_woocommerce_product_id', true );
			
			if ( ! $wc_product_id ) {
				continue;
			}

			// Check if user has purchased this product
			if ( function_exists( 'wc_customer_bought_product' ) ) {
				$has_purchased = wc_customer_bought_product( '', $user_id, $wc_product_id );
				
				if ( $has_purchased ) {
					// Calculate progress (simplified for Phase 1)
					$progress = self::calculate_course_progress( $course->ID, $user_id );
					
					$purchased_courses[] = array(
						'course'   => $course,
						'progress' => $progress,
					);
				}
			}
		}

		return $purchased_courses;
	}

	/**
	 * Calculate course progress for a user.
	 *
	 * @param int $course_id Course post ID.
	 * @param int $user_id   User ID.
	 * @return int Progress percentage (0-100).
	 */
	public static function calculate_course_progress( $course_id, $user_id ) {
		// Phase 1: Simple simulated progress
		// In Phase 2, this will use real tracking data
		
		// Get all lessons for this course
		$lessons = get_posts(
			array(
				'post_type'      => 'codina_lesson',
				'post_parent'    => $course_id,
				'posts_per_page' => -1,
				'fields'         => 'ids',
			)
		);

		if ( empty( $lessons ) ) {
			return 0;
		}

		// For Phase 1, return a simulated progress based on course ID + user ID
		// This ensures consistent "progress" per user per course
		$seed = $course_id + $user_id;
		$progress = 30 + ( $seed % 60 ); // Random between 30-90%

		return $progress;
	}

	/**
	 * Get user's followed learning paths.
	 *
	 * @return array Array of learning path posts.
	 */
	public static function get_user_followed_paths() {
		if ( ! is_user_logged_in() ) {
			return array();
		}

		$user_id = get_current_user_id();
		
		// Phase 1: Show all learning paths as recommendations
		// In Phase 2, this will use user meta to track followed paths
		$paths = get_posts(
			array(
				'post_type'      => 'learning_path',
				'posts_per_page' => 6,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		return $paths;
	}

	/**
	 * Get last viewed lesson for a course.
	 *
	 * @param int $course_id Course post ID.
	 * @param int $user_id   User ID.
	 * @return int|null Lesson post ID or null.
	 */
	public static function get_last_viewed_lesson( $course_id, $user_id ) {
		// Phase 1: Return first lesson
		// In Phase 2, this will use user meta to track last viewed lesson
		$lessons = get_posts(
			array(
				'post_type'      => 'codina_lesson',
				'post_parent'    => $course_id,
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'fields'         => 'ids',
			)
		);

		return ! empty( $lessons ) ? $lessons[0] : null;
	}
}

