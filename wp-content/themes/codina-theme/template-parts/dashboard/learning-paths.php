<?php
/**
 * Learning paths section template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'paths' => array(),
) );
?>

<section class="learning-paths-section mb-12 md:mb-16">
	<?php
	get_template_part( 'template-parts/components/section-heading', null, array(
		'title' => 'مسیرهای یادگیری من',
		'subtitle' => 'مسیرهای یادگیری پیشنهادی برای شما',
		'align' => 'left',
	) );
	?>

	<?php if ( ! empty( $args['paths'] ) ) : ?>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
			<?php foreach ( $args['paths'] as $path ) : ?>
				<?php
				// Setup global post for template tags
				global $post;
				$original_post = $post;
				$post = $path;
				setup_postdata( $post );
				
				get_template_part( 'template-parts/components/path-card' );
				
				// Restore
				$post = $original_post;
				wp_reset_postdata();
				?>
			<?php endforeach; ?>
		</div>
		
		<div class="text-center mt-8">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'learning_path' ) ); ?>" class="btn btn-secondary">
				مشاهده همه مسیرهای یادگیری
			</a>
		</div>
	<?php else : ?>
		<?php
		get_template_part( 'template-parts/components/empty-state', null, array(
			'icon' => '🗺️',
			'title' => 'هنوز مسیر یادگیری‌ای وجود ندارد',
			'message' => 'به زودی مسیرهای یادگیری جدید اضافه خواهند شد',
			'action_text' => 'مشاهده مسیرهای یادگیری',
			'action_link' => get_post_type_archive_link( 'learning_path' ),
		) );
		?>
	<?php endif; ?>
</section>
