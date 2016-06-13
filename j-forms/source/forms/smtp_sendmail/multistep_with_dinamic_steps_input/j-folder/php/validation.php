<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* child first name */
	function validateChildFirstName($item, $min_length) {
		$error_text = "Enter child first name";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* child last name */
	function validateChildLastName($item, $min_length) {
		$error_text = "Enter child last name";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* name of school */
	function validateNameOfSchool($item, $min_length) {
		$error_text = "Enter name of school";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* grade */
	function validateGrade($item) {
		$error_text = "Select grade";
		return ($item == "") ? $error_text : "valid";
	}

	/* age */
	function validateAge($item) {
		$error_text = "Enter child age";
		$age_template = "/^[0-9]{1,2}$/";
		return (preg_match($age_template, $item) !== 1) ? $error_text : "valid";
	}

	/* parent first name */
	function validateParentFirstName($item, $min_length) {
		$error_text = "Enter parent first name";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* parent last name */
	function validateParentLastName($item, $min_length) {
		$error_text = "Enter parent last name";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}

	/* Phone */
	function validatePhone($phone) {
		$error_text = "Phone format: (xxx) xxx-xxxx";
		$phone_template = "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/";
		return (preg_match($phone_template, $phone) !== 1) ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

?>
