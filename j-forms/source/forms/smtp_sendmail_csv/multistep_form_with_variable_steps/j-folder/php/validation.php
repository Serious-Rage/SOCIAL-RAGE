<?php

/******************************************************/
/* Validation methods */
/******************************************************/

	/* Name */
	function validateName($name, $min_length) {
		$error_text = "Enter your name";
		$len = mb_strlen($name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* way_to_communicate */
	function validateWayToCommunicate($item, $min_length) {
		$error_text = "Select best way to communicate";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}


	/* email message */
	function validateEmailMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Phone */
	function validatePhone($phone) {
		$error_text = "Phone format: (xxx) xxx-xxxx";
		$phone_template = "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/";
		return (preg_match($phone_template, $phone) !== 1) ? $error_text : "valid";
	}

	/* time */
	function validateTime($item) {
		$error_text = "Select time to call";
		return ($item == "") ? $error_text : "valid";
	}

	/* phone message */
	function validatePhoneMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}
?>