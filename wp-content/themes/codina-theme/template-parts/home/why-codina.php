<?php
/**
 * Why Codina section template
 *
 * @package Codina
 */

$features = array(
	array(
		'icon' => '📚',
		'title' => 'مسیرهای ساختاریافته',
		'description' => 'یادگیری گام‌به‌گام با مسیرهای مشخص که شما را از مبتدی به متخصص می‌رساند',
	),
	array(
		'icon' => '🎯',
		'title' => 'تمرکز بر مهارت‌های عملی',
		'description' => 'محتوای کاربردی و پروژه‌محور که مستقیماً در کار واقعی به کار می‌آید',
	),
	array(
		'icon' => '👥',
		'title' => 'جامعه یادگیرندگان',
		'description' => 'همراهی با دیگر یادگیرندگان و به‌اشتراک‌گذاری تجربیات',
	),
	array(
		'icon' => '🚀',
		'title' => 'یادگیری در زمان خود',
		'description' => 'دسترسی ۲۴/۷ به محتوا و یادگیری با سرعت مناسب خودتان',
	),
);
?>

<section class="why-codina-section py-16 md:py-24 bg-gradient-to-l from-gray-50 to-white">
	<div class="container">
		<?php
		get_template_part( 'template-parts/components/section-heading', null, array(
			'title' => 'چرا Codina؟',
			'subtitle' => 'پلتفرمی که یادگیری را برای شما آسان و لذت‌بخش می‌کند',
			'align' => 'center',
		) );
		?>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
			<?php foreach ( $features as $feature ) : ?>
				<div class="card text-center hover:shadow-xl transition-shadow duration-300">
					<div class="text-5xl mb-4"><?php echo esc_html( $feature['icon'] ); ?></div>
					<h3 class="text-xl font-bold mb-3 text-gray-900">
						<?php echo esc_html( $feature['title'] ); ?>
					</h3>
					<p class="text-gray-600 leading-relaxed">
						<?php echo esc_html( $feature['description'] ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

