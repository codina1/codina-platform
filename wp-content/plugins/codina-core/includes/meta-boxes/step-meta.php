<?php
/**
 * Step Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Step_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type    = 'learning_step';
		$this->meta_box_id  = 'codina_step_meta';
		$this->meta_box_title = __( 'اطلاعات مرحله', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_step_meta', 'codina_step_meta_nonce' );

		$short_description = $this->get_meta( $post->ID, '_codina_short_description' );
		$type              = $this->get_meta( $post->ID, '_codina_type' );
		$order             = $this->get_meta( $post->ID, '_codina_order' );

		if ( empty( $order ) ) {
			$order = 0;
		}
		?>

		<div class="codina-meta-box" dir="rtl">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="codina_short_description"><?php esc_html_e( 'توضیحات کوتاه', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_short_description" 
								name="codina_short_description" 
								rows="3" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'توضیحات کوتاه مرحله...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $short_description ); ?></textarea>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_type"><?php esc_html_e( 'نوع مرحله', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_type" name="codina_type" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
								<option value="theory" <?php selected( $type, 'theory' ); ?>><?php esc_html_e( 'نظری', 'codina-core' ); ?></option>
								<option value="practice" <?php selected( $type, 'practice' ); ?>><?php esc_html_e( 'عملی', 'codina-core' ); ?></option>
								<option value="project" <?php selected( $type, 'project' ); ?>><?php esc_html_e( 'پروژه', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'نوع مرحله یادگیری', 'codina-core' ); ?></p>
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
							<p class="description"><?php esc_html_e( 'ترتیب نمایش مرحله', 'codina-core' ); ?></p>
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

		if ( ! $this->verify_nonce( 'codina_step_meta_nonce', 'codina_step_meta' ) ) {
			return;
		}

		if ( $this->is_autosave() ) {
			return;
		}

		if ( ! $this->can_edit( $post_id ) ) {
			return;
		}

		if ( isset( $_POST['codina_short_description'] ) ) {
			$this->update_meta( $post_id, '_codina_short_description', $this->sanitize_textarea( $_POST['codina_short_description'] ) );
		}

		if ( isset( $_POST['codina_type'] ) ) {
			$type = $this->sanitize_text( $_POST['codina_type'] );
			if ( in_array( $type, array( 'theory', 'practice', 'project' ), true ) ) {
				$this->update_meta( $post_id, '_codina_type', $type );
			}
		}

		if ( isset( $_POST['codina_order'] ) ) {
			$this->update_meta( $post_id, '_codina_order', $this->sanitize_int( $_POST['codina_order'] ) );
		}
	}
}

