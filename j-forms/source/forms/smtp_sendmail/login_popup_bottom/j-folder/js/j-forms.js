$(document).ready(function(){

	/***************************************/
	/* Form validation */
	/***************************************/
	$( '#j-forms-log' ).validate({

		/* @validation states + elements */
		errorClass: 'error-view',
		validClass: 'success-view',
		errorElement: 'span',
		onkeyup: false,
		onclick: false,

		/* @validation rules */
		rules: {
			login: {
				required: true
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			login: {
				required: 'Please enter your login'
			},
			password: {
				required: 'Please enter your password',
				minlength: 'At least 6 characters'
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
			$( '#j-forms-log' ).ajaxSubmit({

				// Server response placement
				target:'#j-forms-log .response',

				// If error occurs
				error:function(xhr) {
					$('#j-forms-log .response').html('An error occured: ' + xhr.status + ' - ' + xhr.statusText);
				},

				// Before submiting the form
				beforeSubmit:function(){
					// Add class 'processing' to the submit button
					$('#j-forms-log button[type="submit"]').attr('disabled', true).addClass('processing');
				},

				// If success occurs
				success:function(){
					// Remove class 'processing'
					$('#j-forms-log button[type="submit"]').attr('disabled', false).removeClass('processing');

					// If response for the server is a 'success-message'
					if ( $('#j-forms-log .success-message').length ) {

						// Remove classes 'error-view' and 'success-view'
						$('#j-forms-log .input').removeClass('success-view error-view');
						$('#j-forms-log .check').removeClass('success-view error-view');

						// Reset form
						$('#j-forms-log').resetForm();

						// Prevent submitting the form while success message is shown
						$('#j-forms-log button[type="submit"]').attr('disabled', true);

						setTimeout(function(){
							// Delete success message after 5 seconds
							$('#j-forms-log .response').removeClass('success-message').html('');

							// Make submit button available
							$('#j-forms-log button[type="submit"]').attr('disabled', false);

							// Close a form
							$('#popup-input-open').attr('checked', false);
							$('#popup-input-close').attr('checked', true);
						}, 3000);
					}
				}
			});
		}
	});
	/***************************************/
	/* end form validation */
	/***************************************/
});
