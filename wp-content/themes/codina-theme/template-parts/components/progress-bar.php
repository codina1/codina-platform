<?php
/**
 * Reusable progress bar component
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'percent' => 0,
	'label' => 'پیشرفت',
	'show_percent' => true,
	'size' => 'md', // sm, md, lg
) );

$percent = max( 0, min( 100, (int) $args['percent'] ) );
$size_classes = array(
	'sm' => 'h-1.5',
	'md' => 'h-2',
	'lg' => 'h-3',
);
$height_class = $size_classes[ $args['size'] ] ?? $size_classes['md'];
?>

<div class="progress-bar">
	<?php if ( $args['label'] || $args['show_percent'] ) : ?>
		<div class="flex items-center justify-between mb-2">
			<?php if ( $args['label'] ) : ?>
				<span class="text-sm font-medium text-gray-700"><?php echo esc_html( $args['label'] ); ?></span>
			<?php else : ?>
				<span></span>
			<?php endif; ?>
			<?php if ( $args['show_percent'] ) : ?>
				<span class="text-sm text-gray-600"><?php echo esc_html( $percent ); ?>%</span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="w-full bg-gray-200 rounded-full overflow-hidden <?php echo esc_attr( $height_class ); ?>">
		<div 
			class="bg-codina-600 rounded-full transition-all duration-500 <?php echo esc_attr( $height_class ); ?>"
			style="width: <?php echo esc_attr( $percent ); ?>%"
			role="progressbar"
			aria-valuenow="<?php echo esc_attr( $percent ); ?>"
			aria-valuemin="0"
			aria-valuemax="100"
		></div>
	</div>
</div>

