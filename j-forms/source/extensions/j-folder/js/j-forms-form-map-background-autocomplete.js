$(document).ready(function(){

	// Phone masking
	$('#phone').mask('(999) 999-9999', {placeholder:'x'});

	/***************************************/
	/* Google map */
	/***************************************/
	// Variables
	var
		arr = [],									// array for langitude and lattitude
		markerImage ='j-folder/img/marker.png',		// marker image
		map,										// map instance
		lat,										// new latitude
		lng;										// new longitude

	// Create a new map
	var createMap = function() {
		var myLatlng = new google.maps.LatLng(arr[0], arr[1]);

		var mapOptions = {
			center: myLatlng,
			zoom: 13,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("google-map"), mapOptions);

		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: markerImage
		});
	};

	// Create a map with new position and height
	var createNewPosition = function() {

		// Variables
		var
			wrapper_height 	= $('.wrapper').height() + 90,			// height of the .wrapper - '+90' - margins for the .wrapper
			screen_height 	= $(window).height(),					// height of the screen
			address 		= $("#address").val(),					// new address
			geocoder 		= new google.maps.Geocoder();			// google Geocoder instance

		// Set the height of the map
		if ( wrapper_height > screen_height ) {
			$('#google-map').css('height', wrapper_height);
		} else {
			$('#google-map').css('height', screen_height);
		}

		// Create a new position on the map according to post code and address
		geocoder.geocode({'address': address}, function addressSearch(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				arr[0] = results[0].geometry.location.lat();
				arr[1] = results[0].geometry.location.lng();
				$('body').removeClass('bg-pic');
				createMap();
			}
		});

		// Delete map height
		wrapper_height = 0;
		screen_height = 0;

	};

	// Auto complete
	function initialize() {
		var input = document.getElementById('address');
		var options = {componentRestrictions: {country: 'US'}};
		new google.maps.places.Autocomplete(input, options);
	}

	google.maps.event.addDomListener(window, 'load', initialize);

	/***************************************/
	/* end Google map */
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

				// Create a new map according to the postcode and address
				if ( $('#' + $id + ' fieldset').eq(0).hasClass('active-fieldset') ) {
					createNewPosition();
				}

				// Switch the "active" class to the next fieldset
				$('#' + $id + ' fieldset.active-fieldset').removeClass('active-fieldset').next('fieldset').addClass('active-fieldset');

				// If map exists
				// Create the new map with new height
				if ( map ) {
					createNewPosition();
				}

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

			});

			// Click on the "prev" button
			$prev_btn.on('click', function() {

				// Switch the "active" class to the previous fieldset
				$('#' + $id + ' fieldset.active-fieldset').removeClass('active-fieldset').prev('fieldset').addClass('active-fieldset');

				// If map exists
				// Create the new map with new height
				if ( map ) {
					createNewPosition();
				}

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
