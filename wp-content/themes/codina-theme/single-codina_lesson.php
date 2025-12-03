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
	$attachments = get_post_meta( $lesson_id, '_codina_attachments', false );
	$lesson_order = get_post_meta( $lesson_id, '_codina_order', true );
	
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

