<?php
/**
 * Lesson navigation template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'prev_lesson' => null,
	'next_lesson' => null,
	'course_id' => 0,
) );
?>

<div class="lesson-navigation flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
	<?php if ( $args['next_lesson'] ) : ?>
		<!-- Next lesson (left in RTL = previous visually) -->
		<a 
			href="<?php echo esc_url( get_permalink( $args['next_lesson']->ID ) ); ?>" 
			class="flex-1 btn btn-secondary flex items-center justify-center gap-2"
		>
			<span>→</span>
			<span>درس بعدی: <?php echo esc_html( $args['next_lesson']->post_title ); ?></span>
		</a>
	<?php else : ?>
		<div class="flex-1"></div>
	<?php endif; ?>
	
	<?php if ( $args['course_id'] ) : ?>
		<a 
			href="<?php echo esc_url( get_permalink( $args['course_id'] ) ); ?>" 
			class="btn btn-secondary hidden sm:inline-block"
		>
			بازگشت به دوره
		</a>
	<?php endif; ?>
	
	<?php if ( $args['prev_lesson'] ) : ?>
		<!-- Previous lesson (right in RTL = next visually) -->
		<a 
			href="<?php echo esc_url( get_permalink( $args['prev_lesson']->ID ) ); ?>" 
			class="flex-1 btn btn-primary flex items-center justify-center gap-2"
		>
			<span>←</span>
			<span>درس قبلی: <?php echo esc_html( $args['prev_lesson']->post_title ); ?></span>
		</a>
	<?php else : ?>
		<div class="flex-1"></div>
	<?php endif; ?>
</div>

