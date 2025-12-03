<?php
/**
 * Reusable Course card component
 *
 * @package Codina
 * 
 * @var WP_Post $course Course post object (optional, uses global post if not provided)
 * @var array   $args Additional arguments
 */

$args = wp_parse_args( $args, array(
	'show_description' => true,
	'show_meta' => true,
	'show_price' => true,
	'show_progress' => false,
	'progress_percent' => 0,
	'button_text' => 'مشاهده دوره',
	'button_link' => null,
) );

// Allow passing course post or use global
$course_post = isset( $args['course'] ) ? $args['course'] : get_post();
if ( ! $course_post ) {
	return;
}

$course_id = $course_post->ID;
$short_description = get_post_meta( $course_id, '_codina_short_description', true );
$level = get_post_meta( $course_id, '_codina_level', true );
$duration = get_post_meta( $course_id, '_codina_duration', true );
$last_updated = get_post_meta( $course_id, '_codina_last_updated', true );

$level_labels = array(
	'beginner' => 'مبتدی',
	'junior' => 'جونیور',
	'intermediate' => 'متوسط',
	'senior' => 'سنیور',
);
$level_label = isset( $level_labels[ $level ] ) ? $level_labels[ $level ] : '';

$wc_product_id = get_post_meta( $course_id, '_codina_woocommerce_product_id', true );
$price = '';
if ( $args['show_price'] && $wc_product_id && function_exists( 'wc_get_product' ) ) {
	$product = wc_get_product( $wc_product_id );
	if ( $product ) {
		$price = $product->get_price_html();
	}
}

$button_link = $args['button_link'] ?: get_permalink( $course_id );

// Setup global post for template tags
$original_post = $GLOBALS['post'];
$GLOBALS['post'] = $course_post;
setup_postdata( $course_post );
?>

<article class="card hover:shadow-xl transition-shadow duration-300 flex flex-col">
	<?php if ( has_post_thumbnail( $course_id ) ) : ?>
		<div class="mb-4 -mx-6 -mt-6">
			<a href="<?php echo esc_url( $button_link ); ?>" aria-label="<?php echo esc_attr( get_the_title( $course_id ) ); ?>">
				<?php
				echo get_the_post_thumbnail(
					$course_id,
					'medium_large',
					array(
						'class' => 'w-full h-40 object-cover rounded-t-lg',
						'loading' => 'lazy',
						'sizes' => '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw',
					)
				);
				?>
			</a>
		</div>
	<?php endif; ?>

	<div class="flex-1">
		<?php if ( $args['show_meta'] ) : ?>
			<div class="flex items-center gap-2 mb-3 flex-wrap">
				<?php if ( $level_label ) : ?>
					<span class="inline-block px-3 py-1 bg-accent-100 text-accent-700 text-xs font-medium rounded-full">
						<?php echo esc_html( $level_label ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $duration ) : ?>
					<span class="text-gray-500 text-xs">⏱ <?php echo esc_html( $duration ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<h3 class="text-lg md:text-xl font-bold mb-2">
			<a href="<?php echo esc_url( $button_link ); ?>" class="text-gray-900 hover:text-codina-600 transition-colors">
				<?php echo esc_html( get_the_title( $course_id ) ); ?>
			</a>
		</h3>

		<?php if ( $args['show_description'] && $short_description ) : ?>
			<p class="text-gray-600 text-sm mb-4 line-clamp-2">
				<?php echo esc_html( wp_trim_words( $short_description, 15 ) ); ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="mt-auto pt-4 border-t border-gray-200">
		<?php if ( $args['show_progress'] && $args['progress_percent'] > 0 ) : ?>
			<!-- Progress Bar -->
			<div class="mb-4">
				<div class="flex items-center justify-between mb-2">
					<span class="text-sm font-medium text-gray-700">پیشرفت</span>
					<span class="text-sm text-gray-600"><?php echo esc_html( $args['progress_percent'] ); ?>%</span>
				</div>
				<div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
					<div 
						class="bg-codina-600 h-2 rounded-full transition-all duration-500"
						style="width: <?php echo esc_attr( $args['progress_percent'] ); ?>%"
						role="progressbar"
						aria-valuenow="<?php echo esc_attr( $args['progress_percent'] ); ?>"
						aria-valuemin="0"
						aria-valuemax="100"
					></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $args['show_price'] && $price ) : ?>
			<div class="text-xl md:text-2xl font-bold text-codina-600 mb-3">
				<?php echo wp_kses_post( $price ); ?>
			</div>
		<?php endif; ?>

		<a 
			href="<?php echo esc_url( $button_link ); ?>" 
			class="btn btn-primary w-full text-center"
		>
			<?php echo esc_html( $args['button_text'] ); ?>
		</a>
	</div>
</article>

<?php
// Restore global post
$GLOBALS['post'] = $original_post;
wp_reset_postdata();
?>

