<?php
/**
 * Course Meta Box.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/meta-boxes
 */
class Codina_Course_Meta extends Codina_Meta_Box_Handler {

	/**
	 * Initialize meta box properties.
	 */
	protected function init() {
		$this->post_type      = 'codina_course';
		$this->meta_box_id    = 'codina_course_meta';
		$this->meta_box_title = __( 'اطلاعات دوره', 'codina-core' );
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'codina_course_meta', 'codina_course_meta_nonce' );

		$short_description     = $this->get_meta( $post->ID, '_codina_short_description' );
		$full_description      = $this->get_meta( $post->ID, '_codina_full_description' );
		$level                 = $this->get_meta( $post->ID, '_codina_level' );
		$duration              = $this->get_meta( $post->ID, '_codina_duration' );
		$prerequisites         = $this->get_meta( $post->ID, '_codina_prerequisites' );
		$benefits              = $this->get_meta( $post->ID, '_codina_benefits' );
		$course_type           = $this->get_meta( $post->ID, '_codina_course_type' );
		$last_updated          = $this->get_meta( $post->ID, '_codina_last_updated' );
		$skills                = $this->get_meta( $post->ID, '_codina_skills' );
		$wc_product_id         = $this->get_meta( $post->ID, '_codina_woocommerce_product_id' );
		$lesson_lock_status    = $this->get_meta( $post->ID, '_codina_lesson_lock_status' );
		$additional_resources   = $this->get_meta( $post->ID, '_codina_additional_resources', false );

		if ( ! is_array( $additional_resources ) ) {
			$additional_resources = array();
		}

