<?php
/**
 * Lesson sidebar template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'all_lessons' => array(),
	'current_lesson_id' => 0,
	'course_id' => 0,
) );

if ( empty( $args['all_lessons'] ) ) {
	return;
}
?>

<div class="lesson-sidebar sticky top-8" x-data="{ currentLesson: <?php echo esc_attr( $args['current_lesson_id'] ); ?> }">
	<div class="card">
		<?php if ( $args['course_id'] ) : ?>
			<?php $course = get_post( $args['course_id'] ); ?>
			<?php if ( $course ) : ?>
				<h3 class="text-lg font-bold mb-4">
					<a href="<?php echo esc_url( get_permalink( $args['course_id'] ) ); ?>" class="text-gray-900 hover:text-codina-600">
						<?php echo esc_html( $course->post_title ); ?>
					</a>
				</h3>
			<?php endif; ?>
		<?php endif; ?>
		
		<h4 class="font-bold mb-3 text-gray-700">فهرست دروس</h4>
		<div class="space-y-1 max-h-[600px] overflow-y-auto">
			<?php foreach ( $args['all_lessons'] as $index => $lesson ) : ?>
				<?php
				$is_current = $lesson->ID === $args['current_lesson_id'];
				$lesson_url = get_permalink( $lesson->ID );
				?>
				<a 
					href="<?php echo esc_url( $lesson_url ); ?>"
					class="block p-3 rounded-lg transition-colors <?php echo $is_current ? 'bg-codina-100 text-codina-700 font-bold border-r-4 border-codina-600' : 'text-gray-700 hover:bg-gray-50'; ?>"
					:class="{ 'bg-codina-100 font-bold border-r-4 border-codina-600': currentLesson === <?php echo esc_attr( $lesson->ID ); ?> }"
				>
					<div class="flex items-center gap-3">
						<span class="flex-shrink-0 w-6 h-6 bg-codina-200 text-codina-700 rounded-full flex items-center justify-center text-xs font-bold">
							<?php echo esc_html( $index + 1 ); ?>
						</span>
						<span class="flex-1 text-sm"><?php echo esc_html( $lesson->post_title ); ?></span>
						<?php if ( $is_current ) : ?>
							<span class="text-codina-600">▶</span>
						<?php endif; ?>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>

