<?php
/**
 * Related learning paths template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'paths' => array(),
) );
?>

<section class="related-paths card">
	<h2 class="text-2xl font-bold mb-4">این دوره بخشی از مسیرهای زیر است:</h2>
	
	<?php if ( ! empty( $args['paths'] ) ) : ?>
		<div class="space-y-4">
			<?php foreach ( $args['paths'] as $path ) : ?>
				<a 
					href="<?php echo esc_url( get_permalink( $path->ID ) ); ?>" 
					class="block p-4 border border-gray-200 rounded-lg hover:border-codina-300 hover:shadow-md transition-all"
				>
					<h3 class="font-bold text-gray-900 mb-2"><?php echo esc_html( $path->post_title ); ?></h3>
					<?php if ( has_excerpt( $path->ID ) ) : ?>
						<p class="text-gray-600 text-sm"><?php echo esc_html( wp_trim_words( get_the_excerpt( $path->ID ), 20 ) ); ?></p>
					<?php endif; ?>
					<span class="inline-block mt-2 text-codina-600 font-medium text-sm">
						مشاهده مسیر یادگیری →
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</section>

