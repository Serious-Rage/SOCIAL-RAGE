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

	/* pickup_date */
	function validatePickupDate($pickup_date, $date_symbol, $time_symbol) {
		$error_text = "Pickup date format: mm" . $date_symbol . "dd" . $date_symbol . "yyyy " . "hh" . $time_symbol . "mm";
		$reg_date_symbol = '\\'.$date_symbol;
		$reg_time_symbol = ':'.$time_symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}".$reg_date_symbol."[0-3]{1}[0-9]{1}".$reg_date_symbol."[0-9]{4} "."[0-2]{1}[0-9]{1}".$time_symbol."[0-5]{1}[0-9]{1}$/";
		return (preg_match($date_template, $pickup_date) !== 1) ? $error_text : "valid";
	}

	/* return_date */
	function validateReturnDate($return_date, $date_symbol, $time_symbol) {
		$error_text = "Return date format: mm" . $date_symbol . "dd" . $date_symbol . "yyyy " . "hh" . $time_symbol . "mm";
		$reg_date_symbol = '\\'.$date_symbol;
		$reg_time_symbol = ':'.$time_symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}".$reg_date_symbol."[0-3]{1}[0-9]{1}".$reg_date_symbol."[0-9]{4} "."[0-2]{1}[0-9]{1}".$time_symbol."[0-5]{1}[0-9]{1}$/";
		return (preg_match($date_template, $return_date) !== 1) ? $error_text : "valid";
	}

	/* next step */
	function validateNextStep($item, $min_length) {
		$error_text = "Select next step action";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* airport */
	function validateAirport($airport, $min_length) {
		$error_text = "Enter airport";
		$len = mb_strlen($airport, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* airline_flight_number */
	function validateAirlineFlightNumber($airline_flight_number, $min_length) {
		$error_text = "Enter your airline and flight number";
		$len = mb_strlen($airline_flight_number, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* pickup_address */
	function validatePickupAddress($pickup_address, $min_length) {
		$error_text = "Enter pickup address";
		$len = mb_strlen($pickup_address, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* drop_off */
	function validateDropOff($drop_off, $min_length) {
		$error_text = "Enter drop off address";
		$len = mb_strlen($drop_off, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}
?>