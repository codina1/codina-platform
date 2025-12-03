<?php
/**
 * Admin functionality.
 *
 * @package    Codina_Core
 * @subpackage Codina_Core/includes/admin
 */
class Codina_Core_Admin {

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook The current admin page.
	 */
	public function enqueue_styles( $hook ) {
		$screen = get_current_screen();
		
		// Only load on our post types.
		$our_post_types = array( 'learning_path', 'learning_phase', 'learning_step', 'learning_resource' );
		
		if ( ! in_array( $screen->post_type, $our_post_types, true ) ) {
			return;
		}

		wp_enqueue_style(
			'codina-core-admin',
			CODINA_CORE_URL . 'admin/css/admin-rtl.css',
			array(),
			CODINA_CORE_VERSION,
			'all'
		);
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param string $hook The current admin page.
	 */
	public function enqueue_scripts( $hook ) {
		$screen = get_current_screen();
		
		// Only load on our post types.
		$our_post_types = array( 'learning_path', 'learning_phase', 'learning_step', 'learning_resource' );
		
		if ( ! in_array( $screen->post_type, $our_post_types, true ) ) {
			return;
		}

		wp_enqueue_script(
			'codina-core-admin',
			CODINA_CORE_URL . 'admin/js/admin.js',
			array( 'jquery' ),
			CODINA_CORE_VERSION,
			true
		);

		// Localize script for AJAX.
		wp_localize_script(
			'codina-core-admin',
			'codinaCore',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'codina_core_nonce' ),
			)
		);
	}

	/**
	 * Add hierarchy management meta box to Learning Path edit page.
	 */
	public function add_hierarchy_meta_box() {
		add_meta_box(
			'codina_hierarchy_manager',
			__( 'مدیریت فازها و مراحل', 'codina-core' ),
			array( $this, 'render_hierarchy_meta_box' ),
			'learning_path',
			'normal',
			'high'
		);
	}

	/**
	 * Render hierarchy management meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_hierarchy_meta_box( $post ) {
		if ( ! $post || ! $post->ID ) {
			return;
		}

		// Get phases for this learning path.
		$phases = get_posts(
			array(
				'post_type'      => 'learning_phase',
				'post_parent'   => $post->ID,
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		?>

		<div class="codina-hierarchy-container" dir="rtl">
				<h2><?php esc_html_e( 'مدیریت فازها و مراحل', 'codina-core' ); ?></h2>
				
				<div class="codina-phases-list">
					<?php if ( empty( $phases ) ) : ?>
						<p class="codina-no-items"><?php esc_html_e( 'هنوز فازی ایجاد نشده است.', 'codina-core' ); ?></p>
					<?php else : ?>
						<?php foreach ( $phases as $phase ) : ?>
							<?php
							$phase_order = get_post_meta( $phase->ID, '_codina_order', true );
							$phase_duration = get_post_meta( $phase->ID, '_codina_estimated_duration', true );
							
							// Get steps for this phase.
							$steps = get_posts(
								array(
									'post_type'      => 'learning_step',
									'post_parent'   => $phase->ID,
									'posts_per_page' => -1,
									'orderby'        => 'menu_order',
									'order'          => 'ASC',
								)
							);
							?>
							<div class="codina-phase-item" data-phase-id="<?php echo esc_attr( $phase->ID ); ?>">
								<div class="codina-phase-header">
									<h3>
										<a href="<?php echo esc_url( get_edit_post_link( $phase->ID ) ); ?>" target="_blank">
											<?php echo esc_html( $phase->post_title ); ?>
										</a>
									</h3>
									<?php if ( $phase_duration ) : ?>
										<span class="codina-duration"><?php echo esc_html( $phase_duration ); ?></span>
									<?php endif; ?>
									<span class="codina-order"><?php echo esc_html( sprintf( __( 'ترتیب: %d', 'codina-core' ), $phase_order ) ); ?></span>
								</div>
								
								<div class="codina-steps-list">
									<?php if ( empty( $steps ) ) : ?>
										<p class="codina-no-items"><?php esc_html_e( 'مرحله‌ای وجود ندارد', 'codina-core' ); ?></p>
									<?php else : ?>
										<?php foreach ( $steps as $step ) : ?>
											<?php
											$step_order = get_post_meta( $step->ID, '_codina_order', true );
											$step_type = get_post_meta( $step->ID, '_codina_type', true );
											$step_type_label = '';
											switch ( $step_type ) {
												case 'theory':
													$step_type_label = __( 'نظری', 'codina-core' );
													break;
												case 'practice':
													$step_type_label = __( 'عملی', 'codina-core' );
													break;
												case 'project':
													$step_type_label = __( 'پروژه', 'codina-core' );
													break;
											}
											
											// Get resources for this step.
											$resources = get_posts(
												array(
													'post_type'      => 'learning_resource',
													'post_parent'   => $step->ID,
													'posts_per_page' => -1,
													'orderby'        => 'menu_order',
													'order'          => 'ASC',
												)
											);
											?>
											<div class="codina-step-item" data-step-id="<?php echo esc_attr( $step->ID ); ?>">
												<div class="codina-step-header">
													<h4>
														<a href="<?php echo esc_url( get_edit_post_link( $step->ID ) ); ?>" target="_blank">
															<?php echo esc_html( $step->post_title ); ?>
														</a>
													</h4>
													<?php if ( $step_type_label ) : ?>
														<span class="codina-type"><?php echo esc_html( $step_type_label ); ?></span>
													<?php endif; ?>
													<span class="codina-order"><?php echo esc_html( sprintf( __( 'ترتیب: %d', 'codina-core' ), $step_order ) ); ?></span>
												</div>
												
												<div class="codina-resources-list">
													<?php if ( empty( $resources ) ) : ?>
														<p class="codina-no-items"><?php esc_html_e( 'منبعی وجود ندارد', 'codina-core' ); ?></p>
													<?php else : ?>
														<ul>
															<?php foreach ( $resources as $resource ) : ?>
																<?php
																$resource_type = get_post_meta( $resource->ID, '_codina_resource_type', true );
																$is_required = get_post_meta( $resource->ID, '_codina_is_required', true );
																?>
																<li>
																	<a href="<?php echo esc_url( get_edit_post_link( $resource->ID ) ); ?>" target="_blank">
																		<?php echo esc_html( $resource->post_title ); ?>
																	</a>
																	<?php if ( $resource_type ) : ?>
																		<span class="codina-resource-type">(<?php echo esc_html( $resource_type ); ?>)</span>
																	<?php endif; ?>
																	<?php if ( $is_required ) : ?>
																		<span class="codina-required"><?php esc_html_e( 'الزامی', 'codina-core' ); ?></span>
																	<?php endif; ?>
																</li>
															<?php endforeach; ?>
														</ul>
													<?php endif; ?>
													<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=learning_resource&post_parent=' . $step->ID ) ); ?>" class="button button-small">
														<?php esc_html_e( '+ افزودن منبع', 'codina-core' ); ?>
													</a>
												</div>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
									<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=learning_step&post_parent=' . $phase->ID ) ); ?>" class="button button-small">
										<?php esc_html_e( '+ افزودن مرحله', 'codina-core' ); ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
					<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=learning_phase&post_parent=' . $post->ID ) ); ?>" class="button">
						<?php esc_html_e( '+ افزودن فاز جدید', 'codina-core' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Add parent selection meta box for Phase, Step, and Resource.
	 */
	public function add_parent_selection_meta_box() {
		$screen = get_current_screen();
		
		if ( 'post' !== $screen->base ) {
			return;
		}

		// Add parent selection for Phase.
		if ( 'learning_phase' === $screen->post_type ) {
			add_meta_box(
				'codina_parent_selection',
				__( 'انتخاب مسیر یادگیری', 'codina-core' ),
				array( $this, 'render_parent_selection_meta_box' ),
				'learning_phase',
				'side',
				'high'
			);
		}

		// Add parent selection for Step.
		if ( 'learning_step' === $screen->post_type ) {
			add_meta_box(
				'codina_parent_selection',
				__( 'انتخاب فاز', 'codina-core' ),
				array( $this, 'render_parent_selection_meta_box' ),
				'learning_step',
				'side',
				'high'
			);
		}

		// Add parent selection for Resource.
		if ( 'learning_resource' === $screen->post_type ) {
			add_meta_box(
				'codina_parent_selection',
				__( 'انتخاب مرحله', 'codina-core' ),
				array( $this, 'render_parent_selection_meta_box' ),
				'learning_resource',
				'side',
				'high'
			);
		}
	}

	/**
	 * Render parent selection meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_parent_selection_meta_box( $post ) {
		$screen = get_current_screen();
		$post_type = $screen->post_type;
		
		wp_nonce_field( 'codina_parent_selection', 'codina_parent_selection_nonce' );

		$current_parent = $post->post_parent;
		$parent_posts = array();

		if ( 'learning_phase' === $post_type ) {
			// Get all learning paths.
			$parent_posts = get_posts(
				array(
					'post_type'      => 'learning_path',
					'posts_per_page' => -1,
					'post_status'    => 'any',
					'orderby'        => 'title',
					'order'          => 'ASC',
				)
			);
			$label = __( 'مسیر یادگیری', 'codina-core' );
		} elseif ( 'learning_step' === $post_type ) {
			// Get all phases.
			$parent_posts = get_posts(
				array(
					'post_type'      => 'learning_phase',
					'posts_per_page' => -1,
					'post_status'    => 'any',
					'orderby'        => 'title',
					'order'          => 'ASC',
				)
			);
			$label = __( 'فاز', 'codina-core' );
		} elseif ( 'learning_resource' === $post_type ) {
			// Get all steps.
			$parent_posts = get_posts(
				array(
					'post_type'      => 'learning_step',
					'posts_per_page' => -1,
					'post_status'    => 'any',
					'orderby'        => 'title',
					'order'          => 'ASC',
				)
			);
			$label = __( 'مرحله', 'codina-core' );
		}
		?>

		<div class="codina-parent-selection" dir="rtl">
			<label for="parent_id">
				<strong><?php echo esc_html( $label ); ?>:</strong>
			</label>
			<select name="parent_id" id="parent_id" class="widefat">
				<option value="0"><?php esc_html_e( '— انتخاب کنید —', 'codina-core' ); ?></option>
				<?php foreach ( $parent_posts as $parent_post ) : ?>
					<option value="<?php echo esc_attr( $parent_post->ID ); ?>" <?php selected( $current_parent, $parent_post->ID ); ?>>
						<?php echo esc_html( $parent_post->post_title ); ?>
					</option>
				<?php endforeach; ?>
			</select>
			<p class="description">
				<?php
				if ( 'learning_phase' === $post_type ) {
					esc_html_e( 'مسیر یادگیری والد را انتخاب کنید', 'codina-core' );
				} elseif ( 'learning_step' === $post_type ) {
					esc_html_e( 'فاز والد را انتخاب کنید', 'codina-core' );
				} elseif ( 'learning_resource' === $post_type ) {
					esc_html_e( 'مرحله والد را انتخاب کنید', 'codina-core' );
				}
				?>
			</p>
		</div>

		<?php
	}

	/**
	 * Save parent selection.
	 *
	 * @param int     $post_id The post ID.
	 * @param WP_Post $post    The post object.
	 */
	public function save_parent_selection( $post_id, $post ) {
		$post_types = array( 'learning_phase', 'learning_step', 'learning_resource' );
		
		if ( ! in_array( $post->post_type, $post_types, true ) ) {
			return;
		}

		if ( ! isset( $_POST['codina_parent_selection_nonce'] ) || 
			 ! wp_verify_nonce( $_POST['codina_parent_selection_nonce'], 'codina_parent_selection' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['parent_id'] ) ) {
			$parent_id = absint( $_POST['parent_id'] );
			wp_update_post(
				array(
					'ID'          => $post_id,
					'post_parent' => $parent_id,
				)
			);
		}
	}
}

