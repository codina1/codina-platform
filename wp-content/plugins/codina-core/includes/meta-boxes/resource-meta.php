<?php
/**
 * Resource Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Resource_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type    = 'learning_resource';
		$this->meta_box_id  = 'codina_resource_meta';
		$this->meta_box_title = __( 'اطلاعات منبع', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_resource_meta', 'codina_resource_meta_nonce' );

		$short_description  = $this->get_meta( $post->ID, '_codina_short_description' );
		$resource_type      = $this->get_meta( $post->ID, '_codina_resource_type' );
		$url                = $this->get_meta( $post->ID, '_codina_url' );
		$search_keywords    = $this->get_meta( $post->ID, '_codina_search_keywords' );
		$estimated_time     = $this->get_meta( $post->ID, '_codina_estimated_time' );
		$is_required        = $this->get_meta( $post->ID, '_codina_is_required' );
		$note_for_student   = $this->get_meta( $post->ID, '_codina_note_for_student' );
		$linked_course_id   = $this->get_meta( $post->ID, '_codina_linked_course_id' );

		// Get courses for dropdown.
		$courses = get_posts(
			array(
				'post_type'      => 'codina_course',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
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
								placeholder="<?php esc_attr_e( 'توضیحات کوتاه منبع...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $short_description ); ?></textarea>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_resource_type"><?php esc_html_e( 'نوع منبع', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_resource_type" name="codina_resource_type" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
								<option value="internal_course" <?php selected( $resource_type, 'internal_course' ); ?>><?php esc_html_e( 'دوره داخلی', 'codina-core' ); ?></option>
								<option value="external_link" <?php selected( $resource_type, 'external_link' ); ?>><?php esc_html_e( 'لینک خارجی', 'codina-core' ); ?></option>
								<option value="keyword_search" <?php selected( $resource_type, 'keyword_search' ); ?>><?php esc_html_e( 'جستجوی کلیدی', 'codina-core' ); ?></option>
								<option value="book" <?php selected( $resource_type, 'book' ); ?>><?php esc_html_e( 'کتاب', 'codina-core' ); ?></option>
								<option value="article" <?php selected( $resource_type, 'article' ); ?>><?php esc_html_e( 'مقاله', 'codina-core' ); ?></option>
								<option value="project" <?php selected( $resource_type, 'project' ); ?>><?php esc_html_e( 'پروژه', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'نوع منبع یادگیری', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr id="codina-url-row" style="<?php echo ( 'external_link' !== $resource_type ) ? 'display:none;' : ''; ?>">
						<th scope="row">
							<label for="codina_url"><?php esc_html_e( 'آدرس URL', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="url" 
								id="codina_url" 
								name="codina_url" 
								value="<?php echo esc_url( $url ); ?>" 
								class="large-text code"
								placeholder="https://..."
							/>
							<p class="description"><?php esc_html_e( 'آدرس منبع خارجی', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr id="codina-course-row" style="<?php echo ( 'internal_course' !== $resource_type ) ? 'display:none;' : ''; ?>">
						<th scope="row">
							<label for="codina_linked_course_id"><?php esc_html_e( 'دوره مرتبط', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_linked_course_id" name="codina_linked_course_id" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب دوره...', 'codina-core' ); ?></option>
								<?php foreach ( $courses as $course ) : ?>
									<option value="<?php echo esc_attr( $course->ID ); ?>" <?php selected( $linked_course_id, $course->ID ); ?>>
										<?php echo esc_html( $course->post_title ); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<p class="description"><?php esc_html_e( 'دوره داخلی مرتبط با این منبع', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr id="codina-keywords-row" style="<?php echo ( 'keyword_search' !== $resource_type ) ? 'display:none;' : ''; ?>">
						<th scope="row">
							<label for="codina_search_keywords"><?php esc_html_e( 'کلمات کلیدی جستجو', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="text" 
								id="codina_search_keywords" 
								name="codina_search_keywords" 
								value="<?php echo esc_attr( $search_keywords ); ?>" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'کلمات کلیدی برای جستجو...', 'codina-core' ); ?>"
							/>
							<p class="description"><?php esc_html_e( 'کلمات کلیدی برای جستجوی منابع', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_estimated_time"><?php esc_html_e( 'زمان تخمینی', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="text" 
								id="codina_estimated_time" 
								name="codina_estimated_time" 
								value="<?php echo esc_attr( $estimated_time ); ?>" 
								class="regular-text"
								placeholder="<?php esc_attr_e( 'مثال: 30 دقیقه', 'codina-core' ); ?>"
							/>
							<p class="description"><?php esc_html_e( 'زمان تخمینی برای مطالعه/انجام این منبع', 'codina-core' ); ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_is_required"><?php esc_html_e( 'الزامی', 'codina-core' ); ?></label>
						</th>
						<td>
							<label>
								<input 
									type="checkbox" 
									id="codina_is_required" 
									name="codina_is_required" 
									value="1" 
									<?php checked( $is_required, '1' ); ?>
								/>
								<?php esc_html_e( 'این منبع الزامی است', 'codina-core' ); ?>
							</label>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="codina_note_for_student"><?php esc_html_e( 'یادداشت برای دانشجو', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_note_for_student" 
								name="codina_note_for_student" 
								rows="3" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'یادداشت یا راهنمایی برای دانشجو...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $note_for_student ); ?></textarea>
							<p class="description"><?php esc_html_e( 'یادداشت یا راهنمایی که به دانشجو نمایش داده می‌شود', 'codina-core' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
			function toggleResourceFields() {
				var resourceType = $('#codina_resource_type').val();
				$('#codina-url-row').toggle(resourceType === 'external_link');
				$('#codina-course-row').toggle(resourceType === 'internal_course');
				$('#codina-keywords-row').toggle(resourceType === 'keyword_search');
			}

			$('#codina_resource_type').on('change', toggleResourceFields);
			toggleResourceFields();
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
		if ( $post->post_type !== $this->post_type ) {
			return;
		}

		if ( ! $this->verify_nonce( 'codina_resource_meta_nonce', 'codina_resource_meta' ) ) {
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

		if ( isset( $_POST['codina_resource_type'] ) ) {
			$resource_type = $this->sanitize_text( $_POST['codina_resource_type'] );
			$allowed_types = array( 'internal_course', 'external_link', 'keyword_search', 'book', 'article', 'project' );
			if ( in_array( $resource_type, $allowed_types, true ) ) {
				$this->update_meta( $post_id, '_codina_resource_type', $resource_type );
			}
		}

		if ( isset( $_POST['codina_url'] ) ) {
			$this->update_meta( $post_id, '_codina_url', $this->sanitize_url( $_POST['codina_url'] ) );
		}

		if ( isset( $_POST['codina_search_keywords'] ) ) {
			$this->update_meta( $post_id, '_codina_search_keywords', $this->sanitize_text( $_POST['codina_search_keywords'] ) );
		}

		if ( isset( $_POST['codina_estimated_time'] ) ) {
			$this->update_meta( $post_id, '_codina_estimated_time', $this->sanitize_text( $_POST['codina_estimated_time'] ) );
		}

		$is_required = isset( $_POST['codina_is_required'] ) ? '1' : '0';
		$this->update_meta( $post_id, '_codina_is_required', $is_required );

		if ( isset( $_POST['codina_note_for_student'] ) ) {
			$this->update_meta( $post_id, '_codina_note_for_student', $this->sanitize_textarea( $_POST['codina_note_for_student'] ) );
		}

		if ( isset( $_POST['codina_linked_course_id'] ) ) {
			$this->update_meta( $post_id, '_codina_linked_course_id', $this->sanitize_int( $_POST['codina_linked_course_id'] ) );
		}
	}
}

