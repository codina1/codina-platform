<?php
/**
 * Reusable Learning Path card component
 *
 * @package Codina
 * 
 * @var WP_Post $path Learning path post object
 * @var array   $args Additional arguments
 */

$args = wp_parse_args( $args, array(
	'show_description' => true,
	'show_meta' => true,
) );

$path_id = get_the_ID();
$hero_description = get_post_meta( $path_id, '_codina_hero_description', true );
$level = get_post_meta( $path_id, '_codina_level', true );
$duration = get_post_meta( $path_id, '_codina_estimated_duration', true );

$level_labels = array(
	'beginner' => 'مبتدی',
	'junior' => 'جونیور',
	'intermediate' => 'متوسط',
	'senior' => 'سنیور',
);
$level_label = isset( $level_labels[ $level ] ) ? $level_labels[ $level ] : '';
?>

<article class="card hover:shadow-xl transition-shadow duration-300 flex flex-col">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="mb-4 -mx-6 -mt-6">
			<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
				<?php
				the_post_thumbnail(
					'medium_large',
					array(
						'class' => 'w-full h-48 object-cover rounded-t-lg',
						'loading' => 'lazy',
						'sizes' => '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw',
					)
				);
				?>
			</a>
		</div>
	<?php endif; ?>
	
	<?php if ( $args['show_meta'] ) : ?>
		<div class="flex items-center gap-2 mb-3 flex-wrap">
			<?php if ( $level_label ) : ?>
				<span class="inline-block px-3 py-1 bg-codina-100 text-codina-700 text-xs font-medium rounded-full">
					<?php echo esc_html( $level_label ); ?>
				</span>
			<?php endif; ?>
			<?php if ( $duration ) : ?>
				<span class="text-gray-500 text-xs">⏱ <?php echo esc_html( $duration ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<h3 class="text-xl font-bold mb-3">
		<a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-codina-600 transition-colors">
			<?php the_title(); ?>
		</a>
	</h3>

	<?php if ( $args['show_description'] && $hero_description ) : ?>
		<p class="text-gray-600 mb-4 line-clamp-2 flex-1">
			<?php echo esc_html( wp_trim_words( $hero_description, 20 ) ); ?>
		</p>
	<?php endif; ?>

	<a href="<?php the_permalink(); ?>" class="inline-block text-codina-600 font-medium hover:text-codina-700 transition-colors mt-auto">
		مشاهده مسیر یادگیری →
	</a>
</article>

