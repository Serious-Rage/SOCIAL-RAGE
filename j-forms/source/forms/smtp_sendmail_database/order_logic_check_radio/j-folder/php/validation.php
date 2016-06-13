<?php

/******************************************************/
/* Validation methods */
/******************************************************/

	/* cake_size */
	function validateCakeSize($cake_size, $min_length) {
		$error_text = "Select cake size";
		$len = mb_strlen($cake_size, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* filling */
	function validateFilling($filling, $min_length) {
		$error_text = "Enter your filling";
		$len = mb_strlen($filling, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* candles */
	function validateCandles($candles, $min_length) {
		$error_text = "Select candles checkbox";
		$len = mb_strlen($candles, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* show_inscription */
	function validateShowInscription($show_inscription, $min_length) {
		$error_text = "Select show inscription checkbox";
		$len = mb_strlen($show_inscription, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* inscription */
	function validateInscription($inscription, $min_length) {
		$error_text = "Enter an inscription";
		$len = mb_strlen($inscription, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* delivery */
	function validateDelivery($item) {
		$error_text = "Select type of delivery";
		return ($item == "") ? $error_text : "valid";
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

	// Processing 'filling' field
	// Making string from array
	function fillingGroup($item) {
		$string = '';
		foreach ($item as $val) {
			$string .= strip_tags(trim($val)) . ", ";
		}
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = substr($string, 0, -2);
		return $string;
	}
?>