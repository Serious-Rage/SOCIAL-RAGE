$(document).ready(function(){

	/***************************************/
	/* TinyMCE editor */
	/***************************************/
	// Variables
	var editor_content = '',
		error_message = '<span class="error-view" id="textarea-error-message">Please enter your message</span>';

	// Initializing the plugin
	tinymce.init({
		selector: "textarea",
		statusbar: false,
		setup: function(editor) {
			editor.on('init', function() {
				this.getDoc().body.style.fontSize = '16px';						// Set font size
			});
			editor.on('change', function(e) {
				tinymce.triggerSave();											// Save all changes in the editor to the textarea
				editor_content = editor.getContent({format: 'text'});			// Get all data from the editor
			});
		}
	});

	// Validation function
	// If editor is empty - error message should arise
	$('#j-forms button[type="submit"]').click(function() {
		// If editor content is empty
		if ( $.trim(editor_content) == '' ) {
			$(tinymce.activeEditor.getBody()).css("background",'#ffebee');		// Set background color for error message for TinyMCE iframe
			if ( !$('#textarea-error-message').length ) {
				$('#textarea').parent('.input').append(error_message);			// Add error message
			}
			return false;
		} else {
			$(tinymce.activeEditor.getBody()).css("background",'#e8f5e9');		// Set background color for success message for TinyMCE iframe
			if ( $('#textarea-error-message').length ) {
				$('#textarea-error-message').remove();							// Delete error message
			}
		}
	});
	/***************************************/
	/* end TinyMCE editor */
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
			}
		},
		messages: {
			name: {
				required: 'Please enter your name'
			},
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

					// If response from the server is a 'success-message'
					if ( $('#j-forms .success-message').length ) {

						// Remove classes 'error-view' and 'success-view'
						$('#j-forms .input').removeClass('success-view error-view');
						$('#j-forms .check').removeClass('success-view error-view');

						// Reset form
						$('#j-forms').resetForm();

						// Set background color TinyMCE iframe
						$(tinymce.activeEditor.getBody()).css("background",'#fff');

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