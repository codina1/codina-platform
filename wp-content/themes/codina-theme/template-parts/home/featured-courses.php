<?php
/**
 * Featured Courses section template
 *
 * @package Codina
 */

// Query featured courses
$courses = new WP_Query(
	array(
		'post_type'      => 'codina_course',
		'posts_per_page' => 4,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>

<section id="courses" class="featured-courses-section py-16 md:py-24 bg-white">
	<div class="container">
		<?php
		get_template_part( 'template-parts/components/section-heading', null, array(
			'title' => 'دوره‌های ویژه',
			'subtitle' => 'دوره‌های جامع و کاربردی برای یادگیری مهارت‌های جدید',
			'align' => 'center',
		) );
		?>

		<?php if ( $courses->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
				<?php
				while ( $courses->have_posts() ) :
					$courses->the_post();
					get_template_part( 'template-parts/components/course-card', null, array(
						'course' => get_post(),
					) );
				endwhile;
				?>
			</div>

			<div class="text-center mt-12">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'codina_course' ) ); ?>" class="btn btn-primary">
					مشاهده همه دوره‌ها
				</a>
			</div>
		<?php else : ?>
			<?php
			get_template_part( 'template-parts/components/empty-state', null, array(
				'icon' => '📖',
				'title' => 'هنوز دوره‌ای ایجاد نشده است',
				'message' => '',
			) );
			?>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>

