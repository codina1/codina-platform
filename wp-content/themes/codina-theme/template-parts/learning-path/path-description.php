<?php
/**
 * Learning Path description template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'description' => '',
) );
?>

<section class="path-description mb-12 md:mb-16">
	<div class="card">
		<div class="prose prose-lg max-w-none">
			<?php echo wp_kses_post( wpautop( $args['description'] ) ); ?>
		</div>
	</div>
</section>

