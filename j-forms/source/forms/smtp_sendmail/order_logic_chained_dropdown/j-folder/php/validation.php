<?php

/******************************************************/
/* Validation methods */
/******************************************************/

	/* notebook */
	function validateNotebook($notebook) {
		$error_text = "Select type of notebook";
		return ($notebook == "") ? $error_text : "valid";
	}

	/* notebook_model */
	function validateNotebookModel($notebook_model) {
		$error_text = "Select notebook model";
		return ($notebook_model == "") ? $error_text : "valid";
	}

	/* notebook_model_action */
	function validateNotebookModelAction($notebook_model_action, $min_length) {
		$error_text = "Select services";
		$len = mb_strlen($notebook_model_action, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Name */
	function validateName($name, $min_length) {
		$error_text = "Enter your name";
		$len = mb_strlen($name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Phone */
	function validatePhone($phone) {
		$error_text = "Phone format: (xxx) xxx-xxxx";
		$phone_template = "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/";
		return (preg_match($phone_template, $phone) !== 1) ? $error_text : "valid";
	}

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}

	/* address */
	function validateAddress($address, $min_length) {
		$error_text = "Enter delivery address";
		$len = mb_strlen($address, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	// Processing 'notebook_model_action' field
	// Making string from array
	function actionGroup($item) {
		$string = '';
		foreach ($item as $val) {
			$string .= strip_tags(trim($val)) . ", ";
		}
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = substr($string, 0, -2);
		return $string;
	}
?>
