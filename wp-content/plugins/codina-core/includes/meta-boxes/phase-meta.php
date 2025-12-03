<?php
/**
 * Phase Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Phase_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type    = 'learning_phase';
		$this->meta_box_id  = 'codina_phase_meta';
		$this->meta_box_title = __( 'اطلاعات فاز', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_phase_meta', 'codina_phase_meta_nonce' );

		$description        = $this->get_meta( $post->ID, '_codina_description' );
		$estimated_duration = $this->get_meta( $post->ID, '_codina_estimated_duration' );
		$order              = $this->get_meta( $post->ID, '_codina_order' );

		if ( empty( $order ) ) {
			$order = 0;
		}
		?>

		<div class="codina-meta-box" dir="rtl">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="codina_description"><?php esc_html_e( 'توضیحات', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_description" 
								name="codina_description" 
								rows="4" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'توضیحات فاز...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $description ); ?></textarea>
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
								placeholder="<?php esc_attr_e( 'مثال: 2 هفته', 'codina-core' ); ?>"
							/>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_order"><?php esc_html_e( 'ترتیب', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="number" 
								id="codina_order" 
								name="codina_order" 
								value="<?php echo esc_attr( $order ); ?>" 
								class="small-text"
								min="0"
							/>
							<p class="description"><?php esc_html_e( 'ترتیب نمایش فاز (اعداد کمتر اول نمایش داده می‌شوند)', 'codina-core' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<?php
	}

	/**
	 * Save the meta box data.
	 *
	 * @param int     $post_id The post ID.
	 * @param WP_Post $post    The post object.
	 */
	public function save_meta_box( $post_id, $post ) {
		if ( $post->post_type !== $this->post_type ) {
			return;
		}

		if ( ! $this->verify_nonce( 'codina_phase_meta_nonce', 'codina_phase_meta' ) ) {
			return;
		}

		if ( $this->is_autosave() ) {
			return;
		}

		if ( ! $this->can_edit( $post_id ) ) {
			return;
		}

		if ( isset( $_POST['codina_description'] ) ) {
			$this->update_meta( $post_id, '_codina_description', $this->sanitize_textarea( $_POST['codina_description'] ) );
		}

		if ( isset( $_POST['codina_estimated_duration'] ) ) {
			$this->update_meta( $post_id, '_codina_estimated_duration', $this->sanitize_text( $_POST['codina_estimated_duration'] ) );
		}

		if ( isset( $_POST['codina_order'] ) ) {
			$this->update_meta( $post_id, '_codina_order', $this->sanitize_int( $_POST['codina_order'] ) );
		}
	}
}

