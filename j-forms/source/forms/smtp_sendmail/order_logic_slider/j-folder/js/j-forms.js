$(document).ready(function(){

	// Phone masking
	$('#phone').mask('(999) 999-9999', {placeholder:'x'});

	/***************************************/
	/* Slider */
	/***************************************/
	// Bedroms
	$(function() {
		$( '#slider_bedrooms' ).slider({
			range: "min",
			min: 1,
			max: 10,
			slide: function( event, ui ) {
				// Add value to the "label" tag
				$( '#bedrooms' ).html( ui.value );
				// Add value to the hidden input
				$( '#bedrooms_input' ).val( ui.value );
			}
		});
		$( '#bedrooms' ).html( $( '#slider_bedrooms' ).slider( 'value' ) );
	});

	// Bathrooms
	$(function() {
		$( '#slider_bathrooms' ).slider({
			range: "min",
			min: 1,
			max: 10,
			slide: function( event, ui ) {
				// Add value to the "label" tag
				$( '#bathrooms' ).html( ui.value );
				// Add value to the hidden input
				$( '#bathrooms_input' ).val( ui.value );
			}
		});
		$( '#bathrooms' ).html( $( '#slider_bathrooms' ).slider( 'value' ) );
	});

	// Square Feets
	$(function() {
		$( '#slider_feets' ).slider( {
			range: "min",
			min: 500,
			max: 3000,
			value: 1000,
			step: 100,
			slide: function( event, ui ){
				// Add value to the "label" tag
				$( '#feets' ).html(ui.value);
				// Add value to the hidden input
				$( '#feets_input' ).val( ui.value );
				// Cal to the calculation function
				calculateTotalPrice();
			}
		});
		$( '#feets' ).html( $( '#slider_feets' ).slider( 'value' ) );
	});

	// Price per Square Feet
	$(function() {
		$( '#slider_feets_price' ).slider({
			range: "min",
			min: 30,
			max: 150,
			value: 60,
			step: 5,
			slide: function( event, ui ) {
				// Add value to the "label" tag
				$( '#feets_price' ).html( '$ ' + ui.value );
				// Add value to the hidden input
				$( '#feets_price_input' ).val( ui.value );
				// Cal to the calculation function
				calculateTotalPrice();
			}
		});
		$( '#feets_price' ).html( '$ ' + $( '#slider_feets_price' ).slider( 'value' ) );
	});
	/***************************************/
	/* end Slider */
	/***************************************/

	/***************************************/
	/* Apartment calculations */
	/***************************************/
	// Find the total price
	var calculateTotalPrice = function() {

		// Define values
		var $squareFeets = $('#feets').html() ? $('#feets').html() : 0,
			$feetPriceString = $('#feets_price').html() ? $('#feets_price').html() : '$ 0',
			$totalFeetsPrice = 0;

		$feetPriceArray = $feetPriceString.split(' ');

		// Calculate total price
		$totalFeetsPrice = Math.round($squareFeets * $feetPriceArray[1])/100;

		$('#total-price').removeClass('hidden');
		// Insert values to the spans
		$('#span_total_feets').html($squareFeets);
		$('#span_total_feets_price').html(' $' + $feetPriceArray[1]);
		$('#span_totals').html(' $' + $totalFeetsPrice);
		// Insert values to the hidden inputs
		$('#input_total_feets').val($squareFeets);
		$('#input_total_feets_price').val($feetPriceArray[1]);
		$('#input_totals').val($totalFeetsPrice);

	};

	/***************************************/
	/* end Apartment calculations */
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
		ignore: "",

		/* @validation rules */
		rules: {
			apartment_type: {
				required: true
			},
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true
			}
		},
		messages: {
			apartment_type: {
				required: 'Please select an apartment type'
			},
			name: {
				required: 'Please enter your name'
			},
			email: {
				required: 'Please enter your email',
				email: 'Incorrect email format'
			},
			phone: {
				required: 'Please enter your phone'
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

						// Clear spans with prices
						$('#span_total_room').html('');
						$('#span_total_extras').html('');
						$('#span_totals').html('');

						// Clear hidden inputs with prices
						$('#input_total_room').val('');
						$('#input_total_extras').val('');
						$('#input_totals').val('');

						// Reset form
						$('#j-forms').resetForm();

						// Hide total price div
						$('#total-price').addClass('hidden');

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
