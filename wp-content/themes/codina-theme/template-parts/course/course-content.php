<?php
/**
 * Course content sections template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'full_description' => '',
	'prerequisites' => '',
) );
?>

<div class="course-content space-y-8">
	
	<?php if ( $args['full_description'] || get_the_content() ) : ?>
		<section class="card" itemprop="description">
			<h2 class="text-2xl font-bold mb-4">درباره دوره</h2>
			<div class="prose prose-lg max-w-none">
				<?php
				if ( $args['full_description'] ) {
					echo wp_kses_post( wpautop( $args['full_description'] ) );
				} else {
					the_content();
				}
				?>
			</div>
		</section>
	<?php endif; ?>
	
	<section class="card">
		<h2 class="text-2xl font-bold mb-4">این دوره برای چه کسانی مناسب است؟</h2>
		<ul class="space-y-2 text-gray-700">
			<li class="flex items-start gap-3">
				<span class="text-codina-600 mt-1">✓</span>
				<span>برای افرادی که می‌خواهند مهارت‌های جدید یاد بگیرند</span>
			</li>
			<li class="flex items-start gap-3">
				<span class="text-codina-600 mt-1">✓</span>
				<span>برای کسانی که می‌خواهند دانش خود را به‌روز کنند</span>
			</li>
			<li class="flex items-start gap-3">
				<span class="text-codina-600 mt-1">✓</span>
				<span>برای علاقه‌مندان به یادگیری عملی و پروژه‌محور</span>
			</li>
			<li class="flex items-start gap-3">
				<span class="text-codina-600 mt-1">✓</span>
				<span>برای افرادی که می‌خواهند مهارت‌های خود را در کار واقعی به کار بگیرند</span>
			</li>
		</ul>
	</section>
	
	<?php if ( $args['prerequisites'] ) : ?>
		<section class="card">
			<h2 class="text-2xl font-bold mb-4">پیش‌نیازها</h2>
			<div class="prose prose-lg max-w-none">
				<?php echo wp_kses_post( wpautop( $args['prerequisites'] ) ); ?>
			</div>
		</section>
	<?php endif; ?>
	
	<section class="card">
		<h2 class="text-2xl font-bold mb-4">آنچه در این دوره یاد می‌گیرید</h2>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<div class="flex items-start gap-3">
				<span class="text-codina-600 text-xl">🎯</span>
				<span>درک کامل مفاهیم اصلی</span>
			</div>
			<div class="flex items-start gap-3">
				<span class="text-codina-600 text-xl">💡</span>
				<span>کاربرد عملی در پروژه‌های واقعی</span>
			</div>
			<div class="flex items-start gap-3">
				<span class="text-codina-600 text-xl">🔧</span>
				<span>تکنیک‌ها و بهترین روش‌ها</span>
			</div>
			<div class="flex items-start gap-3">
				<span class="text-codina-600 text-xl">🚀</span>
				<span>آماده شدن برای کار حرفه‌ای</span>
			</div>
		</div>
	</section>

</div>

