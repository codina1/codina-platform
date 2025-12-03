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
	
	<?php
	$benefits = get_post_meta( get_the_ID(), '_codina_benefits', true );
	if ( $benefits ) :
		$benefits_lines = explode( "\n", $benefits );
		$benefits_lines = array_filter( array_map( 'trim', $benefits_lines ) );
		?>
		<section class="card">
			<h2 class="text-2xl font-bold mb-4">مزایا / خروجی‌های دوره</h2>
			<ul class="space-y-2 text-gray-700">
				<?php foreach ( $benefits_lines as $benefit ) : ?>
					<?php if ( ! empty( $benefit ) ) : ?>
						<li class="flex items-start gap-3">
							<span class="text-codina-600 mt-1">✓</span>
							<span><?php echo esc_html( $benefit ); ?></span>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
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
	
	<?php
	$skills = get_post_meta( get_the_ID(), '_codina_skills', true );
	$course_type = get_post_meta( get_the_ID(), '_codina_course_type', true );
	$additional_resources = get_post_meta( get_the_ID(), '_codina_additional_resources', false );
	
	$course_type_labels = array(
		'video' => 'ویدئویی',
		'text' => 'متنی',
		'mixed' => 'ترکیبی',
	);
	$course_type_label = isset( $course_type_labels[ $course_type ] ) ? $course_type_labels[ $course_type ] : '';
	?>
	
	<?php if ( $skills ) : ?>
		<section class="card">
			<h2 class="text-2xl font-bold mb-4">مهارت‌های این دوره</h2>
			<div class="flex flex-wrap gap-2">
				<?php
				$skills_array = array_map( 'trim', explode( ',', $skills ) );
				foreach ( $skills_array as $skill ) :
					if ( ! empty( $skill ) ) :
						?>
						<span class="inline-block px-4 py-2 bg-codina-100 text-codina-700 rounded-full text-sm font-medium">
							<?php echo esc_html( $skill ); ?>
						</span>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ( $course_type_label ) : ?>
		<section class="card">
			<h2 class="text-2xl font-bold mb-4">نوع دوره</h2>
			<p class="text-gray-700">
				<span class="inline-block px-4 py-2 bg-accent-100 text-accent-700 rounded-full font-medium">
					<?php echo esc_html( $course_type_label ); ?>
				</span>
			</p>
		</section>
	<?php endif; ?>
	
	<?php if ( ! empty( $additional_resources ) && is_array( $additional_resources ) ) : ?>
		<section class="card">
			<h2 class="text-2xl font-bold mb-4">لینک‌ها و منابع اضافی</h2>
			<div class="space-y-3">
				<?php foreach ( $additional_resources as $resource ) : ?>
					<?php
					$resource_title = isset( $resource['title'] ) ? $resource['title'] : '';
					$resource_url   = isset( $resource['url'] ) ? $resource['url'] : '';
					if ( ! empty( $resource_title ) && ! empty( $resource_url ) ) :
						?>
						<div class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-codina-300 transition-colors">
							<span class="text-2xl">🔗</span>
							<div class="flex-1">
								<a href="<?php echo esc_url( $resource_url ); ?>" target="_blank" rel="noopener" class="text-codina-600 hover:text-codina-700 font-medium">
									<?php echo esc_html( $resource_title ); ?>
								</a>
							</div>
							<a href="<?php echo esc_url( $resource_url ); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-gray-600">
								↗
							</a>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

</div>

