<?php
/**
 * Lesson attachments template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'attachments' => array(),
) );

if ( empty( $args['attachments'] ) ) {
	return;
}
?>

<div class="lesson-attachments card">
	<h3 class="text-xl font-bold mb-4">فایل‌های ضمیمه</h3>
	<div class="space-y-2">
		<?php foreach ( $args['attachments'] as $attachment_id ) : ?>
			<?php
			$attachment = get_post( $attachment_id );
			if ( ! $attachment ) {
				continue;
			}
			$file_url = wp_get_attachment_url( $attachment_id );
			$file_name = get_the_title( $attachment_id );
			$file_size = size_format( filesize( get_attached_file( $attachment_id ) ) );
			?>
			<a 
				href="<?php echo esc_url( $file_url ); ?>" 
				download
				class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-codina-300 hover:bg-gray-50 transition-all"
			>
				<div class="flex items-center gap-3">
					<span class="text-2xl">📎</span>
					<div>
						<div class="font-medium text-gray-900"><?php echo esc_html( $file_name ); ?></div>
						<div class="text-sm text-gray-500"><?php echo esc_html( $file_size ); ?></div>
					</div>
				</div>
				<span class="text-codina-600">⬇</span>
			</a>
		<?php endforeach; ?>
	</div>
</div>

