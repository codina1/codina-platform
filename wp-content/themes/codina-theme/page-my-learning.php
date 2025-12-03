<?php
/**
 * Template Name: My Learning Dashboard
 * 
 * Student dashboard page template
 * 
 * @package Codina
 */

// Redirect to login if not logged in
if ( ! is_user_logged_in() ) {
	get_header();
	?>
	<main id="main" class="site-main">
		<div class="container py-16 md:py-24">
			<div class="max-w-2xl mx-auto text-center">
				<div class="card p-8 md:p-12">
					<div class="text-6xl mb-6">🔐</div>
					<h1 class="text-3xl md:text-4xl font-bold mb-4">برای مشاهده داشبورد وارد شوید</h1>
					<p class="text-lg text-gray-600 mb-8">
						برای دسترسی به دوره‌ها و مسیرهای یادگیری خود، لطفاً وارد حساب کاربری شوید.
					</p>
					<div class="flex flex-col sm:flex-row gap-4 justify-center">
						<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn btn-primary">
							ورود به حساب کاربری
						</a>
						<?php if ( get_option( 'users_can_register' ) ) : ?>
							<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn btn-secondary">
								ثبت‌نام
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php
	get_footer();
	return;
}

get_header();

// Load dashboard helper class
// The class should be loaded by codina-core plugin, but we check for safety
if ( ! class_exists( 'Codina_Dashboard_Helpers' ) ) {
	$helper_file = WP_PLUGIN_DIR . '/codina-core/includes/dashboard/class-dashboard-helpers.php';
	if ( file_exists( $helper_file ) ) {
		require_once $helper_file;
	}
}

// Get user data
$purchased_courses = Codina_Dashboard_Helpers::get_user_purchased_courses();
$followed_paths = Codina_Dashboard_Helpers::get_user_followed_paths();
$current_user = wp_get_current_user();
?>

<main id="main" class="site-main dashboard-page">
	
	<?php get_template_part( 'template-parts/dashboard/dashboard-header' ); ?>
	
	<div class="container py-8 md:py-12">
		
		<!-- Purchased Courses Section -->
		<?php get_template_part( 'template-parts/dashboard/purchased-courses', null, array(
			'courses' => $purchased_courses,
		) ); ?>
		
		<!-- Learning Paths Section -->
		<?php get_template_part( 'template-parts/dashboard/learning-paths', null, array(
			'paths' => $followed_paths,
		) ); ?>
		
	</div>

</main>

<?php
get_footer();

