<?php
/**
 * Learning Path Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Learning_Path_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type    = 'learning_path';
		$this->meta_box_id  = 'codina_learning_path_meta';
		$this->meta_box_title = __( 'اطلاعات مسیر یادگیری', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_learning_path_meta', 'codina_learning_path_meta_nonce' );

		$hero_description = $this->get_meta( $post->ID, '_codina_hero_description' );
		$level            = $this->get_meta( $post->ID, '_codina_level' );
		$estimated_duration = $this->get_meta( $post->ID, '_codina_estimated_duration' );
		$hero_video_url   = $this->get_meta( $post->ID, '_codina_hero_video_url' );
		$outcomes         = $this->get_meta( $post->ID, '_codina_outcomes', false );

		if ( ! is_array( $outcomes ) ) {
			$outcomes = array();
		}
		?>

		<div class="codina-meta-box" dir="rtl">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="codina_hero_description"><?php esc_html_e( 'توضیحات هیرو', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_hero_description" 
								name="codina_hero_description" 
								rows="3" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'توضیحات کوتاه برای بخش هیرو...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $hero_description ); ?></textarea>
							<p class="description"><?php esc_html_e( 'توضیحات کوتاه که در بخش هیرو نمایش داده می‌شود', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_level"><?php esc_html_e( 'سطح', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_level" name="codina_level" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
								<option value="beginner" <?php selected( $level, 'beginner' ); ?>><?php esc_html_e( 'مبتدی', 'codina-core' ); ?></option>
								<option value="junior" <?php selected( $level, 'junior' ); ?>><?php esc_html_e( 'جونیور', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'سطح مسیر یادگیری', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_estimated_duration"><?php esc_html_e( 'مدت زمان تخمینی', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="text" 
								id="codina_estimated_duration" 
								name="codina_estimated_duration" 
								value="<?php echo esc_attr( $estimated_duration ); ?>" 
								class="regular-text"
								placeholder="<?php esc_attr_e( 'مثال: 3 ماه', 'codina-core' ); ?>"
							/>
							<p class="description"><?php esc_html_e( 'مدت زمان تخمینی برای تکمیل این مسیر', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_hero_video_url"><?php esc_html_e( 'آدرس ویدیو هیرو', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="url" 
								id="codina_hero_video_url" 
								name="codina_hero_video_url" 
								value="<?php echo esc_url( $hero_video_url ); ?>" 
								class="large-text code"
								placeholder="https://..."
							/>
							<p class="description"><?php esc_html_e( 'آدرس ویدیو معرفی مسیر یادگیری (YouTube, Vimeo, etc.)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'نتایج یادگیری', 'codina-core' ); ?></label>
						</th>
						<td>
							<div id="codina-outcomes-container">
								<?php if ( ! empty( $outcomes ) ) : ?>
									<?php foreach ( $outcomes as $index => $outcome ) : ?>
										<div class="codina-outcome-item" style="margin-bottom: 10px;">
											<input 
												type="text" 
												name="codina_outcomes[]" 
												value="<?php echo esc_attr( $outcome ); ?>" 
												class="regular-text"
												placeholder="<?php esc_attr_e( 'مهارت یا نتیجه یادگیری', 'codina-core' ); ?>"
											/>
											<button type="button" class="button codina-remove-outcome"><?php esc_html_e( 'حذف', 'codina-core' ); ?></button>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<button type="button" id="codina-add-outcome" class="button"><?php esc_html_e( '+ افزودن نتیجه', 'codina-core' ); ?></button>
							<p class="description"><?php esc_html_e( 'مهارت‌ها و نتایجی که دانشجو پس از تکمیل این مسیر به دست می‌آورد', 'codina-core' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#codina-add-outcome').on('click', function() {
				var item = $('<div class="codina-outcome-item" style="margin-bottom: 10px;">' +
					'<input type="text" name="codina_outcomes[]" class="regular-text" placeholder="<?php echo esc_js( __( 'مهارت یا نتیجه یادگیری', 'codina-core' ) ); ?>" />' +
					'<button type="button" class="button codina-remove-outcome"><?php echo esc_js( __( 'حذف', 'codina-core' ) ); ?></button>' +
					'</div>');
				$('#codina-outcomes-container').append(item);
			});

			$(document).on('click', '.codina-remove-outcome', function() {
				$(this).closest('.codina-outcome-item').remove();
			});
		});
		</script>

		<?php
	}

	/**
	 * Save the meta box data.
	 *
	 * @param int     $post_id The post ID.
	 * @param WP_Post $post    The post object.
	 */
	public function save_meta_box( $post_id, $post ) {
		// Check if this is the correct post type.
		if ( $post->post_type !== $this->post_type ) {
			return;
		}

		// Verify nonce.
		if ( ! $this->verify_nonce( 'codina_learning_path_meta_nonce', 'codina_learning_path_meta' ) ) {
			return;
		}

		// Check if autosave.
		if ( $this->is_autosave() ) {
			return;
		}

		// Check permissions.
		if ( ! $this->can_edit( $post_id ) ) {
			return;
		}

		// Save hero description.
		if ( isset( $_POST['codina_hero_description'] ) ) {
			$this->update_meta( $post_id, '_codina_hero_description', $this->sanitize_textarea( $_POST['codina_hero_description'] ) );
		}

		// Save level.
		if ( isset( $_POST['codina_level'] ) ) {
			$level = $this->sanitize_text( $_POST['codina_level'] );
			if ( in_array( $level, array( 'beginner', 'junior' ), true ) ) {
				$this->update_meta( $post_id, '_codina_level', $level );
			}
		}

		// Save estimated duration.
		if ( isset( $_POST['codina_estimated_duration'] ) ) {
			$this->update_meta( $post_id, '_codina_estimated_duration', $this->sanitize_text( $_POST['codina_estimated_duration'] ) );
		}

		// Save hero video URL.
		if ( isset( $_POST['codina_hero_video_url'] ) ) {
			$this->update_meta( $post_id, '_codina_hero_video_url', $this->sanitize_url( $_POST['codina_hero_video_url'] ) );
		}

		// Save outcomes.
		if ( isset( $_POST['codina_outcomes'] ) && is_array( $_POST['codina_outcomes'] ) ) {
			$outcomes = array_map( array( $this, 'sanitize_text' ), $_POST['codina_outcomes'] );
			$outcomes = array_filter( $outcomes ); // Remove empty values.
			$this->delete_meta( $post_id, '_codina_outcomes' );
			foreach ( $outcomes as $outcome ) {
				add_post_meta( $post_id, '_codina_outcomes', $outcome );
			}
		} else {
			$this->delete_meta( $post_id, '_codina_outcomes' );
		}
	}
}

