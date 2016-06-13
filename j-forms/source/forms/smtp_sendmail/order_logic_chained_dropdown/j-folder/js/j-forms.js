$(document).ready(function(){

	// Phone masking
	$('#phone').mask('(999) 999-9999', {placeholder:'x'});

	/***************************************/
	/* Chained dropdowns */
	/***************************************/
	// Arrays
	$models = [];
	$actions = [];

	// start select № 2
	// Notebook models
	$models['Acer']  = ['Acer Aspire', 'Acer eMachines', 'Acer Extensa', 'Acer TravelMate'];
	$models['Apple'] = ['Apple MacBook', 'Apple MacBook Air', 'Apple MacBook Pro'];
	$models['Asus']  = ['Asus A model', 'Asus B model', 'Asus F model', 'Asus G model'];
	$models['Lenovo']  = ['Lenovo 3000', 'Lenovo IdeaPad', 'Lenovo ThinkPad'];
	$models['Samsung']  = ['Samsung 270E5E', 'Samsung 350E5C', 'Samsung NC110'];
	// end select № 2

	// start select № 3
	// Model actions for 'Acer'
	$actions['Acer Aspire'] = [
				{"action":"Keyboard replacement","price":"20"}, {"action":"Matrix replacement","price":"70"},
				{"action":"Battery replacement","price":"28"}, {"action":"Cooler replacement","price":"55"},
				{"action":"Notebook configuration","price":"30"}, {"action":"Removal of viruses","price":"30"}];
	$actions['Acer eMachines'] = [
				{"action":"Keyboard replacement","price":"21"}, {"action":"Matrix replacement","price":"70"},
				{"action":"Battery replacement","price":"29"}, {"action":"Cooler replacement","price":"60"},
				{"action":"Notebook configuration","price":"35"}, {"action":"Removal of viruses","price":"30"}];
	$actions['Acer Extensa'] = [
				{"action":"Keyboard replacement","price":"25"}, {"action":"Matrix replacement","price":"70"},
				{"action":"Battery replacement","price":"28"}, {"action":"Cooler replacement","price":"50"},
				{"action":"Notebook configuration","price":"40"}, {"action":"Removal of viruses","price":"33"}];
	$actions['Acer TravelMate'] = [
				{"action":"Keyboard replacement","price":"33"}, {"action":"Matrix replacement","price":"80"},
				{"action":"Battery replacement","price":"20"}, {"action":"Cooler replacement","price":"50"},
				{"action":"Notebook configuration","price":"30"}, {"action":"Removal of viruses","price":"40"}];

	// Model actions for 'Apple'
	$actions['Apple MacBook'] = [
				{"action":"Keyboard replacement","price":"25"}, {"action":"Matrix replacement","price":"90"},
				{"action":"Battery replacement","price":"35"}, {"action":"Cooler replacement","price":"60"},
				{"action":"Notebook configuration","price":"35"}, {"action":"Removal of viruses","price":"30"}];
	$actions['Apple MacBook Air'] = [
				{"action":"Keyboard replacement","price":"23"}, {"action":"Matrix replacement","price":"78"},
				{"action":"Battery replacement","price":"30"}, {"action":"Cooler replacement","price":"45"},
				{"action":"Notebook configuration","price":"30"}, {"action":"Removal of viruses","price":"35"}];
	$actions['Apple MacBook Pro'] = [
				{"action":"Keyboard replacement","price":"26"}, {"action":"Matrix replacement","price":"80"},
				{"action":"Battery replacement","price":"35"}, {"action":"Cooler replacement","price":"50"},
				{"action":"Notebook configuration","price":"33"}, {"action":"Removal of viruses","price":"30"}];

	// Model actions for 'Asus'
	$actions['Asus A model'] = [
				{"action":"Keyboard replacement","price":"33"}, {"action":"Matrix replacement","price":"70"},
				{"action":"Battery replacement","price":"20"}, {"action":"Cooler replacement","price":"55"},
				{"action":"Notebook configuration","price":"37"}, {"action":"Removal of viruses","price":"30"}];
	$actions['Asus B model'] = [
				{"action":"Keyboard replacement","price":"30"}, {"action":"Matrix replacement","price":"60"},
				{"action":"Battery replacement","price":"22"}, {"action":"Cooler replacement","price":"52"},
				{"action":"Notebook configuration","price":"36"}, {"action":"Removal of viruses","price":"40"}];
	$actions['Asus F model'] = [
				{"action":"Keyboard replacement","price":"40"}, {"action":"Matrix replacement","price":"67"},
				{"action":"Battery replacement","price":"20"}, {"action":"Cooler replacement","price":"58"},
				{"action":"Notebook configuration","price":"20"}, {"action":"Removal of viruses","price":"37"}];
	$actions['Asus G model'] = [
				{"action":"Keyboard replacement","price":"31"}, {"action":"Matrix replacement","price":"80"},
				{"action":"Battery replacement","price":"30"}, {"action":"Cooler replacement","price":"65"},
				{"action":"Notebook configuration","price":"32"}, {"action":"Removal of viruses","price":"36"}];

	// Model actions for 'Lenovo'
	$actions['Lenovo 3000'] = [
				{"action":"Keyboard replacement","price":"29"}, {"action":"Matrix replacement","price":"50"},
				{"action":"Battery replacement","price":"17"}, {"action":"Cooler replacement","price":"40"},
				{"action":"Notebook configuration","price":"43"}, {"action":"Removal of viruses","price":"36"}];
	$actions['Lenovo IdeaPad'] = [
				{"action":"Keyboard replacement","price":"22"}, {"action":"Matrix replacement","price":"70"},
				{"action":"Battery replacement","price":"23"}, {"action":"Cooler replacement","price":"55"},
				{"action":"Notebook configuration","price":"30"}, {"action":"Removal of viruses","price":"30"}];
	$actions['Lenovo ThinkPad'] = [
				{"action":"Keyboard replacement","price":"32"}, {"action":"Matrix replacement","price":"74"},
				{"action":"Battery replacement","price":"33"}, {"action":"Cooler replacement","price":"59"},
				{"action":"Notebook configuration","price":"33"}, {"action":"Removal of viruses","price":"33"}];

	// Model actions for 'Samsung'
	$actions['Samsung 270E5E'] = [
				{"action":"Keyboard replacement","price":"50"}, {"action":"Matrix replacement","price":"80"},
				{"action":"Battery replacement","price":"32"}, {"action":"Cooler replacement","price":"60"},
				{"action":"Notebook configuration","price":"35"}, {"action":"Removal of viruses","price":"40"}];
	$actions['Samsung 350E5C'] = [
				{"action":"Keyboard replacement","price":"26"}, {"action":"Matrix replacement","price":"75"},
				{"action":"Battery replacement","price":"235"}, {"action":"Cooler replacement","price":"52"},
				{"action":"Notebook configuration","price":"37"}, {"action":"Removal of viruses","price":"34"}];
	$actions['Samsung NC110'] = [
				{"action":"Keyboard replacement","price":"25"}, {"action":"Matrix replacement","price":"76"},
				{"action":"Battery replacement","price":"25"}, {"action":"Cooler replacement","price":"56"},
				{"action":"Notebook configuration","price":"30"}, {"action":"Removal of viruses","price":"33"}];

	// If first select is changed
	$( "#notebook" ).change(function () {

		// If next selects have values
		// Clear next selects
		if ( $("#notebook_model option").length) {
			$("#notebook_model option:gt(0)").remove();
			$('#total_service_price span').html(' $' + calculateServicePrice());
		}
		if ( $("#notebook_model_action option").length) {
			$("#notebook_model_action option").remove();
			$("#notebook_model_action").append('<option value="">select an action...</option>');
			$('#total_service_price span').html(' $' + calculateServicePrice());
		}

		// Get the "notebook" value from the current select
		$( "#notebook option:selected" ).each(function() {
			$notebook_val = $( this ).val();
		});

		// Get the "notebook models" values
		$notebook = $models[$notebook_val];

		// if "notebook models" exists
		// Add values to the next select
		if ( $notebook ) {
			for ($i = 0; $i < $notebook.length; $i++) {
				$opt = '<option value="' + $notebook[$i] + '">' + $notebook[$i] + '</option>';
				$('#notebook_model').append($opt);
			}
		}
	});

	// If second select is changed
	$( "#notebook_model" ).change(function () {

		// If next select has value
		// Clear next select
		if ( $("#notebook_model_action option").length) {
			$("#notebook_model_action option").remove();
			$("#notebook_model_action").append('<option value="">select an action...</option>');
			$('#total_service_price span').html(' $' + calculateServicePrice());
		}

		// Get the "notebook model" value from the current select
		$( "#notebook_model option:selected" ).each(function() {
			$notebook_model_val = $( this ).val();
		});

		// Get the "notebook models actions" values
		$action = $actions[$notebook_model_val];

		// if "notebook models actions" exists
		// Add values to the next select
		if ( $action ) {
			$("#notebook_model_action option").remove();
			for ($i = 0; $i < $action.length; $i++) {
				$opt = '<option value="' + $action[$i].action + ' - $' + $action[$i].price + '" data-price="' + $action[$i].price + '">' +
											$action[$i].action + ' - $' + parseFloat($action[$i].price).toFixed(2) + '</option>';
				$("#notebook_model_action").append($opt);
			}
		}
	});
	/***************************************/
	/* end Chained dropdowns */
	/***************************************/

	/***************************************/
	/* Service price */
	/***************************************/
	// Find the price based on notebook services
	var getServicePrice = function() {

		var $servicePriceObj = $('#j-forms #notebook_model_action option:selected'),
			$servicePrice = 0;

		$servicePriceObj.each(function() {
			$.each(this.attributes, function() {
				if (this.name === 'data-price') {
					$servicePrice += parseFloat(this.value);
				}
			});
		});
		$servicePrice = Math.round(($servicePrice)*100)/100;
		return $servicePrice;
	};

	// Find the price based on the additional things
	var getAdditionalServicePrice = function() {

		var $additionalServiceObj = $('#j-forms .additional-service input[type="checkbox"]'),
			$additionalServicePrice = 0;

		$additionalServiceObj.each(function() {
			if (this.checked) {
				$.each( this.attributes, function() {
					if (this.name === 'data-price') {
						$additionalServicePrice += parseFloat(this.value);
					}
				});
			}
		});
		$additionalServicePrice = Math.round(($additionalServicePrice)*100)/100;
		return $additionalServicePrice;
	};

	// Find the total price
	function calculateServicePrice() {
		var $totalServicePrice = getServicePrice() + getAdditionalServicePrice();
		return $totalServicePrice;
	}

	// If any field will be changed - new price will be found
	$('.additional-service, #notebook_model_action').change(function() {
		$('#total_service_price').removeClass('hidden');
		// Insert value to the span
		$('#total_service_price span').html(' $' + calculateServicePrice());
		// Insert value to the hidden input
		$('#total_service').val('$' + calculateServicePrice());
	});
	/***************************************/
	/* end Service price */
	/***************************************/

	/***************************************/
	/* Show/hide address */
	/***************************************/
	$('#courier').change(function() {
		if ( $('#courier').is(':checked') ) {
			$('#courier_address').removeClass('hidden');
		} else {
			$('#courier_address').addClass('hidden');
			$('#courier_address input[type="text"]').val('');
		}
	});
	/***************************************/
	/* end Show/hide delivery address */
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
			notebook: {
				required: true
			},
			notebook_model: {
				required: true
			},
			'notebook_model_action[]': {
				required: true
			},
			name: {
				required: true
			},
			phone: {
				required: true
			},
			email: {
				required: true,
				email:true
			},
			address: {
				required: '#courier:checked'
			}
		},
		messages: {
			notebook: {
				required: 'Please select a notebook type'
			},
			notebook_model: {
				required: 'Please select a notebook model'
			},
			'notebook_model_action[]': {
				required: 'Please select desired services'
			},
			name: {
				required: 'Please enter your name'
			},
			phone: {
				required: 'Please enter your phone'
			},
			email: {
				required: 'Please enter your email',
				email: 'Incorrect email format'
			},
			address: {
				required: 'Please enter your address'
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

						// Hide inscription field
						if ( !$('#courier_address').hasClass('hidden') ) {
							$('#courier_address').addClass('hidden');
						}

						// Clear "services" dropdown
						if ( $("#notebook_model_action option").length) {
							$("#notebook_model_action option").remove();
							$("#notebook_model_action").append('<option value="">select an action...</option>');
						}

						// Clear total service price
						$('#total_service_price span').html('');
						$('#total_service').val('');

						// Reset form
						$('#j-forms').resetForm();

						// Hide total price div
						$('#total_service_price').addClass('hidden');

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
