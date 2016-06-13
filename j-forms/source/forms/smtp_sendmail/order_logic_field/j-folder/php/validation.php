<?php

/******************************************************/
/* Validation methods */
/******************************************************/

	/* validateFirstField */
	function validateFirstField($item, $min_length) {
		$error_text = "Enter a first fruit";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateFirstFieldQuantity */
	function validateFirstFieldQuantity($item, $min_length) {
		$error_text = "Enter a first fruit quantity";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateFirstFieldPrice */
	function validateFirstFieldPrice($item, $min_length) {
		$error_text = "Enter a first fruit price";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateSecondField */
	function validateSecondField($item, $min_length) {
		$error_text = "Enter a second fruit";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateSecondFieldQuantity */
	function validateSecondFieldQuantity($item, $min_length) {
		$error_text = "Enter a second fruit quantity";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateSecondFieldPrice */
	function validateSecondFieldPrice($item, $min_length) {
		$error_text = "Enter a second fruit price";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateThirdField */
	function validateThirdField($item, $min_length) {
		$error_text = "Enter a third fruit";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateThirdFieldQuantity */
	function validateThirdFieldQuantity($item, $min_length) {
		$error_text = "Enter a third fruit quantity";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* validateThirdFieldPrice */
	function validateThirdFieldPrice($item, $min_length) {
		$error_text = "Enter a third fruit price";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Name */
	function validateName($item, $min_length) {
		$error_text = "Enter your name";
		$len = mb_strlen($item, 'UTF-8');
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

?>
