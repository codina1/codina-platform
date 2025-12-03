<?php
/**
 * The template for displaying single learning path pages
 *
 * @package Codina
 */

get_header();

while ( have_posts() ) :
	the_post();
	
	$path_id = get_the_ID();
	$hero_description = get_post_meta( $path_id, '_codina_hero_description', true );
	$full_description = get_the_content();
	$level = get_post_meta( $path_id, '_codina_level', true );
	$estimated_duration = get_post_meta( $path_id, '_codina_estimated_duration', true );
	$hero_video_url = get_post_meta( $path_id, '_codina_hero_video_url', true );
	$outcomes = get_post_meta( $path_id, '_codina_outcomes', false );
	
	// Get phases for this learning path
	$phases = get_posts(
		array(
			'post_type'      => 'learning_phase',
			'post_parent'   => $path_id,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	?>

	<main id="main" class="site-main learning-path-page">
		
		<?php
		// Hero section
		get_template_part( 'template-parts/learning-path/path-hero', null, array(
			'hero_description' => $hero_description,
			'level' => $level,
			'estimated_duration' => $estimated_duration,
			'hero_video_url' => $hero_video_url,
		) );
		?>

		<div class="container py-8 md:py-12">
			
			<?php
			// Full description
			if ( $full_description ) {
				get_template_part( 'template-parts/learning-path/path-description', null, array(
					'description' => $full_description,
				) );
			}
			
			// Phases timeline
			if ( ! empty( $phases ) ) {
				get_template_part( 'template-parts/learning-path/path-phases', null, array(
					'phases' => $phases,
				) );
			}
			
			// Outcomes
			if ( ! empty( $outcomes ) && is_array( $outcomes ) ) {
				get_template_part( 'template-parts/learning-path/path-outcomes', null, array(
					'outcomes' => $outcomes,
				) );
			}
			?>
			
		</div>

	</main>

	<?php
endwhile;
get_footer();

