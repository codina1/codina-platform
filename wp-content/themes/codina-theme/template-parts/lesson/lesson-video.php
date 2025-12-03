<?php
/**
 * Lesson video player template
 *
 * @package Codina
 * 
 * @var array $args Template arguments
 */

$args = wp_parse_args( $args, array(
	'video_url' => '',
) );

if ( ! $args['video_url'] ) {
	return;
}

// Detect video platform
$video_url = esc_url( $args['video_url'] );
$embed_url = '';
$is_youtube = false;
$is_vimeo = false;

// YouTube detection
if ( preg_match( '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $video_url, $matches ) || 
	 preg_match( '/youtu\.be\/([a-zA-Z0-9_-]+)/', $video_url, $matches ) ) {
	$embed_url = 'https://www.youtube.com/embed/' . $matches[1];
	$is_youtube = true;
}
// Vimeo detection
elseif ( preg_match( '/vimeo\.com\/(\d+)/', $video_url, $matches ) ) {
	$embed_url = 'https://player.vimeo.com/video/' . $matches[1];
	$is_vimeo = true;
}
// Direct video file or other platform
else {
	$embed_url = $video_url;
}
?>

<div class="lesson-video mb-6">
	<div class="relative w-full" style="padding-bottom: 56.25%;">
		<iframe
			class="absolute top-0 right-0 w-full h-full rounded-lg"
			src="<?php echo esc_url( $embed_url ); ?>"
			frameborder="0"
			allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
			allowfullscreen
		></iframe>
	</div>
</div>

