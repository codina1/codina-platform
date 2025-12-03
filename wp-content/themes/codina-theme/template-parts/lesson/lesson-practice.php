<?php
/**
 * Lesson practice/assignment template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'practice_text' => '',
) );

if ( empty( $args['practice_text'] ) ) {
	return;
}
?>

<div class="lesson-practice card mt-6">
	<h3 class="text-xl font-bold mb-4">تمرین / تکلیف</h3>
	<div class="prose prose-lg max-w-none">
		<?php echo wp_kses_post( wpautop( $args['practice_text'] ) ); ?>
	</div>
</div>

