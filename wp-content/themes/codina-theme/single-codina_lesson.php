<?php
/**
 * The template for displaying single lesson pages
 *
 * @package Codina
 */

get_header();

while ( have_posts() ) :
	the_post();
	
	$lesson_id = get_the_ID();
	$course_id = get_post_parent( $lesson_id );
	$video_url = get_post_meta( $lesson_id, '_codina_video_url', true );
	$duration = get_post_meta( $lesson_id, '_codina_duration', true );
	$lesson_order = get_post_meta( $lesson_id, '_codina_lesson_order', true );
	$free_status = get_post_meta( $lesson_id, '_codina_free_status', true );
	$summary = get_post_meta( $lesson_id, '_codina_summary', true );
	$practice_text = get_post_meta( $lesson_id, '_codina_practice_text', true );
	
	// Get attachments (can be JSON string or array)
	$attachments_raw = get_post_meta( $lesson_id, '_codina_attachments', true );
	$attachments = array();
	if ( ! empty( $attachments_raw ) ) {
		$decoded = json_decode( $attachments_raw, true );
		if ( is_array( $decoded ) ) {
			$attachments = $decoded;
		} elseif ( is_string( $attachments_raw ) && filter_var( $attachments_raw, FILTER_VALIDATE_URL ) ) {
			$attachments = array( array( 'url' => $attachments_raw, 'title' => '' ) );
		}
	}
	
	// Get resources (can be JSON string or array)
	$resources_raw = get_post_meta( $lesson_id, '_codina_resources', true );
	$resources = array();
	if ( ! empty( $resources_raw ) ) {
		$decoded = json_decode( $resources_raw, true );
		if ( is_array( $decoded ) ) {
			$resources = $decoded;
		}
	}
	
	// Get course lock status for fallback
	$course_lock_status = '';
	if ( $course_id ) {
		$course_lock_status = get_post_meta( $course_id, '_codina_lesson_lock_status', true );
	}
	
	// Determine if lesson is locked
	$is_lesson_locked = false;
	if ( empty( $free_status ) && $course_lock_status ) {
		$free_status = $course_lock_status; // Use course default
	}
	if ( 'locked' === $free_status ) {
		// Check if user has purchased
		if ( $course_id ) {
			$wc_product_id = get_post_meta( $course_id, '_codina_woocommerce_product_id', true );
			if ( $wc_product_id && function_exists( 'wc_customer_bought_product' ) && is_user_logged_in() ) {
				$user_id = get_current_user_id();
				$is_purchased = wc_customer_bought_product( '', $user_id, $wc_product_id );
				$is_lesson_locked = ! $is_purchased;
			} else {
				$is_lesson_locked = true;
			}
		} else {
			$is_lesson_locked = true;
		}
	}
	
	// Get all lessons in the same course
	$all_lessons = array();
	if ( $course_id ) {
		$all_lessons = get_posts(
			array(
				'post_type'      => 'codina_lesson',
				'post_parent'    => $course_id,
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
	}
	
	// Find current lesson index
	$current_index = -1;
	foreach ( $all_lessons as $index => $lesson ) {
		if ( $lesson->ID === $lesson_id ) {
			$current_index = $index;
			break;
		}
	}
	
	// Get previous and next lessons
	$prev_lesson = null;
	$next_lesson = null;
	if ( $current_index > 0 ) {
		$prev_lesson = $all_lessons[ $current_index - 1 ];
	}
	if ( $current_index >= 0 && $current_index < count( $all_lessons ) - 1 ) {
		$next_lesson = $all_lessons[ $current_index + 1 ];
	}
	
	// Get course info
	$course = null;
	if ( $course_id ) {
		$course = get_post( $course_id );
	}
	
	// Calculate progress (simple version - based on lesson order)
	$total_lessons = count( $all_lessons );
	$progress = $total_lessons > 0 ? ( ( $current_index + 1 ) / $total_lessons ) * 100 : 0;
	?>

	<main id="main" class="site-main lesson-page">
		
		<div class="container py-6 md:py-8">
			<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
				
				<!-- Main Content -->
				<div class="lg:col-span-3 space-y-6">
					
					<?php if ( $course ) : ?>
						<div class="mb-4">
							<a href="<?php echo esc_url( get_permalink( $course_id ) ); ?>" class="text-codina-600 hover:text-codina-700 font-medium">
								← بازگشت به دوره: <?php echo esc_html( $course->post_title ); ?>
							</a>
						</div>
					<?php endif; ?>
					
					<!-- Progress Bar -->
					<?php if ( $total_lessons > 0 ) : ?>
						<div class="bg-gray-100 rounded-full h-2 overflow-hidden">
							<div 
								class="bg-codina-600 h-full transition-all duration-500"
								style="width: <?php echo esc_attr( $progress ); ?>%"
							></div>
						</div>
						<div class="text-sm text-gray-600">
							پیشرفت: <?php echo esc_html( $current_index + 1 ); ?> از <?php echo esc_html( $total_lessons ); ?> درس
						</div>
					<?php endif; ?>
					
					<!-- Lesson Title -->
					<header class="lesson-header">
						<h1 class="text-3xl md:text-4xl font-bold mb-4" itemprop="name"><?php the_title(); ?></h1>
						<?php if ( $summary ) : ?>
							<p class="text-lg text-gray-600 mb-4 leading-relaxed">
								<?php echo esc_html( $summary ); ?>
							</p>
						<?php endif; ?>
						<?php if ( $duration ) : ?>
							<div class="flex items-center gap-2 text-gray-500 mb-4">
								<span>⏱</span>
								<span><?php echo esc_html( $duration ); ?></span>
							</div>
						<?php endif; ?>
					</header>
					
					<?php
					// Video player
					if ( $video_url ) {
						get_template_part( 'template-parts/lesson/lesson-video', null, array(
							'video_url' => $video_url,
						) );
					}
					?>
					
					<!-- Lesson Content -->
					<div class="card">
						<div class="prose prose-lg max-w-none">
							<?php the_content(); ?>
						</div>
					</div>
					
					<?php
					// Attachments
					if ( ! empty( $attachments ) ) {
						get_template_part( 'template-parts/lesson/lesson-attachments', null, array(
							'attachments' => $attachments,
						) );
					}
					
					// Practice/Assignment
					if ( $practice_text ) {
						get_template_part( 'template-parts/lesson/lesson-practice', null, array(
							'practice_text' => $practice_text,
						) );
					}
					
					// Additional Resources
					if ( ! empty( $resources ) ) {
						get_template_part( 'template-parts/lesson/lesson-resources', null, array(
							'resources' => $resources,
						) );
					}
					?>
					
					<!-- Navigation -->
					<?php
					get_template_part( 'template-parts/lesson/lesson-navigation', null, array(
						'prev_lesson' => $prev_lesson,
						'next_lesson' => $next_lesson,
						'course_id' => $course_id,
					) );
					?>
					
				</div>
				
				<!-- Sidebar -->
				<aside class="lg:col-span-1">
					<?php
					get_template_part( 'template-parts/lesson/lesson-sidebar', null, array(
						'all_lessons' => $all_lessons,
						'current_lesson_id' => $lesson_id,
						'course_id' => $course_id,
					) );
					?>
				</aside>
				
			</div>
		</div>

	</main>

	<?php
endwhile;
get_footer();

