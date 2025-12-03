<?php
/**
 * Learning Path phases timeline template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'phases' => array(),
) );
?>

<section class="path-phases mb-12 md:mb-16" x-data="{ openPhase: null }">
	<h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">مراحل مسیر یادگیری</h2>
	
	<?php if ( ! empty( $args['phases'] ) ) : ?>
		<div class="space-y-4">
			<?php foreach ( $args['phases'] as $index => $phase ) : ?>
				<?php
				$phase_description = get_post_meta( $phase->ID, '_codina_description', true );
				$phase_duration = get_post_meta( $phase->ID, '_codina_estimated_duration', true );
				$phase_order = get_post_meta( $phase->ID, '_codina_order', true );
				
				// Get steps for this phase
				$steps = get_posts(
					array(
						'post_type'      => 'learning_step',
						'post_parent'   => $phase->ID,
						'posts_per_page' => -1,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
					)
				);
				?>
				<div class="card">
					<button
						@click="openPhase = openPhase === <?php echo esc_attr( $index ); ?> ? null : <?php echo esc_attr( $index ); ?>"
						class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors text-right"
					>
						<div class="flex items-center gap-4 flex-1">
							<div class="flex-shrink-0 w-10 h-10 bg-codina-100 text-codina-700 rounded-full flex items-center justify-center font-bold text-lg">
								<?php echo esc_html( $index + 1 ); ?>
							</div>
							<div class="flex-1">
								<h3 class="text-xl font-bold text-gray-900 mb-1">
									<?php echo esc_html( $phase->post_title ); ?>
								</h3>
								<?php if ( $phase_duration ) : ?>
									<p class="text-sm text-gray-500">⏱ <?php echo esc_html( $phase_duration ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<svg 
							class="w-6 h-6 text-gray-400 transition-transform flex-shrink-0"
							:class="{ 'rotate-180': openPhase === <?php echo esc_attr( $index ); ?> }"
							fill="none" 
							stroke="currentColor" 
							viewBox="0 0 24 24"
						>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						</svg>
					</button>
					
					<div 
						x-show="openPhase === <?php echo esc_attr( $index ); ?>"
						x-transition
						class="border-t border-gray-200 p-6 bg-gray-50"
					>
						<?php if ( $phase_description ) : ?>
							<div class="prose prose-sm max-w-none mb-6">
								<?php echo wp_kses_post( wpautop( $phase_description ) ); ?>
							</div>
						<?php endif; ?>
						
						<?php if ( ! empty( $steps ) ) : ?>
							<h4 class="font-bold text-gray-900 mb-4">مراحل این فاز:</h4>
							<div class="space-y-3">
								<?php foreach ( $steps as $step ) : ?>
									<?php
									$step_type = get_post_meta( $step->ID, '_codina_type', true );
									$step_type_labels = array(
										'theory' => 'نظری',
										'practice' => 'عملی',
										'project' => 'پروژه',
									);
									$step_type_label = isset( $step_type_labels[ $step_type ] ) ? $step_type_labels[ $step_type ] : '';
									?>
									<div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
										<?php if ( $step_type_label ) : ?>
											<span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">
												<?php echo esc_html( $step_type_label ); ?>
											</span>
										<?php endif; ?>
										<span class="flex-1 text-gray-900"><?php echo esc_html( $step->post_title ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</section>

