<?php
/**
 * The template for displaying single course pages
 *
 * @package Codina
 */

get_header();

while ( have_posts() ) :
	the_post();
	
	$course_id = get_the_ID();
	$short_description = get_post_meta( $course_id, '_codina_short_description', true );
	$full_description = get_post_meta( $course_id, '_codina_full_description', true );
	$level = get_post_meta( $course_id, '_codina_level', true );
	$duration = get_post_meta( $course_id, '_codina_duration', true );
	$last_updated = get_post_meta( $course_id, '_codina_last_updated', true );
	$prerequisites = get_post_meta( $course_id, '_codina_prerequisites', true );
	$wc_product_id = get_post_meta( $course_id, '_codina_woocommerce_product_id', true );
	
	// Get WooCommerce product data
	$product = null;
	$price = '';
	$sale_price = '';
	$regular_price = '';
	$is_purchased = false;
	
	if ( $wc_product_id && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $wc_product_id );
		if ( $product ) {
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_sale_price();
			$price = $product->get_price_html();
			
			// Check if user has purchased
			if ( is_user_logged_in() ) {
				$user_id = get_current_user_id();
				$is_purchased = wc_customer_bought_product( '', $user_id, $wc_product_id );
			}
		}
	}
	
	// Get lessons for this course
	$lessons = get_posts(
		array(
			'post_type'      => 'codina_lesson',
			'post_parent'    => $course_id,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	
	// Get learning paths that reference this course
	$related_paths = array();
	$all_resources = get_posts(
		array(
			'post_type'      => 'learning_resource',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'   => '_codina_linked_course_id',
					'value' => $course_id,
					'compare' => '=',
				),
			),
		)
	);
	
	foreach ( $all_resources as $resource ) {
		$step_id = $resource->post_parent;
		if ( $step_id ) {
			$step = get_post( $step_id );
			if ( $step ) {
				$phase_id = $step->post_parent;
				if ( $phase_id ) {
					$phase = get_post( $phase_id );
					if ( $phase ) {
						$path_id = $phase->post_parent;
						if ( $path_id && ! in_array( $path_id, array_column( $related_paths, 'ID' ) ) ) {
							$related_paths[] = get_post( $path_id );
						}
					}
				}
			}
		}
	}
	?>

	<main id="main" class="site-main course-page" itemscope itemtype="https://schema.org/Course">
		
		<?php
		// Hero section
		get_template_part( 'template-parts/course/course-hero', null, array(
			'short_description' => $short_description,
			'level' => $level,
			'duration' => $duration,
			'last_updated' => $last_updated,
			'price' => $price,
			'product' => $product,
			'is_purchased' => $is_purchased,
		) );
		?>

		<div class="container py-8 md:py-12">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
				
				<!-- Main Content -->
				<div class="lg:col-span-2 space-y-8">
					
					<?php
					// Course content sections
					get_template_part( 'template-parts/course/course-content', null, array(
						'full_description' => $full_description,
						'prerequisites' => $prerequisites,
					) );
					
					// Curriculum accordion
					get_template_part( 'template-parts/course/course-curriculum', null, array(
						'lessons' => $lessons,
						'is_purchased' => $is_purchased,
					) );
					
					// Related paths
					if ( ! empty( $related_paths ) ) {
						get_template_part( 'template-parts/course/related-paths', null, array(
							'paths' => $related_paths,
						) );
					}
					?>
					
				</div>
				
				<!-- Sidebar -->
				<aside class="lg:col-span-1">
					<?php
					// Sticky purchase box
					get_template_part( 'template-parts/course/purchase-box', null, array(
						'product' => $product,
						'price' => $price,
						'sale_price' => $sale_price,
						'regular_price' => $regular_price,
						'wc_product_id' => $wc_product_id,
						'is_purchased' => $is_purchased,
					) );
					?>
				</aside>
				
			</div>
		</div>

	</main>

	<?php
endwhile;
get_footer();

