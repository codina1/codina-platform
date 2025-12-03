<?php
/**
 * Lesson additional resources template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'resources' => array(),
) );

if ( empty( $args['resources'] ) ) {
	return;
}
?>

<div class="lesson-resources card mt-6">
	<h3 class="text-xl font-bold mb-4">منابع اضافی</h3>
	<div class="space-y-3">
		<?php foreach ( $args['resources'] as $resource ) : ?>
			<?php
			$resource_title = is_array( $resource ) ? ( isset( $resource['title'] ) ? $resource['title'] : '' ) : '';
			$resource_url   = is_array( $resource ) ? ( isset( $resource['url'] ) ? $resource['url'] : '' ) : '';
			if ( ! empty( $resource_url ) ) :
				?>
				<div class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-codina-300 transition-colors">
					<span class="text-2xl">🔗</span>
					<div class="flex-1">
						<a href="<?php echo esc_url( $resource_url ); ?>" target="_blank" rel="noopener" class="text-codina-600 hover:text-codina-700 font-medium">
							<?php echo esc_html( $resource_title ?: $resource_url ); ?>
						</a>
					</div>
					<a href="<?php echo esc_url( $resource_url ); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-gray-600">
						↗
					</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>

