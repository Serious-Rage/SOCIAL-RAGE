$(document).ready(function(){

	/***************************************/
	/* Modal form */
	/***************************************/
	// Demo modal forms
	$('.modal-open').on('click', function() {

		// Set background
		if( !$('.modal-fill').length ) {
			$('body').append('<div class="modal-fill"></div>');
		}

		// Show modal form and background
		$modalForm = $($(this).attr('href'));
		$('.modal-fill').fadeIn();
		$modalForm.css('display', 'block').css('top', '50%').css('margin-top', -$modalForm.outerHeight()/2).fadeIn();

		return false;
	});

	// Close button
	$('.modal-close').on('click', function() {
		$('.modal-form').fadeOut();
		$('.modal-fill').fadeOut();
		return false;
	});
	/***************************************/
	/* end modal form */
	/***************************************/

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
	/* Form validation */
	/***************************************/
	$( '#j-forms-rec' ).validate({

		/* @validation states + elements */
		errorClass: 'error-view',
		validClass: 'success-view',
		errorElement: 'span',
		onkeyup: false,
		onclick: false,

		/* @validation rules */
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			email: {
				required: 'Please enter your email',
				email: 'Incorrect email format'
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
			$( '#j-forms-rec' ).ajaxSubmit({

				// Server response placement
				target:'#j-forms-rec .response',

				// If error occurs
				error:function(xhr) {
					$('#j-forms-rec .response').html('An error occured: ' + xhr.status + ' - ' + xhr.statusText);
				},

				// Before submiting the form
				beforeSubmit:function(){
					// Add class 'processing' to the submit button
					$('#j-forms-rec button[type="submit"]').attr('disabled', true).addClass('processing');
				},

				// If success occurs
				success:function(){
					// Remove class 'processing'
					$('#j-forms-rec button[type="submit"]').attr('disabled', false).removeClass('processing');

					// If response for the server is a 'success-message'
					if ( $('#j-forms-rec .success-message').length ) {

						// Remove classes 'error-view' and 'success-view'
						$('#j-forms-rec .input').removeClass('success-view error-view');
						$('#j-forms-rec .check').removeClass('success-view error-view');

						// Reset form
						$('#j-forms-rec').resetForm();

						// Prevent submitting the form while success message is shown
						$('#j-forms-rec button[type="submit"]').attr('disabled', true);

						setTimeout(function(){
							// Delete success message after 5 seconds
							$('#j-forms-rec .response').removeClass('success-message').html('');

							// Make submit button available
							$('#j-forms-rec button[type="submit"]').attr('disabled', false);

							// Close modal form
							$('.modal-form').fadeOut();

							// Hide background
							$('.modal-fill').fadeOut();
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
