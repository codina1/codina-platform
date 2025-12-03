<?php
/**
 * Lesson Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Lesson_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type      = 'codina_lesson';
		$this->meta_box_id    = 'codina_lesson_meta';
		$this->meta_box_title = __( 'اطلاعات درس', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_lesson_meta', 'codina_lesson_meta_nonce' );

		$video_url        = $this->get_meta( $post->ID, '_codina_video_url' );
		$duration         = $this->get_meta( $post->ID, '_codina_duration' );
		$lesson_order     = $this->get_meta( $post->ID, '_codina_lesson_order' );
		$attachments      = $this->get_meta( $post->ID, '_codina_attachments', false );
		$free_status      = $this->get_meta( $post->ID, '_codina_free_status' );
		$summary          = $this->get_meta( $post->ID, '_codina_summary' );
		$practice_text    = $this->get_meta( $post->ID, '_codina_practice_text' );
		$resources        = $this->get_meta( $post->ID, '_codina_resources', false );

		// Parse attachments if it's JSON string
		if ( ! is_array( $attachments ) ) {
			$attachments = array();
			$attachments_raw = $this->get_meta( $post->ID, '_codina_attachments' );
			if ( ! empty( $attachments_raw ) ) {
				$decoded = json_decode( $attachments_raw, true );
				if ( is_array( $decoded ) ) {
					$attachments = $decoded;
				} elseif ( is_string( $attachments_raw ) ) {
					// If it's a single URL string, convert to array
					$attachments = array( $attachments_raw );
				}
			}
		}

		// Parse resources if it's JSON string
		if ( ! is_array( $resources ) ) {
			$resources = array();
			$resources_raw = $this->get_meta( $post->ID, '_codina_resources' );
			if ( ! empty( $resources_raw ) ) {
				$decoded = json_decode( $resources_raw, true );
				if ( is_array( $decoded ) ) {
					$resources = $decoded;
				}
			}
		}

		// Get parent course for order context
		$parent_course_id = $post->post_parent;
		?>

		<div class="codina-meta-box" dir="rtl">
			<table class="form-table">
				<tbody>
					<!-- لینک ویدئوی درس -->
					<tr>
						<th scope="row">
							<label for="codina_video_url"><?php esc_html_e( 'لینک ویدئوی درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="url" 
								id="codina_video_url" 
								name="codina_video_url" 
								value="<?php echo esc_url( $video_url ); ?>" 
								class="large-text code"
								placeholder="https://www.youtube.com/watch?v=... یا https://vimeo.com/..."
							/>
							<p class="description"><?php esc_html_e( 'لینک ویدئوی درس (YouTube, Vimeo, یا لینک مستقیم فایل ویدئو)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- مدت زمان درس -->
					<tr>
						<th scope="row">
							<label for="codina_duration"><?php esc_html_e( 'مدت زمان درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="text" 
								id="codina_duration" 
								name="codina_duration" 
								value="<?php echo esc_attr( $duration ); ?>" 
								class="regular-text"
								placeholder="15 دقیقه یا 00:15:30"
							/>
							<p class="description"><?php esc_html_e( 'مدت زمان درس به دقیقه (مثال: 15 دقیقه) یا فرمت زمان (مثال: 00:15:30)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- ترتیب درس -->
					<tr>
						<th scope="row">
							<label for="codina_lesson_order"><?php esc_html_e( 'ترتیب درس در سرفصل', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="number" 
								id="codina_lesson_order" 
								name="codina_lesson_order" 
								value="<?php echo esc_attr( $lesson_order ); ?>" 
								class="small-text"
								min="0"
								step="1"
								placeholder="1"
							/>
							<p class="description">
								<?php esc_html_e( 'ترتیب نمایش درس در سرفصل دوره. عدد کمتر = نمایش زودتر', 'codina-core' ); ?>
								<?php if ( $parent_course_id ) : ?>
									<br>
									<strong><?php esc_html_e( 'دوره والد:', 'codina-core' ); ?></strong> 
									<a href="<?php echo esc_url( get_edit_post_link( $parent_course_id ) ); ?>" target="_blank">
										<?php echo esc_html( get_the_title( $parent_course_id ) ); ?>
									</a>
								<?php endif; ?>
							</p>
						</td>
					</tr>

					<!-- خلاصه کوتاه درس -->
					<tr>
						<th scope="row">
							<label for="codina_summary"><?php esc_html_e( 'خلاصه کوتاه درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_summary" 
								name="codina_summary" 
								rows="3" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'خلاصه کوتاه درس که در بالای صفحه یا لیست سرفصل‌ها نمایش داده می‌شود...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $summary ); ?></textarea>
							<p class="description"><?php esc_html_e( 'خلاصه کوتاه درس (حداکثر 200 کاراکتر توصیه می‌شود)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- وضعیت باز/قفل -->
					<tr>
						<th scope="row">
							<label for="codina_free_status"><?php esc_html_e( 'وضعیت باز/قفل بودن درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_free_status" name="codina_free_status" class="regular-text">
								<option value=""><?php esc_html_e( 'پیش‌فرض (از تنظیمات دوره)', 'codina-core' ); ?></option>
								<option value="free" <?php selected( $free_status, 'free' ); ?>><?php esc_html_e( 'باز (رایگان)', 'codina-core' ); ?></option>
								<option value="locked" <?php selected( $free_status, 'locked' ); ?>><?php esc_html_e( 'قفل (نیاز به خرید)', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'اگر "پیش‌فرض" انتخاب شود، از تنظیمات دوره استفاده می‌شود', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- تمرین یا تکلیف -->
					<tr>
						<th scope="row">
							<label for="codina_practice_text"><?php esc_html_e( 'تمرین یا تکلیف درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<?php
							wp_editor(
								$practice_text,
								'codina_practice_text',
								array(
									'textarea_name' => 'codina_practice_text',
									'textarea_rows' => 8,
									'media_buttons' => true,
									'teeny' => false,
								)
							);
							?>
							<p class="description"><?php esc_html_e( 'تمرین یا تکلیف مرتبط با این درس (اختیاری)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- پیوست‌های درس -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'پیوست‌های درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<div id="codina-attachments-container">
								<?php if ( ! empty( $attachments ) ) : ?>
									<?php foreach ( $attachments as $index => $attachment ) : ?>
										<?php
										$attachment_url = is_array( $attachment ) ? ( isset( $attachment['url'] ) ? $attachment['url'] : '' ) : $attachment;
										$attachment_title = is_array( $attachment ) ? ( isset( $attachment['title'] ) ? $attachment['title'] : '' ) : '';
										?>
										<div class="codina-attachment-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
											<div style="margin-bottom: 8px;">
												<label style="display: block; margin-bottom: 5px;">
													<?php esc_html_e( 'عنوان (اختیاری):', 'codina-core' ); ?>
													<input 
														type="text" 
														name="codina_attachments[<?php echo esc_attr( $index ); ?>][title]" 
														value="<?php echo esc_attr( $attachment_title ); ?>" 
														class="regular-text"
														placeholder="<?php esc_attr_e( 'عنوان فایل', 'codina-core' ); ?>"
													/>
												</label>
											</div>
											<div>
												<label style="display: block; margin-bottom: 5px;">
													<?php esc_html_e( 'لینک فایل:', 'codina-core' ); ?>
													<input 
														type="url" 
														name="codina_attachments[<?php echo esc_attr( $index ); ?>][url]" 
														value="<?php echo esc_url( $attachment_url ); ?>" 
														class="large-text code"
														placeholder="https://..."
													/>
												</label>
											</div>
											<button type="button" class="button codina-remove-attachment" style="margin-top: 5px;"><?php esc_html_e( 'حذف پیوست', 'codina-core' ); ?></button>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<button type="button" id="codina-add-attachment" class="button"><?php esc_html_e( '+ افزودن پیوست', 'codina-core' ); ?></button>
							<p class="description"><?php esc_html_e( 'فایل‌های قابل دانلود مرتبط با این درس', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- منابع اضافی -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'منابع اضافی درس', 'codina-core' ); ?></label>
						</th>
						<td>
							<div id="codina-resources-container">
								<?php if ( ! empty( $resources ) ) : ?>
									<?php foreach ( $resources as $index => $resource ) : ?>
										<?php
										$resource_title = is_array( $resource ) ? ( isset( $resource['title'] ) ? $resource['title'] : '' ) : '';
										$resource_url   = is_array( $resource ) ? ( isset( $resource['url'] ) ? $resource['url'] : '' ) : '';
										?>
										<div class="codina-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
											<div style="margin-bottom: 8px;">
												<label style="display: block; margin-bottom: 5px;">
													<?php esc_html_e( 'عنوان:', 'codina-core' ); ?>
													<input 
														type="text" 
														name="codina_resources[<?php echo esc_attr( $index ); ?>][title]" 
														value="<?php echo esc_attr( $resource_title ); ?>" 
														class="regular-text"
														placeholder="<?php esc_attr_e( 'عنوان منبع', 'codina-core' ); ?>"
													/>
												</label>
											</div>
											<div>
												<label style="display: block; margin-bottom: 5px;">
													<?php esc_html_e( 'لینک:', 'codina-core' ); ?>
													<input 
														type="url" 
														name="codina_resources[<?php echo esc_attr( $index ); ?>][url]" 
														value="<?php echo esc_url( $resource_url ); ?>" 
														class="large-text code"
														placeholder="https://..."
													/>
												</label>
											</div>
											<button type="button" class="button codina-remove-resource" style="margin-top: 5px;"><?php esc_html_e( 'حذف منبع', 'codina-core' ); ?></button>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<button type="button" id="codina-add-resource" class="button"><?php esc_html_e( '+ افزودن منبع', 'codina-core' ); ?></button>
							<p class="description"><?php esc_html_e( 'لینک مقالات، ویدئوهای دیگر و منابع مرتبط با این درس', 'codina-core' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var attachmentIndex = <?php echo ! empty( $attachments ) ? count( $attachments ) : 0; ?>;
			var resourceIndex = <?php echo ! empty( $resources ) ? count( $resources ) : 0; ?>;

			// Attachments
			$('#codina-add-attachment').on('click', function() {
				var item = $('<div class="codina-attachment-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">' +
					'<div style="margin-bottom: 8px;">' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'عنوان (اختیاری):', 'codina-core' ) ); ?>' +
					'<input type="text" name="codina_attachments[' + attachmentIndex + '][title]" class="regular-text" placeholder="<?php echo esc_js( __( 'عنوان فایل', 'codina-core' ) ); ?>" />' +
					'</label></div>' +
					'<div>' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'لینک فایل:', 'codina-core' ) ); ?>' +
					'<input type="url" name="codina_attachments[' + attachmentIndex + '][url]" class="large-text code" placeholder="https://..." />' +
					'</label></div>' +
					'<button type="button" class="button codina-remove-attachment" style="margin-top: 5px;"><?php echo esc_js( __( 'حذف پیوست', 'codina-core' ) ); ?></button>' +
					'</div>');
				$('#codina-attachments-container').append(item);
				attachmentIndex++;
			});

			$(document).on('click', '.codina-remove-attachment', function() {
				$(this).closest('.codina-attachment-item').remove();
			});

			// Resources
			$('#codina-add-resource').on('click', function() {
				var item = $('<div class="codina-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">' +
					'<div style="margin-bottom: 8px;">' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'عنوان:', 'codina-core' ) ); ?>' +
					'<input type="text" name="codina_resources[' + resourceIndex + '][title]" class="regular-text" placeholder="<?php echo esc_js( __( 'عنوان منبع', 'codina-core' ) ); ?>" />' +
					'</label></div>' +
					'<div>' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'لینک:', 'codina-core' ) ); ?>' +
					'<input type="url" name="codina_resources[' + resourceIndex + '][url]" class="large-text code" placeholder="https://..." />' +
					'</label></div>' +
					'<button type="button" class="button codina-remove-resource" style="margin-top: 5px;"><?php echo esc_js( __( 'حذف منبع', 'codina-core' ) ); ?></button>' +
					'</div>');
				$('#codina-resources-container').append(item);
				resourceIndex++;
			});

			$(document).on('click', '.codina-remove-resource', function() {
				$(this).closest('.codina-resource-item').remove();
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
		if ( ! $this->verify_nonce( 'codina_lesson_meta_nonce', 'codina_lesson_meta' ) ) {
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

		// Save video URL.
		if ( isset( $_POST['codina_video_url'] ) ) {
			$this->update_meta( $post_id, '_codina_video_url', $this->sanitize_url( $_POST['codina_video_url'] ) );
		}

		// Save duration.
		if ( isset( $_POST['codina_duration'] ) ) {
			$this->update_meta( $post_id, '_codina_duration', $this->sanitize_text( $_POST['codina_duration'] ) );
		}

		// Save lesson order.
		if ( isset( $_POST['codina_lesson_order'] ) ) {
			$order = absint( $_POST['codina_lesson_order'] );
			$this->update_meta( $post_id, '_codina_lesson_order', $order );
			
			// Also update menu_order for WordPress native ordering
			wp_update_post( array(
				'ID' => $post_id,
				'menu_order' => $order,
			) );
		}

		// Save free status.
		if ( isset( $_POST['codina_free_status'] ) ) {
			$free_status = $this->sanitize_text( $_POST['codina_free_status'] );
			if ( in_array( $free_status, array( 'free', 'locked', '' ), true ) ) {
				$this->update_meta( $post_id, '_codina_free_status', $free_status );
			}
		}

		// Save summary.
		if ( isset( $_POST['codina_summary'] ) ) {
			$this->update_meta( $post_id, '_codina_summary', $this->sanitize_textarea( $_POST['codina_summary'] ) );
		}

		// Save practice text.
		if ( isset( $_POST['codina_practice_text'] ) ) {
			$this->update_meta( $post_id, '_codina_practice_text', wp_kses_post( $_POST['codina_practice_text'] ) );
		}

		// Save attachments.
		if ( isset( $_POST['codina_attachments'] ) && is_array( $_POST['codina_attachments'] ) ) {
			$attachments = array();
			foreach ( $_POST['codina_attachments'] as $attachment ) {
				$title = isset( $attachment['title'] ) ? $this->sanitize_text( $attachment['title'] ) : '';
				$url   = isset( $attachment['url'] ) ? esc_url_raw( $attachment['url'] ) : '';
				
				if ( ! empty( $url ) ) {
					$attachments[] = array(
						'title' => $title,
						'url'   => $url,
					);
				}
			}
			
			// Delete old attachments.
			$this->delete_meta( $post_id, '_codina_attachments' );
			
			// Save new attachments as JSON.
			if ( ! empty( $attachments ) ) {
				$this->update_meta( $post_id, '_codina_attachments', wp_json_encode( $attachments ) );
			}
		} else {
			$this->delete_meta( $post_id, '_codina_attachments' );
		}

		// Save resources.
		if ( isset( $_POST['codina_resources'] ) && is_array( $_POST['codina_resources'] ) ) {
			$resources = array();
			foreach ( $_POST['codina_resources'] as $resource ) {
				$title = isset( $resource['title'] ) ? $this->sanitize_text( $resource['title'] ) : '';
				$url   = isset( $resource['url'] ) ? esc_url_raw( $resource['url'] ) : '';
				
				if ( ! empty( $title ) && ! empty( $url ) ) {
					$resources[] = array(
						'title' => $title,
						'url'   => $url,
					);
				}
			}
			
			// Delete old resources.
			$this->delete_meta( $post_id, '_codina_resources' );
			
			// Save new resources as JSON.
			if ( ! empty( $resources ) ) {
				$this->update_meta( $post_id, '_codina_resources', wp_json_encode( $resources ) );
			}
		} else {
			$this->delete_meta( $post_id, '_codina_resources' );
		}
	}
}

