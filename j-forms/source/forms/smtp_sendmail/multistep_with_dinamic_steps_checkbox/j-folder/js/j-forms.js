$(document).ready(function(){

	// Phone masking
	$("#phone").mask('(999) 999-9999', {placeholder:'x'});

	/************************************************/
	/* Datepicker */
	/************************************************/
	$('#pickup_date').datetimepicker({
		dateFormat: 'mm/dd/yy',
		timeFormat: 'hh:mm',
		prevText: '<i class="fa fa-caret-left"></i>',
		nextText: '<i class="fa fa-caret-right"></i>'
	});

	$('#return_date').datetimepicker({
		dateFormat: 'mm/dd/yy',
		timeFormat: 'hh:mm',
		prevText: '<i class="fa fa-caret-left"></i>',
		nextText: '<i class="fa fa-caret-right"></i>'
	});
	/************************************************/
	/* end Datepicker */
	/************************************************/

	/***************************************/
	/* Form validation */
	/***************************************/
	$( '#j-forms' ).validate({

		/* @validation states + elements */
		errorClass: 'error-view',
		validClass: 'success-view',
		errorElement: 'span',
		onkeyup: false,
		onclick: false,

		/* @validation rules */
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true
			},
			pickup_date: {
				required: true
			},
			return_date: {
				required: true
			},
			airport: {
				required: true
			},
			airline_flight_number: {
				required: true
			},
			number_of_luggage: {
				required: true
			},
			pickup_address: {
				required: true
			},
			drop_off: {
				required: true
			},
			message: {
				required: true
			}
		},
		messages: {
			name: {
				required: 'Please enter your name'
			},
			email: {
				required: 'Please enter your email',
				email: 'Incorrect email format'
			},
			phone: {
				required: 'Please enter your phone'
			},
			pickup_date: {
				required: 'Please enter pickup date'
			},
			return_date: {
				required: 'Please enter return date'
			},
			airport: {
				required: 'Please enter an airport name'
			},
			airline_flight_number: {
				required: 'Please enter a flight number'
			},
			number_of_luggage: {
				required: 'Please enter a number of luggage'
			},
			pickup_address: {
				required: 'Please enter pickup address'
			},
			drop_off: {
				required: 'Please field is required'
			},
			message: {
				required: 'Please enter your message'
			}
		},
		// Add class 'error-view'
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.input').removeClass(validClass).addClass(errorClass);
			if ( $(element).is(':checkbox') || $(element).is(':radio') ) {
				$(element).closest('.check').removeClass(validClass).addClass(errorClass);
			}
		},
		// Add class 'success-view'
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.input').removeClass(errorClass).addClass(validClass);
			if ( $(element).is(':checkbox') || $(element).is(':radio') ) {
				$(element).closest('.check').removeClass(errorClass).addClass(validClass);
			}
		},
		// Error placement
		errorPlacement: function(error, element) {
			if ( $(element).is(':checkbox') || $(element).is(':radio') ) {
				$(element).closest('.check').append(error);
			} else {
				$(element).closest('.unit').append(error);
			}
		},
		// Submit the form
		submitHandler:function() {
			$( '#j-forms' ).ajaxSubmit({

				// Server response placement
				target:'#j-forms #response',

				// If error occurs
				error:function(xhr) {
					$('#j-forms #response').html('An error occured: ' + xhr.status + ' - ' + xhr.statusText);
				},

				// Before submiting the form
				beforeSubmit:function(){
					// Add class 'processing' to the submit button
					$('#j-forms button[type="submit"]').attr('disabled', true).addClass('processing');
				},

				// If success occurs
				success:function(){
					// Remove class 'processing'
					$('#j-forms button[type="submit"]').attr('disabled', false).removeClass('processing');

					// If response for the server is a 'success-message'
					if ( $('#j-forms .success-message').length ) {

						// Remove classes 'error-view' and 'success-view'
						$('#j-forms .input').removeClass('success-view error-view');
						$('#j-forms .check').removeClass('success-view error-view');

						// Reset form
						$('#j-forms').resetForm();

						// Prevent submitting the form while success message is shown
						$('#j-forms button[type="submit"]').attr('disabled', true);

						// Prevent clicking on the 'prev' button
						$('#j-forms .multi-prev-btn').attr('disabled', true);

						setTimeout(function(){
							// Delete success message after 5 seconds
							$('#j-forms #response').removeClass('success-message').html('');

							// Make submit button available
							$('#j-forms button[type="submit"]').attr('disabled', false);

							// Make 'prev' button available
							$('#j-forms .multi-prev-btn').attr('disabled', false);

							// Hide submit button and 'prev' button
							$('#j-forms .multi-prev-btn').css('display', 'none');
							$('#j-forms .multi-submit-btn').css('display', 'none');

							// Make first fieldset from multistep form active
							$('#j-forms fieldset').removeClass('active-fieldset');
							$('#j-forms fieldset').eq(0).addClass('active-fieldset');

							// Execute logic function
							logicConditionsCheckbox();
						}, 5000);
					}
				}
			});
		}
	});
	/***************************************/
	/* end form validation */
	/***************************************/

	/************************************************/
	/* Checkbox logic conditions */
	/************************************************/
	function logicConditionsCheckbox () {

		$('#j-forms .logic-block-checkbox').change(function () {

			if ($('#next-step-checkbox').is(':checked')) {
				$('.multi-next-btn').css('display', 'block');
				$('.multi-submit-btn').css('display', 'none');
			} else {
				$('.multi-next-btn').css('display', 'none');
				$('.multi-submit-btn').css('display', 'block');
			}
		}).change();
	};
	/************************************************/
	/* end Checkbox logic conditions */
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
			var $index_logic_block_checkbox = $('#' + $id + ' .logic-block-checkbox').closest('fieldset').index('fieldset');

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
				logicConditionsCheckbox();
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

				// If current fieldset doesn't have validation errors
				// Switch to the next step
				if ($('#' + $id).valid() == true) {

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

				// If current fieldset has validation errors
				} else {
					return false;
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
				if ( $('#' + $id + ' fieldset').eq($index_logic_block_checkbox-1).hasClass('active-fieldset') ) {
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
