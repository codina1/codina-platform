<?php
/**
 * Template functions.
 *
 * @package Codina
 */

/**
 * Get header template.
 */
function codina_get_header() {
	get_header();
}

/**
 * Get footer template.
 */
function codina_get_footer() {
	get_footer();
}

/**
 * Display site logo.
 */
function codina_the_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<?php bloginfo( 'name' ); ?>
		</a>
		<?php
	}
}

