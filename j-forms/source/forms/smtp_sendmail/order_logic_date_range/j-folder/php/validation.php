<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* Date from */
	function validateDateFrom($date_from, $symbol) {
		$error_text = "Check-in date format: mm" . $symbol . "dd" . $symbol . "yyyy";
		$reg_symbol = '\\'.$symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-9]{4}$/";
		return (preg_match($date_template, $date_from) !== 1) ? $error_text : "valid";
	}

	/* Date to */
	function validateDateTo($date_to, $symbol) {
		$error_text = "Check-out date format: mm" . $symbol . "dd" . $symbol . "yyyy";
		$reg_symbol = '\\'.$symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-9]{4}$/";
		return (preg_match($date_template, $date_to) !== 1) ? $error_text : "valid";
	}

	/* Roo type */
	function validateRoomType($room_type) {
		$error_text = "Select room type";
		return ($room_type == "") ? $error_text : "valid";
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

	// Processing 'extra_service' field
	// Making string from array
	function extraServiceGroup($item) {
		$string = '';
		foreach ($item as $val) {
			$string .= strip_tags(trim($val)) . ", ";
		}
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = substr($string, 0, -2);
		return $string;
	}
?>
