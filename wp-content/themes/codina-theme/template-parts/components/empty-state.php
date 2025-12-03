<?php
/**
 * Reusable empty state component
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'icon' => '📦',
	'title' => 'محتوایی وجود ندارد',
	'message' => '',
	'action_text' => '',
	'action_link' => '',
) );
?>

<div class="card text-center py-12">
	<?php if ( $args['icon'] ) : ?>
		<div class="text-5xl mb-4"><?php echo esc_html( $args['icon'] ); ?></div>
	<?php endif; ?>
	<h3 class="text-xl font-bold text-gray-900 mb-2">
		<?php echo esc_html( $args['title'] ); ?>
	</h3>
	<?php if ( $args['message'] ) : ?>
		<p class="text-gray-600 mb-6">
			<?php echo esc_html( $args['message'] ); ?>
		</p>
	<?php endif; ?>
	<?php if ( $args['action_text'] && $args['action_link'] ) : ?>
		<a href="<?php echo esc_url( $args['action_link'] ); ?>" class="btn btn-primary">
			<?php echo esc_html( $args['action_text'] ); ?>
		</a>
	<?php endif; ?>
</div>

