<?php
/**
 * The footer template
 *
 * @package Codina
 */
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-info">
				<p>
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> 
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php esc_html_e( 'تمام حقوق محفوظ است.', 'codina' ); ?>
				</p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

