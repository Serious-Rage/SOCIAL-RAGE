<?php

/******************************************************/
/* Validation methods */
/******************************************************/

	/* you_make_it */
	function validateYouMakeIt($item, $min_length) {
		$error_text = "Select a button";
		$len = mb_strlen($item, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* guest_quantity */
	function validateGuestQuantity($item) {
		$error_text = "Select guests quantity";
		return ($item == "") ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}
	
	// Processing friends
	// Making string from array
	function guestsQuantity($item) {
		$string = '';
		foreach ($item as $val) {
			$string .= strip_tags(trim($val)) . ", ";
		}
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = substr($string, 0, -2);
		return $string;
	}
?>