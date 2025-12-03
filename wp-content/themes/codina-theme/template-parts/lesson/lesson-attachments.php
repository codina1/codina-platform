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
		<?php foreach ( $args['attachments'] as $attachment ) : ?>
			<?php
			// Handle both array format and direct URL
			if ( is_array( $attachment ) ) {
				$file_url = isset( $attachment['url'] ) ? $attachment['url'] : '';
				$file_title = isset( $attachment['title'] ) ? $attachment['title'] : '';
			} else {
				$file_url = $attachment;
				$file_title = '';
			}
			
			if ( empty( $file_url ) ) {
				continue;
			}
			
			// Try to get file name from URL if title is empty
			if ( empty( $file_title ) ) {
				$file_title = basename( parse_url( $file_url, PHP_URL_PATH ) );
				if ( empty( $file_title ) ) {
					$file_title = 'دانلود فایل';
				}
			}
			?>
			<a 
				href="<?php echo esc_url( $file_url ); ?>" 
				download
				target="_blank"
				rel="noopener"
				class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-codina-300 hover:bg-gray-50 transition-all"
			>
				<div class="flex items-center gap-3">
					<span class="text-2xl">📎</span>
					<div>
						<div class="font-medium text-gray-900"><?php echo esc_html( $file_title ); ?></div>
						<div class="text-sm text-gray-500"><?php echo esc_url( $file_url ); ?></div>
					</div>
				</div>
				<span class="text-codina-600">⬇</span>
			</a>
		<?php endforeach; ?>
	</div>
</div>

