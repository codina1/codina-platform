<?php
/**
 * Dashboard header template
 *
 * @package Codina
 */

$current_user = wp_get_current_user();
?>

<section class="dashboard-header bg-gradient-to-l from-codina-600 to-codina-800 text-white py-12 md:py-16">
	<div class="container">
		<div class="max-w-4xl">
			<h1 class="text-3xl md:text-5xl font-bold mb-4">
				یادگیری من
			</h1>
			<p class="text-xl md:text-2xl text-white/90">
				خوش آمدید، <?php echo esc_html( $current_user->display_name ); ?>
			</p>
		</div>
	</div>
</section>

