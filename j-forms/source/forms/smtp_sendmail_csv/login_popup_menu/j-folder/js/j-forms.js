$(document).ready(function(){

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

						setTimeout(function(){
							// Delete success message after 5 seconds
							$('#j-forms #response').removeClass('success-message').html('');

							// Make submit button available
							$('#j-forms button[type="submit"]').attr('disabled', false);
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
	/* Popup menu forms */
	/***************************************/
	// If user clicks on the 'subscribe' item
	// Open popup-menu subscribe form
	$('#log-popup-menu').on('click', function() {
		if ( $('#log-popup-menu .popup-list-wrapper').css('display') == 'none' ) {
			$('#log-popup-menu .popup-list-wrapper').css({ display:'block', left:'auto', right:'0', opacity:'1' });
		}
	});

	// Add an event listener
	// If user clicks outside a form
	// The form will disappear
	$(document).on('click touchstart', function(event) {
		// Close popup-menu 'subscribe' form
		if (!$(event.target).closest('#log-popup-menu').length) {
			if ( $('#log-popup-menu .popup-list-wrapper').css('display') == 'block' ) {
				$('#log-popup-menu .popup-list-wrapper').css({ display:'none', left:'-9999px', opacity:'0' });
			}
		}
	});
	/***************************************/
	/* end popup menu forms */
	/***************************************/
});