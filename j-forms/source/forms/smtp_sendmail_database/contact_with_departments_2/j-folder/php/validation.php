<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* Sender's name */
	function validateSenderName($name, $min_length) {
		$error_text = "Enter sender's name";
		$len = mb_strlen($name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Sender's email */
	function validateSenderEmail($item) {
		$error_text = "Select sender's department";
		return ($item == "") ? $error_text : "valid";
	}

	/* Sender's phone */
	function validateSenderPhone($item) {
		$error_text = "Select sender's phone";
		return ($item == "") ? $error_text : "valid";
	}

	/* Recipient's name */
	function validateRecipientName($item, $min_length) {
		$error_text = "Enter recipient's name";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Recipien's email */
	function validateRecipientEmail($item) {
		$error_text = "Select recipient's department";
		return ($item == "") ? $error_text : "valid";
	}

	/* Subject */
	function validateSubject($subject, $min_length) {
		$error_text = "Enter subject";
		$len = mb_strlen($subject, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

?>