$(document).ready(function(){

	// Phone masking
	$('#phone').mask('(999) 999-9999', {placeholder:'x'});

	/***************************************/
	/* Room calculations */
	/***************************************/
	// Parse a date
	var parseDate = function(str) {
		var date = str.split('/');

		// You can select a type of the date
		// Just comment/uncomment a line with code
		// Do not forget to set appropriate date format in the "DatePicker" functions
		// Date format: mm/dd/yy
		var formattedDate = new Date(date[2], date[0]-1, date[1]);

		// Date format: dd/mm/yy
		// var formattedDate = new Date(date[2], date[1]-1, date[0]);

		return formattedDate;
	};

	// Get day difference 
	var getDayDiff = function(firstDate, secondDate) {
		return Math.floor((secondDate - firstDate)/(1000*60*60*24));
	};

	// Find the room price based on the quantity of days and room price
	var getRoomPrice = function() {

		// Find quantity of days
		var $quantityOfDays = getDayDiff(parseDate($('#date_from').val()), parseDate($('#date_to').val()));

		var $roomPrice = 0,
			$totalRoomPrice = 0;

		// Find price for the room
		$roomPrice = $('#j-forms .calculate_room option:selected').attr('data-price');
		$roomPrice = Math.round(parseFloat($roomPrice)*100)/100;

		// Find total room price
		$totalRoomPrice = Math.round(($quantityOfDays * $roomPrice)*100)/100;

		return !isNaN($totalRoomPrice) ? $totalRoomPrice : 0;
	};

	// Find the price based on the optional services
	var getExtrasPrice = function() {

		// Find quantity of days
		var $quantityOfDays = getDayDiff(parseDate($('#date_from').val()), parseDate($('#date_to').val()));

		var $extrasObj = $('#j-forms .calculate_extras input[type="checkbox"]'),
			$extrasPrice = 0;

		// Find extras price for one day
		$extrasObj.each(function() {
			if (this.checked) {
				$.each( this.attributes, function() {
					if (this.name === 'data-price') {
						$extrasPrice += parseFloat(this.value);
					}
				});
			}
		});

		// Find total extras price
		$extrasPrice = Math.round(($quantityOfDays * $extrasPrice)*100)/100;

		return !isNaN($extrasPrice) ? $extrasPrice : 0;
	};

	// Find the total price
	var calculateTotalPrice = function() {
		return getRoomPrice() + getExtrasPrice();
	};

	// If any field will be changed - new price will be found
	$('.calculate_date, .calculate_room, .calculate_extras').change(function() {

		$('#total-price').removeClass('hidden');
		// Insert values to the spans
		$('#span_total_room').html(' $' + getRoomPrice());
		$('#span_total_extras').html(' $' + getExtrasPrice());
		$('#span_totals').html(' $' + calculateTotalPrice());
		// Insert values to the hidden inputs
		$('#input_total_room').val(getRoomPrice());
		$('#input_total_extras').val(getExtrasPrice());
		$('#input_totals').val(calculateTotalPrice());

	});
	/***************************************/
	/* end Room calculations */
	/***************************************/

	/***************************************/
	/* Datepicker */
	/***************************************/
	// Start date
	function dateFrom(date_from, date_to) {
		$( date_from ).datepicker({
			// Set date format according to the calculation functions
			// "mm/dd/yyyy" or "dd/mm/yy"
			dateFormat: 'mm/dd/yy',
			prevText: '<i class="fa fa-caret-left"></i>',
			nextText: '<i class="fa fa-caret-right"></i>',
			onClose: function( selectedDate ) {
				$( date_to ).datepicker( 'option', 'minDate', selectedDate );

				// validate this field after focus is lost
				$( this ).valid();
			}
		});
	}

	// Finish date
	function dateTo(date_from, date_to) {
		$( date_to ).datepicker({
			// Set date format according to the calculation functions
			// "mm/dd/yyyy" or "dd/mm/yy"
			dateFormat: 'mm/dd/yy',
			prevText: '<i class="fa fa-caret-left"></i>',
			nextText: '<i class="fa fa-caret-right"></i>',
			onClose: function( selectedDate ) {
				$( date_from ).datepicker( 'option', 'maxDate', selectedDate );

				// validate this field after focus is lost
				$( this ).valid();
			}
		});
	}

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
		ignore: "",

		/* @validation rules */
		rules: {
			date_from: {
				required: true
			},
			date_to: {
				required: true
			},
			room_type: {
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
			date_from: {
				required: 'Please select check-in date'
			},
			date_to: {
				required: 'Please select check-out date'
			},
			room_type: {
				required: 'Please select a room type'
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

						// Destroy old date range
						destroyDate('#date_from');
						destroyDate('#date_to');

						// Initialize new date range
						dateFrom('#date_from', '#date_to');
						dateTo('#date_from', '#date_to');

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