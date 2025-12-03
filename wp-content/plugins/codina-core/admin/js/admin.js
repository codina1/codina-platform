/**
 * Codina Core Admin JavaScript
 *
 * @package Codina_Core
 */

(function($) {
	'use strict';

	$(document).ready(function() {

		// Resource type field toggle
		$('#codina_resource_type').on('change', function() {
			var resourceType = $(this).val();
			
			// Hide all conditional fields
			$('#codina-url-row, #codina-course-row, #codina-keywords-row').hide();
			
			// Show relevant field based on type
			if (resourceType === 'external_link') {
				$('#codina-url-row').show();
			} else if (resourceType === 'internal_course') {
				$('#codina-course-row').show();
			} else if (resourceType === 'keyword_search') {
				$('#codina-keywords-row').show();
			}
		});

		// Initialize resource type fields on page load
		if ($('#codina_resource_type').length) {
			$('#codina_resource_type').trigger('change');
		}

		// Outcomes management
		$('#codina-add-outcome').on('click', function(e) {
			e.preventDefault();
			
			var newItem = $('<div class="codina-outcome-item" style="margin-bottom: 10px;">' +
				'<input type="text" name="codina_outcomes[]" class="regular-text" placeholder="مهارت یا نتیجه یادگیری" />' +
				'<button type="button" class="button codina-remove-outcome">حذف</button>' +
				'</div>');
			
			$('#codina-outcomes-container').append(newItem);
		});

		$(document).on('click', '.codina-remove-outcome', function(e) {
			e.preventDefault();
			$(this).closest('.codina-outcome-item').remove();
		});

		// RTL form adjustments
		$('.codina-meta-box .form-table th').css('text-align', 'right');
		$('.codina-meta-box .form-table td').css('text-align', 'right');
		
	});

})(jQuery);

