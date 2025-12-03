<?php
/**
 * Reusable section heading component
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'title' => '',
	'subtitle' => '',
	'align' => 'center', // center or left
) );

if ( empty( $args['title'] ) ) {
	return;
}

$align_class = 'center' === $args['align'] ? 'text-center' : 'text-right';
?>

<div class="section-heading mb-8 md:mb-12 <?php echo esc_attr( $align_class ); ?>">
	<h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
		<?php echo esc_html( $args['title'] ); ?>
	</h2>
	<?php if ( ! empty( $args['subtitle'] ) ) : ?>
		<p class="text-base md:text-lg text-gray-600 max-w-2xl <?php echo 'center' === $args['align'] ? 'mx-auto' : ''; ?>">
			<?php echo esc_html( $args['subtitle'] ); ?>
		</p>
	<?php endif; ?>
</div>

