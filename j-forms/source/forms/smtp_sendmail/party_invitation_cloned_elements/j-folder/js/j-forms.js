$(document).ready(function(){

	/***************************************/
	/* Cloned elements */
	/***************************************/
	// Create cloned elements
	$('.friends').cloneya();

	// Remove  cloned elements
	function removeClonedElements() {
		$( "div.toclone" ).each(function( index ) {
			if ( index > 0 ) {
				$(this).remove();
			}
		});
	}
	/***************************************/
	/* end Cloned elements */
	/***************************************/

	/************************************************/
	/* Select field logic conditions */
	/************************************************/
	$('#j-forms .add-friends').change(function () {

		// Selected value
		$select_value = $('#j-forms .add-friends select option:selected').val();

		if ($select_value === 'me and friends') {
			if ( $('#friends').hasClass('hidden') ) {
				$('#friends').removeClass('hidden');
			}
		// If selected value isn't "Yes"
		} else {
			if ( !$('#friends').hasClass('hidden') ) {
				$('#friends').addClass('hidden');
			}
		}
	}).change();
	/************************************************/
	/* end Select field logic conditions */
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
			you_make_it: {
				required: true
			},
			guest_quantity: {
				required: true
			},
			message: {
				required: true
			}
		},
		messages: {
			you_make_it: {
				required: 'Please select a button'
			},
			guest_quantity: {
				required: 'Please select guests quantity'
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

						// Remove cloned elements
						removeClonedElements();

						// Hide div with cloned elements
						if ( !$('#friends').hasClass('hidden') ) {
							$('#friends').addClass('hidden');
						}

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

});
