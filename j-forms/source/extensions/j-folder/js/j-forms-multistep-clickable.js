$(document).ready(function(){

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

			// Click on the "step"
			$('.step-link').on('click', function(){

				// Get the step number
				$step_number = $(this).attr('data-step-number');

				// Active step number
				$active_step_number = $('#' + $id + ' .step.active-step .step-link').attr('data-step-number');

				// Passed steps processing
				// Add "passed-step" class to all steps before current step
				var passedSteps = function(){
					$('#' + $id + ' .step-link').each(function(j){
						if ( j+1 < $step_number ) {
							$('#' + $id + ' .step-link').eq(j).parent('.step').addClass('passed-step');
						}
					});
				};

				// If clicked step is "next" towards active step
				if ($step_number > $active_step_number) {

					// Processing the fieldsets
					// Remove current "active-fieldset" class
					$('#' + $id + ' fieldset').removeClass('active-fieldset');

					// Add "active-fieldset" class to the choosed fieldset
					$('#' + $id + ' fieldset').eq($step_number-1).addClass('active-fieldset');

					// Processing the steps
					$('#' + $id + ' .step-link').parent('.step').removeClass('active-step passed-step');
					$(this).parent('.step').addClass('active-step');
					passedSteps();

					// Processing the buttons
					// Display "prev" button
					$prev_btn.css('display', 'block');
					// Display "next" button
					$next_btn.css('display', 'block');

					// If active fieldset is a last
					if ( $('#' + $id + ' fieldset').eq($i-1).hasClass('active-fieldset') ) {
						// Display "submit" button
						$submit_btn.css('display', 'block');
						// Hide "next" button
						$next_btn.css('display', 'none');
					}

					return false;

				// If clicked step is "previous" towards active step
				} else {

					// Processing the fieldsets
					// Remove current "active-fieldset" class
					$('#' + $id + ' fieldset').removeClass('active-fieldset');

					// Add "active-fieldset" class to the choosed fieldset
					$('#' + $id + ' fieldset').eq($step_number-1).addClass('active-fieldset');

					// Processing the steps
					$('#' + $id + ' .step-link').parent('.step').removeClass('active-step passed-step');
					$(this).parent('.step').addClass('active-step');
					passedSteps();

					// Processing the buttons
					// Display "next" button
					$next_btn.css('display', 'block');
					// Hide "submit" button
					$submit_btn.css('display', 'none');

					// If active fieldset is a first
					if ( $('#' + $id + ' fieldset').eq(0).hasClass('active-fieldset') ) {
						// Hide "prev" button
						$prev_btn.css('display', 'none');
					} else {
						// Display "prev" button
						$prev_btn.css('display', 'block');
					}

					return false;
				}

			});
			// end click on the "step"

		});
		// end "each" statement
	}
	/***************************************/
	/* end multistep form */
	/***************************************/
});
