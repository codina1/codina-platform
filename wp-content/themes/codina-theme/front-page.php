<?php
/**
 * The front page template
 *
 * @package Codina
 */

get_header();
?>

<main id="main" class="site-main">
	
	<?php
	// Hero Section - Main H1 for homepage
	get_template_part( 'template-parts/home/hero' );

	// Learning Paths Section
	get_template_part( 'template-parts/home/learning-paths' );

	// Featured Courses Section
	get_template_part( 'template-parts/home/featured-courses' );

	// Why Codina Section
	get_template_part( 'template-parts/home/why-codina' );

	// Testimonials Section
	get_template_part( 'template-parts/home/testimonials' );

	// Blog Preview Section
	get_template_part( 'template-parts/home/blog-preview' );
	?>

</main>

<?php
get_footer();

