<?php
/**
 * Course curriculum accordion template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'lessons' => array(),
	'is_purchased' => false,
) );
?>

<section id="curriculum" class="course-curriculum card" x-data="{ openLesson: null }">
	<h2 class="text-2xl font-bold mb-6">سرفصل دوره</h2>
	
	<?php if ( ! empty( $args['lessons'] ) ) : ?>
		<div class="space-y-2">
			<?php foreach ( $args['lessons'] as $index => $lesson ) : ?>
				<?php
				$lesson_video = get_post_meta( $lesson->ID, '_codina_video_url', true );
				$lesson_order = get_post_meta( $lesson->ID, '_codina_order', true );
				?>
				<div class="border border-gray-200 rounded-lg overflow-hidden">
					<button
						@click="openLesson = openLesson === <?php echo esc_attr( $index ); ?> ? null : <?php echo esc_attr( $index ); ?>"
						class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors text-right"
					>
						<div class="flex items-center gap-4 flex-1">
							<div class="flex-shrink-0 w-8 h-8 bg-codina-100 text-codina-700 rounded-full flex items-center justify-center font-bold">
								<?php echo esc_html( $index + 1 ); ?>
							</div>
							<div class="flex-1 text-right">
								<h3 class="font-bold text-gray-900"><?php echo esc_html( $lesson->post_title ); ?></h3>
								<?php if ( $lesson_video ) : ?>
									<p class="text-sm text-gray-500 mt-1">ویدیو آموزشی</p>
								<?php endif; ?>
							</div>
						</div>
						<div class="flex items-center gap-3">
							<?php if ( ! $args['is_purchased'] ) : ?>
								<span class="text-gray-400">🔒</span>
							<?php else : ?>
								<a 
									href="<?php echo esc_url( get_permalink( $lesson->ID ) ); ?>" 
									class="text-codina-600 hover:text-codina-700 font-medium"
									@click.stop
								>
									مشاهده
								</a>
							<?php endif; ?>
							<svg 
								class="w-5 h-5 text-gray-400 transition-transform"
								:class="{ 'rotate-180': openLesson === <?php echo esc_attr( $index ); ?> }"
								fill="none" 
								stroke="currentColor" 
								viewBox="0 0 24 24"
							>
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
							</svg>
						</div>
					</button>
					
					<div 
						x-show="openLesson === <?php echo esc_attr( $index ); ?>"
						x-transition
						class="border-t border-gray-200 p-4 bg-gray-50"
					>
						<?php if ( $lesson->post_content ) : ?>
							<div class="prose prose-sm max-w-none mb-4">
								<?php echo wp_kses_post( wpautop( $lesson->post_content ) ); ?>
							</div>
						<?php endif; ?>
						
						<?php if ( $args['is_purchased'] ) : ?>
							<a 
								href="<?php echo esc_url( get_permalink( $lesson->ID ) ); ?>" 
								class="btn btn-primary inline-block"
							>
								شروع درس
							</a>
						<?php else : ?>
							<p class="text-sm text-gray-600 italic">
								برای مشاهده این درس باید دوره را خریداری کنید
							</p>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<p class="text-gray-600">هنوز درسی برای این دوره اضافه نشده است.</p>
	<?php endif; ?>
</section>

