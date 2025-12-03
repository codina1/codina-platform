<?php
/**
 * Purchased courses section template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'courses' => array(),
) );

if ( ! class_exists( 'Codina_Dashboard_Helpers' ) ) {
	require_once WP_PLUGIN_DIR . '/codina-core/includes/dashboard/class-dashboard-helpers.php';
}

$user_id = get_current_user_id();
?>

<section class="purchased-courses-section mb-12 md:mb-16">
	<?php
	get_template_part( 'template-parts/components/section-heading', null, array(
		'title' => 'دوره‌های من',
		'subtitle' => 'دوره‌هایی که خریداری کرده‌اید و به آن‌ها دسترسی دارید',
		'align' => 'left',
	) );
	?>

	<?php if ( ! empty( $args['courses'] ) ) : ?>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
			<?php foreach ( $args['courses'] as $course_data ) : ?>
				<?php
				$course = $course_data['course'];
				$progress = $course_data['progress'];
				
				// Get last viewed lesson or course page
				$last_lesson_id = Codina_Dashboard_Helpers::get_last_viewed_lesson( $course->ID, $user_id );
				$continue_url = $last_lesson_id ? get_permalink( $last_lesson_id ) : get_permalink( $course->ID );
				?>
				<?php
				get_template_part( 'template-parts/components/course-card', null, array(
					'course' => $course,
					'show_price' => false,
					'show_progress' => true,
					'progress_percent' => $progress,
					'button_text' => 'ادامه یادگیری',
					'button_link' => $continue_url,
				) );
				?>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
			<?php
			get_template_part( 'template-parts/components/empty-state', null, array(
				'icon' => '📚',
				'title' => 'هنوز دوره‌ای خریداری نکرده‌اید',
				'message' => 'شروع به یادگیری کنید و دوره‌های آموزشی ما را مشاهده کنید',
				'action_text' => 'مشاهده دوره‌ها',
				'action_link' => get_post_type_archive_link( 'codina_course' ),
			) );
			?>
		<?php endif; ?>
</section>

