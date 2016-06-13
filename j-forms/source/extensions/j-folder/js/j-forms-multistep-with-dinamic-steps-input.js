$(document).ready(function(){

	// Phone masking
	$("#phone").mask('(999) 999-9999', {placeholder:'x'});

	/************************************************/
	/* Input field logic conditions */
	/************************************************/
	function logicConditionsInput () {

		var $valid_values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];

		$('#j-forms .logic-block-input').change(function () {

			// Age of the user
			$field_value = $('#j-forms .logic-block-input input').val();
			$field_value = +$field_value;

			// If age is from 1 to 16 years
			if ( $.inArray($field_value, $valid_values) != -1 ) {
				$('#j-forms .multi-next-btn').css('display', 'block');
				$('#j-forms .multi-submit-btn').css('display', 'none');
			// If age isn't from 1 to 16 years
			} else {
				$('#j-forms .multi-next-btn').css('display', 'none');
				$('#j-forms .multi-submit-btn').css('display', 'block');
			}
		}).change();
	};
	/************************************************/
	/* end Input field logic conditions */
	/************************************************/

	/***************************************/
	/* Multistep form */
	/***************************************/
	// if multistep form exists
	if ( $('form.j-multistep').length ) {

		// For each multistep form
		// Execute the function
		$('form.j-multistep').each( function() {

			// Variables
			var
				$id 		= $(this).attr('id'),							// form ID
				$i			= $('#' + $id + ' fieldset').length,			// number of fieldsets
				$step		= $('#' + $id + ' .step').length,				// number of steps
				$next_btn	= $('#' + $id + ' .multi-next-btn'),			// 'next' button
				$prev_btn	= $('#' + $id + ' .multi-prev-btn'),			// 'previous' button
				$submit_btn	= $('#' + $id + ' .multi-submit-btn');			// 'submit' button

			// Index of the step with logic conditions
			var $index_logic_block_input = $('#' + $id + ' .logic-block-select').closest('fieldset').index('fieldset');

			// Add class "active-fieldset" to the first fieldset on the page
			$( '#' + $id + ' fieldset').eq(0).addClass('active-fieldset');

			// If class ".step" exists
			// Add class "active-step"
			if ( $step ) {
				$('#' + $id + ' .step').eq(0).addClass('active-step');
			}

			// If first fieldset has class 'active'
			// Processing the buttons
			if ( $('#' + $id + ' fieldset').eq(0).hasClass('active-fieldset') ) {
				$submit_btn.css('display', 'none');
				$prev_btn.css('display', 'none');

				// If first fieldset contains block with logic conditions
				// Execute appropriate function
				logicConditionsInput();
			}

			// If form is submitted not from the last step
			// Clear all fields from the following steps
			$submit_btn.click(function(){

				var
					$count_fieldset 		= $('#' + $id + ' fieldset').length,								// Quantity of the fieldsets
					$index_active_fieldset 	= $('#' + $id).find('fieldset.active-fieldset').index('fieldset');	// Index of the active fieldset

				while ( $count_fieldset > ($index_active_fieldset + 1) ) {

					// Clear textarea, fields, checkboxes and radios from the following steps
					$('#' + $id + ' fieldset').eq($count_fieldset-1).find('select, textarea, input[type="text"], input[type="email"]').val('');
					$('#' + $id + ' fieldset').eq($count_fieldset-1).find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
					$count_fieldset--;
				}

			});

			// Click on the "next" button
			$next_btn.on('click', function() {

				// Switch the "active" class to the next fieldset
				$('#' + $id + ' fieldset.active-fieldset').removeClass('active-fieldset').next('fieldset').addClass('active-fieldset');

				// If ".step" exists
				// Switch the "active" class to the next step
				if ( $step ) {
					$('#' + $id + ' .step.active-step').removeClass('active-step').addClass('passed-step').next('.step').addClass('active-step');
				}

				// Display "prev" button
				$prev_btn.css('display', 'block');

				// If active fieldset is a last
				// processing the buttons
				if ( $('#' + $id + ' fieldset').eq($i-1).hasClass('active-fieldset') ) {
					$submit_btn.css('display', 'block');
					$next_btn.css('display', 'none');
				}

			});

			// Click on the "prev" button
			$prev_btn.on('click', function() {

				// Switch the "active" class to the previous fieldset
				$('#' + $id + ' fieldset.active-fieldset').removeClass('active-fieldset').prev('fieldset').addClass('active-fieldset');

				// If ".step" exists
				// Switch the "active" class to the previous step
				if ( $step ) {
					$('#' + $id + ' .step.active-step').removeClass('active-step').prev('.step').removeClass('passed-step').addClass('active-step');
				}

				// If active fieldset is a first
				// processing the buttons
				if ( $('#' + $id + ' fieldset').eq(0).hasClass('active-fieldset') ) {
					$prev_btn.css('display', 'none');
				}

				// Radio logic conditions
				// If "previous" button is clicked on the step with logic conditions
				// processing the buttons
				if ( $('#' + $id + ' fieldset').eq($index_logic_block_input-1).hasClass('active-fieldset') ) {
					$submit_btn.css('display', 'none');
					$next_btn.css('display', 'block');
				}

				// If active fieldset is a penultimate
				// processing the buttons
				if ( $('#' + $id + ' fieldset').eq($i-2).hasClass('active-fieldset') ) {
					$submit_btn.css('display', 'none');
					$next_btn.css('display', 'block');
				}
			});
		});
		// end "each" statement
	}
	/***************************************/
	/* end multistep form */
	/***************************************/
});
