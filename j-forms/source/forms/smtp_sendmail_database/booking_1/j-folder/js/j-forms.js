$(document).ready(function(){

	// Phone masking
	$('#phone').mask('(999) 999-9999', {placeholder:'x'});

	/***************************************/
	/* Datepicker */
	/***************************************/
	// Start date
	function dateFrom(date_from, date_to) {
		$( date_from ).datepicker({
			dateFormat: 'mm/dd/yy',
			prevText: '<i class="fa fa-caret-left"></i>',
			nextText: '<i class="fa fa-caret-right"></i>',
			onClose: function( selectedDate ) {
				$( date_to ).datepicker( 'option', 'minDate', selectedDate );

				// validate this field after focus is lost
				$( this ).valid();
			}
		});
	};

	// Finish date
	function dateTo(date_from, date_to) {
		$( date_to ).datepicker({
			dateFormat: 'mm/dd/yy',
			prevText: '<i class="fa fa-caret-left"></i>',
			nextText: '<i class="fa fa-caret-right"></i>',
			onClose: function( selectedDate ) {
				$( date_from ).datepicker( 'option', 'maxDate', selectedDate );

				// validate this field after focus is lost
				$( this ).valid();
			}
		});
	};

	// Destroy date
	function destroyDate (date) {
		$( date ).datepicker('destroy');
	}

	// Initialize date range
	dateFrom('#date_from', '#date_to');
	dateTo('#date_from', '#date_to');
	/***************************************/
	/* end datepicker */
	/***************************************/

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
			adults: {
				required: true,
				digits: true,
				range: [0,30]
			},
			children: {
				required: true,
				digits: true,
				range: [0,30]
			},
			date_from: {
				required: true
			},
			date_to: {
				required: true
			},
			message: {
				required: true,
				minlength: 20
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
			adults: {
				required: 'Please field is required'
			},
			children: {
				required: 'Please field is required'
			},
			date_from: {
				required: 'Please select check-in date'
			},
			date_to: {
				required: 'Please select check-out date'
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

						// Destroy old date range
						destroyDate('#date_from');
						destroyDate('#date_to');

						// Initialize new date range
						dateFrom('#date_from', '#date_to');
						dateTo('#date_from', '#date_to');

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