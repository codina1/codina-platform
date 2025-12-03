<?php
/**
 * Learning Paths section template
 *
 * @package Codina
 */

// Query top learning paths
$learning_paths = new WP_Query(
	array(
		'post_type'      => 'learning_path',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>

<section id="learning-paths" class="learning-paths-section py-16 md:py-24 bg-gray-50">
	<div class="container">
		<?php
		get_template_part( 'template-parts/components/section-heading', null, array(
			'title' => 'مسیرهای یادگیری محبوب',
			'subtitle' => 'مسیرهای ساختاریافته برای یادگیری مهارت‌های جدید از مبتدی تا پیشرفته',
			'align' => 'center',
		) );
		?>

		<?php if ( $learning_paths->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
				<?php
				while ( $learning_paths->have_posts() ) :
					$learning_paths->the_post();
					get_template_part( 'template-parts/components/path-card' );
				endwhile;
				?>
			</div>

			<div class="text-center mt-12">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'learning_path' ) ); ?>" class="btn btn-primary">
					مشاهده همه مسیرهای یادگیری
				</a>
			</div>
		<?php else : ?>
			<?php
			get_template_part( 'template-parts/components/empty-state', null, array(
				'icon' => '📚',
				'title' => 'هنوز مسیر یادگیری‌ای ایجاد نشده است',
				'message' => '',
			) );
			?>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>