		// Get WooCommerce products for select dropdown
		$products = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$products_query = get_posts(
				array(
					'post_type'      => 'product',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'orderby'        => 'title',
					'order'          => 'ASC',
				)
			);
			foreach ( $products_query as $product ) {
				$products[ $product->ID ] = $product->post_title;
			}
		}
		?>

		<div class="codina-meta-box" dir="rtl">
			<table class="form-table">
				<tbody>
					<!-- خلاصه کوتاه دوره -->
					<tr>
						<th scope="row">
							<label for="codina_short_description"><?php esc_html_e( 'خلاصه کوتاه دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_short_description" 
								name="codina_short_description" 
								rows="3" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'خلاصه کوتاه دوره که در کارت‌ها و صفحات لیست نمایش داده می‌شود...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $short_description ); ?></textarea>
							<p class="description"><?php esc_html_e( 'خلاصه کوتاه دوره (حداکثر 150 کاراکتر توصیه می‌شود)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- توضیحات کامل -->
					<tr>
						<th scope="row">
							<label for="codina_full_description"><?php esc_html_e( 'توضیحات کامل دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<?php
							wp_editor(
								$full_description,
								'codina_full_description',
								array(
									'textarea_name' => 'codina_full_description',
									'textarea_rows' => 10,
									'media_buttons' => true,
									'teeny' => false,
								)
							);
							?>
							<p class="description"><?php esc_html_e( 'توضیحات کامل دوره برای بهینه‌سازی SEO. می‌توانید از ویرایشگر وردپرس استفاده کنید.', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- سطح دوره -->
					<tr>
						<th scope="row">
							<label for="codina_level"><?php esc_html_e( 'سطح دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_level" name="codina_level" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
								<option value="beginner" <?php selected( $level, 'beginner' ); ?>><?php esc_html_e( 'مبتدی', 'codina-core' ); ?></option>
								<option value="junior" <?php selected( $level, 'junior' ); ?>><?php esc_html_e( 'جونیور', 'codina-core' ); ?></option>
								<option value="intermediate" <?php selected( $level, 'intermediate' ); ?>><?php esc_html_e( 'متوسط', 'codina-core' ); ?></option>
								<option value="senior" <?php selected( $level, 'senior' ); ?>><?php esc_html_e( 'سنیور', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'سطح دوره آموزشی', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- مدت زمان دوره -->
					<tr>
						<th scope="row">
							<label for="codina_duration"><?php esc_html_e( 'مدت زمان دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="number" 
								id="codina_duration" 
								name="codina_duration" 
								value="<?php echo esc_attr( $duration ); ?>" 
								class="small-text"
								min="0"
								step="0.5"
								placeholder="10"
							/>
							<span><?php esc_html_e( 'ساعت', 'codina-core' ); ?></span>
							<p class="description"><?php esc_html_e( 'مدت زمان کل دوره به ساعت (مثال: 10، 15.5)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- پیش‌نیازها -->
					<tr>
						<th scope="row">
							<label for="codina_prerequisites"><?php esc_html_e( 'پیش‌نیازها', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_prerequisites" 
								name="codina_prerequisites" 
								rows="5" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'پیش‌نیازهای دوره را اینجا بنویسید...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $prerequisites ); ?></textarea>
							<p class="description"><?php esc_html_e( 'پیش‌نیازها و دانش مورد نیاز برای شرکت در این دوره', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- مزایا / خروجی‌ها -->
					<tr>
						<th scope="row">
							<label for="codina_benefits"><?php esc_html_e( 'مزایا / خروجی‌های دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<textarea 
								id="codina_benefits" 
								name="codina_benefits" 
								rows="5" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'مزایا و خروجی‌هایی که دانشجو پس از تکمیل دوره به دست می‌آورد...', 'codina-core' ); ?>"
							><?php echo esc_textarea( $benefits ); ?></textarea>
							<p class="description"><?php esc_html_e( 'مزایا و خروجی‌های دوره (هر مورد در یک خط)', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- نوع دوره -->
					<tr>
						<th scope="row">
							<label for="codina_course_type"><?php esc_html_e( 'نوع دوره', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_course_type" name="codina_course_type" class="regular-text">
								<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
								<option value="video" <?php selected( $course_type, 'video' ); ?>><?php esc_html_e( 'ویدئویی', 'codina-core' ); ?></option>
								<option value="text" <?php selected( $course_type, 'text' ); ?>><?php esc_html_e( 'متنی', 'codina-core' ); ?></option>
								<option value="mixed" <?php selected( $course_type, 'mixed' ); ?>><?php esc_html_e( 'ترکیبی', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'نوع محتوای دوره', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- آخرین بروزرسانی -->
					<tr>
						<th scope="row">
							<label for="codina_last_updated"><?php esc_html_e( 'آخرین بروزرسانی', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="date" 
								id="codina_last_updated" 
								name="codina_last_updated" 
								value="<?php echo esc_attr( $last_updated ); ?>" 
								class="regular-text"
							/>
							<p class="description"><?php esc_html_e( 'تاریخ آخرین بروزرسانی محتوای دوره', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- تگ مهارت‌ها -->
					<tr>
						<th scope="row">
							<label for="codina_skills"><?php esc_html_e( 'تگ مهارت‌ها', 'codina-core' ); ?></label>
						</th>
						<td>
							<input 
								type="text" 
								id="codina_skills" 
								name="codina_skills" 
								value="<?php echo esc_attr( $skills ); ?>" 
								class="large-text"
								placeholder="<?php esc_attr_e( 'مثال: JavaScript, React, Node.js', 'codina-core' ); ?>"
							/>
							<p class="description"><?php esc_html_e( 'مهارت‌های مرتبط با دوره را با کاما جدا کنید', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- اتصال به محصول WooCommerce -->
					<tr>
						<th scope="row">
							<label for="codina_woocommerce_product_id"><?php esc_html_e( 'محصول WooCommerce', 'codina-core' ); ?></label>
						</th>
						<td>
							<?php if ( class_exists( 'WooCommerce' ) && ! empty( $products ) ) : ?>
								<select id="codina_woocommerce_product_id" name="codina_woocommerce_product_id" class="regular-text">
									<option value=""><?php esc_html_e( 'انتخاب کنید...', 'codina-core' ); ?></option>
									<?php foreach ( $products as $product_id => $product_title ) : ?>
										<option value="<?php echo esc_attr( $product_id ); ?>" <?php selected( $wc_product_id, $product_id ); ?>>
											<?php echo esc_html( $product_title ); ?> (ID: <?php echo esc_html( $product_id ); ?>)
										</option>
									<?php endforeach; ?>
								</select>
							<?php else : ?>
								<p class="description" style="color: #d63638;">
									<?php esc_html_e( 'WooCommerce نصب نشده است یا محصولی وجود ندارد.', 'codina-core' ); ?>
								</p>
							<?php endif; ?>
							<p class="description"><?php esc_html_e( 'محصول WooCommerce مرتبط با این دوره', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- وضعیت قفل/باز بودن جلسات -->
					<tr>
						<th scope="row">
							<label for="codina_lesson_lock_status"><?php esc_html_e( 'وضعیت قفل جلسات', 'codina-core' ); ?></label>
						</th>
						<td>
							<select id="codina_lesson_lock_status" name="codina_lesson_lock_status" class="regular-text">
								<option value="unlocked" <?php selected( $lesson_lock_status, 'unlocked' ); ?>><?php esc_html_e( 'باز (همه جلسات قابل مشاهده)', 'codina-core' ); ?></option>
								<option value="locked" <?php selected( $lesson_lock_status, 'locked' ); ?>><?php esc_html_e( 'قفل (نیاز به خرید)', 'codina-core' ); ?></option>
								<option value="sequential" <?php selected( $lesson_lock_status, 'sequential' ); ?>><?php esc_html_e( 'ترتیبی (جلسات به ترتیب باز می‌شوند)', 'codina-core' ); ?></option>
							</select>
							<p class="description"><?php esc_html_e( 'نحوه دسترسی به جلسات دوره', 'codina-core' ); ?></p>
						</td>
					</tr>

					<!-- لینک‌ها یا منابع اضافی -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'لینک‌ها و منابع اضافی', 'codina-core' ); ?></label>
						</th>
						<td>
							<div id="codina-resources-container">
								<?php if ( ! empty( $additional_resources ) ) : ?>
									<?php foreach ( $additional_resources as $index => $resource ) : ?>
										<?php
										$resource_title = isset( $resource['title'] ) ? $resource['title'] : '';
										$resource_url   = isset( $resource['url'] ) ? $resource['url'] : '';
										?>
										<div class="codina-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
											<div style="margin-bottom: 8px;">
												<label style="display: block; margin-bottom: 5px;">
													<?php esc_html_e( 'عنوان:', 'codina-core' ); ?>
													<input 
														type="text" 
														name="codina_additional_resources[<?php echo esc_attr( $index ); ?>][title]" 
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
														name="codina_additional_resources[<?php echo esc_attr( $index ); ?>][url]" 
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
							<p class="description"><?php esc_html_e( 'لینک‌ها و منابع اضافی مرتبط با دوره', 'codina-core' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var resourceIndex = <?php echo ! empty( $additional_resources ) ? count( $additional_resources ) : 0; ?>;

			$('#codina-add-resource').on('click', function() {
				var item = $('<div class="codina-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">' +
					'<div style="margin-bottom: 8px;">' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'عنوان:', 'codina-core' ) ); ?>' +
					'<input type="text" name="codina_additional_resources[' + resourceIndex + '][title]" class="regular-text" placeholder="<?php echo esc_js( __( 'عنوان منبع', 'codina-core' ) ); ?>" />' +
					'</label></div>' +
					'<div>' +
					'<label style="display: block; margin-bottom: 5px;"><?php echo esc_js( __( 'لینک:', 'codina-core' ) ); ?>' +
					'<input type="url" name="codina_additional_resources[' + resourceIndex + '][url]" class="large-text code" placeholder="https://..." />' +
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
		if ( ! $this->verify_nonce( 'codina_course_meta_nonce', 'codina_course_meta' ) ) {
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

		// Save short description.
		if ( isset( $_POST['codina_short_description'] ) ) {
			$this->update_meta( $post_id, '_codina_short_description', $this->sanitize_textarea( $_POST['codina_short_description'] ) );
		}

		// Save full description.
		if ( isset( $_POST['codina_full_description'] ) ) {
			$this->update_meta( $post_id, '_codina_full_description', wp_kses_post( $_POST['codina_full_description'] ) );
		}

		// Save level.
		if ( isset( $_POST['codina_level'] ) ) {
			$level = $this->sanitize_text( $_POST['codina_level'] );
			if ( in_array( $level, array( 'beginner', 'junior', 'intermediate', 'senior' ), true ) ) {
				$this->update_meta( $post_id, '_codina_level', $level );
			}
		}

		// Save duration.
		if ( isset( $_POST['codina_duration'] ) ) {
			$duration = floatval( $_POST['codina_duration'] );
			if ( $duration >= 0 ) {
				$this->update_meta( $post_id, '_codina_duration', $duration );
			}
		}

		// Save prerequisites.
		if ( isset( $_POST['codina_prerequisites'] ) ) {
			$this->update_meta( $post_id, '_codina_prerequisites', $this->sanitize_textarea( $_POST['codina_prerequisites'] ) );
		}

		// Save benefits.
		if ( isset( $_POST['codina_benefits'] ) ) {
			$this->update_meta( $post_id, '_codina_benefits', $this->sanitize_textarea( $_POST['codina_benefits'] ) );
		}

		// Save course type.
		if ( isset( $_POST['codina_course_type'] ) ) {
			$course_type = $this->sanitize_text( $_POST['codina_course_type'] );
			if ( in_array( $course_type, array( 'video', 'text', 'mixed' ), true ) ) {
				$this->update_meta( $post_id, '_codina_course_type', $course_type );
			}
		}

		// Save last updated.
		if ( isset( $_POST['codina_last_updated'] ) ) {
			$this->update_meta( $post_id, '_codina_last_updated', sanitize_text_field( $_POST['codina_last_updated'] ) );
		}

		// Save skills.
		if ( isset( $_POST['codina_skills'] ) ) {
			$this->update_meta( $post_id, '_codina_skills', $this->sanitize_text( $_POST['codina_skills'] ) );
		}

		// Save WooCommerce product ID.
		if ( isset( $_POST['codina_woocommerce_product_id'] ) ) {
			$wc_product_id = absint( $_POST['codina_woocommerce_product_id'] );
			if ( $wc_product_id > 0 ) {
				$this->update_meta( $post_id, '_codina_woocommerce_product_id', $wc_product_id );
			} else {
				$this->delete_meta( $post_id, '_codina_woocommerce_product_id' );
			}
		}

		// Save lesson lock status.
		if ( isset( $_POST['codina_lesson_lock_status'] ) ) {
			$lock_status = $this->sanitize_text( $_POST['codina_lesson_lock_status'] );
			if ( in_array( $lock_status, array( 'unlocked', 'locked', 'sequential' ), true ) ) {
				$this->update_meta( $post_id, '_codina_lesson_lock_status', $lock_status );
			}
		}

		// Save additional resources.
		if ( isset( $_POST['codina_additional_resources'] ) && is_array( $_POST['codina_additional_resources'] ) ) {
			$resources = array();
			foreach ( $_POST['codina_additional_resources'] as $resource ) {
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
			$this->delete_meta( $post_id, '_codina_additional_resources' );
			
			// Save new resources.
			foreach ( $resources as $resource ) {
				add_post_meta( $post_id, '_codina_additional_resources', $resource );
			}
		} else {
			$this->delete_meta( $post_id, '_codina_additional_resources' );
		}
	}
}

