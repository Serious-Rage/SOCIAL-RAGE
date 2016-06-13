$(document).ready(function(){

	// Phone masking
	$("#phone").mask('(999) 999-9999', {placeholder:'x'});

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
			way_to_communicate: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			email_message: {
				required: true
			},
			time: {
				required: true
			},
			phone: {
				required: true
			},
			phone_message: {
				required: true
			}
		},
		messages: {
			name: {
				required: 'Please enter your name'
			},
			way_to_communicate: {
				required: 'Please select way to communicate'
			},
			email: {
				required: 'Please enter your email',
				email: 'Incorrect email format'
			},
			email_message: {
				required: 'Please enter your message'
			},
			phone: {
				required: 'Please enter your phone'
			},
			time: {
				required: 'Please select time for call'
			},
			phone_message: {
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

							// Show 'next' button
							$('#j-forms .multi-next-btn').css('display', 'block');
						}, 5000);
					}
				}
			});
		}
	});
	/***************************************/
	/* end form validation */
	/***************************************/

	/***************************************/
	/* Logic conditions for multistep form */
	/***************************************/
	$('#way_to_communicate').change(function () {

		if ( $('#email_to_communicate').is(':checked') ) {
			if ( $('#email-step').hasClass('hidden') ) {
				$('#email-step').removeClass('hidden');
			}
			if ( !$('#phone-step').hasClass('hidden') ) {
				$('#phone-step').addClass('hidden');
			}
		}

		if ( $('#phone_to_communicate').is(':checked') ) {
			if ( $('#phone-step').hasClass('hidden') ) {
				$('#phone-step').removeClass('hidden');
			}
			if ( !$('#email-step').hasClass('hidden') ) {
				$('#email-step').addClass('hidden');
			}
		}

	}).change();

	/***************************************/
	/* end logic conditions for multistep form */
	/***************************************/

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
			}

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