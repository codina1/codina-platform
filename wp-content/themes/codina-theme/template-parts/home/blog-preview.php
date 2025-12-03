<?php
/**
 * Blog preview section template
 *
 * @package Codina
 */

// Query latest blog posts
$blog_posts = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>

<section class="blog-preview-section py-16 md:py-24 bg-gray-50">
	<div class="container">
		<?php
		get_template_part( 'template-parts/components/section-heading', null, array(
			'title' => 'آخرین مقالات',
			'subtitle' => 'مقالات و مطالب آموزشی برای یادگیری بیشتر',
			'align' => 'center',
		) );
		?>

		<?php if ( $blog_posts->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
				<?php
				while ( $blog_posts->have_posts() ) :
					$blog_posts->the_post();
					?>
					<article class="card hover:shadow-xl transition-shadow duration-300">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="mb-4 -mx-6 -mt-6">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover rounded-t-lg' ) ); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="text-sm text-gray-500 mb-2">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						</div>

						<h3 class="text-xl font-bold mb-3">
							<a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-codina-600 transition-colors">
								<?php the_title(); ?>
							</a>
						</h3>

						<?php if ( has_excerpt() ) : ?>
							<p class="text-gray-600 mb-4 line-clamp-3">
								<?php the_excerpt(); ?>
							</p>
						<?php else : ?>
							<p class="text-gray-600 mb-4 line-clamp-3">
								<?php echo esc_html( wp_trim_words( get_the_content(), 20 ) ); ?>
							</p>
						<?php endif; ?>

						<a href="<?php the_permalink(); ?>" class="inline-block text-codina-600 font-medium hover:text-codina-700 transition-colors">
							ادامه مطلب →
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="text-center mt-12">
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-primary">
					مشاهده همه مقالات
				</a>
			</div>
		<?php else : ?>
			<div class="text-center py-12">
				<p class="text-gray-600 text-lg">
					هنوز مقاله‌ای منتشر نشده است.
				</p>
			</div>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>

