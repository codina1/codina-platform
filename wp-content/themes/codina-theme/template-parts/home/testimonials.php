<?php
/**
 * Testimonials section template
 *
 * @package Codina
 */

$testimonials = array(
	array(
		'name' => 'علی احمدی',
		'role' => 'توسعه‌دهنده وب',
		'content' => 'مسیرهای یادگیری Codina واقعاً عالی هستند. من در عرض ۳ ماه از مبتدی به سطح متوسط رسیدم.',
		'avatar' => '👤',
	),
	array(
		'name' => 'سارا رضایی',
		'role' => 'طراح UI/UX',
		'content' => 'محتوای عملی و پروژه‌محور Codina به من کمک کرد تا مهارت‌هایم را در کار واقعی به کار بگیرم.',
		'avatar' => '👩',
	),
	array(
		'name' => 'محمد کریمی',
		'role' => 'برنامه‌نویس',
		'content' => 'بهترین پلتفرم آموزشی که تا حالا استفاده کردم. ساختار و کیفیت محتوا عالی است.',
		'avatar' => '👨',
	),
);
?>

<section class="testimonials-section py-16 md:py-24 bg-white">
	<div class="container">
		<?php
		get_template_part( 'template-parts/components/section-heading', null, array(
			'title' => 'نظرات یادگیرندگان',
			'subtitle' => 'آنچه دیگران درباره Codina می‌گویند',
			'align' => 'center',
		) );
		?>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
			<?php foreach ( $testimonials as $testimonial ) : ?>
				<div class="card hover:shadow-xl transition-shadow duration-300">
					<div class="flex items-center gap-4 mb-4">
						<div class="text-4xl"><?php echo esc_html( $testimonial['avatar'] ); ?></div>
						<div>
							<h4 class="font-bold text-gray-900"><?php echo esc_html( $testimonial['name'] ); ?></h4>
							<p class="text-sm text-gray-600"><?php echo esc_html( $testimonial['role'] ); ?></p>
						</div>
					</div>
					<p class="text-gray-700 leading-relaxed italic">
						"<?php echo esc_html( $testimonial['content'] ); ?>"
					</p>
					<div class="mt-4 text-yellow-400">
						★★★★★
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

