<?php
/**
 * Learning Path outcomes template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'outcomes' => array(),
) );
?>

<section class="path-outcomes mb-12 md:mb-16">
	<div class="card">
		<h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">آنچه پس از تکمیل این مسیر یاد می‌گیرید</h2>
		
		<?php if ( ! empty( $args['outcomes'] ) ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<?php foreach ( $args['outcomes'] as $outcome ) : ?>
					<div class="flex items-start gap-3">
						<span class="text-codina-600 text-xl mt-1">✓</span>
						<span class="text-gray-700"><?php echo esc_html( $outcome ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

