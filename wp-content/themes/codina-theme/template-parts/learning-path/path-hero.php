<?php
/**
 * Learning Path hero section template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'hero_description' => '',
	'level' => '',
	'estimated_duration' => '',
	'hero_video_url' => '',
) );

$level_labels = array(
	'beginner' => 'مبتدی',
	'junior' => 'جونیور',
	'intermediate' => 'متوسط',
	'senior' => 'سنیور',
);
$level_label = isset( $level_labels[ $args['level'] ] ) ? $level_labels[ $args['level'] ] : '';
?>

<section class="path-hero bg-gradient-to-l from-codina-600 to-codina-800 text-white py-12 md:py-20">
	<div class="container">
		<div class="max-w-4xl">
			<?php if ( $level_label ) : ?>
				<span class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-medium mb-4">
					سطح: <?php echo esc_html( $level_label ); ?>
				</span>
			<?php endif; ?>
			
			<h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight" itemprop="name">
				<?php the_title(); ?>
			</h1>
			
			<?php if ( $args['hero_description'] ) : ?>
				<p class="text-xl md:text-2xl mb-6 text-white/90 leading-relaxed">
					<?php echo esc_html( $args['hero_description'] ); ?>
				</p>
			<?php endif; ?>
			
			<div class="flex flex-wrap gap-4 md:gap-6 text-sm md:text-base">
				<?php if ( $args['estimated_duration'] ) : ?>
					<div class="flex items-center gap-2">
						<span>⏱</span>
						<span><?php echo esc_html( $args['estimated_duration'] ); ?></span>
					</div>
				<?php endif; ?>
			</div>
			
			<?php if ( $args['hero_video_url'] ) : ?>
				<div class="mt-8">
					<a href="<?php echo esc_url( $args['hero_video_url'] ); ?>" target="_blank" rel="noopener" class="btn bg-white text-codina-600 hover:bg-codina-50 inline-flex items-center gap-2">
						<span>▶</span>
						<span>تماشای ویدیو معرفی</span>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

