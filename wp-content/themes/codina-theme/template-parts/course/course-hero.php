<?php
/**
 * Course hero section template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'short_description' => '',
	'level' => '',
	'duration' => '',
	'last_updated' => '',
	'price' => '',
	'product' => null,
	'is_purchased' => false,
) );

$level_labels = array(
	'beginner' => 'مبتدی',
	'junior' => 'جونیور',
	'intermediate' => 'متوسط',
	'senior' => 'سنیور',
);

$level_label = isset( $level_labels[ $args['level'] ] ) ? $level_labels[ $args['level'] ] : $args['level'];
?>

<section class="course-hero bg-gradient-to-l from-codina-600 to-codina-800 text-white py-12 md:py-16">
	<div class="container">
		<div class="max-w-4xl">
			<?php if ( $level_label ) : ?>
				<span class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-medium mb-4">
					سطح: <?php echo esc_html( $level_label ); ?>
				</span>
			<?php endif; ?>
			
			<h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
				<?php the_title(); ?>
			</h1>
			
			<?php if ( $args['short_description'] ) : ?>
				<p class="text-xl md:text-2xl mb-6 text-white/90 leading-relaxed" itemprop="description">
					<?php echo esc_html( $args['short_description'] ); ?>
				</p>
			<?php endif; ?>
			
			<div class="flex flex-wrap gap-4 md:gap-6 text-sm md:text-base">
				<?php if ( $args['duration'] ) : ?>
					<div class="flex items-center gap-2">
						<span>⏱</span>
						<span><?php echo esc_html( $args['duration'] ); ?> ساعت</span>
					</div>
				<?php endif; ?>
				
				<?php if ( $args['last_updated'] ) : ?>
					<div class="flex items-center gap-2">
						<span>📅</span>
						<span>آخرین به‌روزرسانی: <?php echo esc_html( $args['last_updated'] ); ?></span>
					</div>
				<?php endif; ?>
			</div>
			
			<?php if ( $args['price'] && ! $args['is_purchased'] ) : ?>
				<div class="mt-6">
					<div class="text-3xl font-bold mb-4">
						<?php echo wp_kses_post( $args['price'] ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

