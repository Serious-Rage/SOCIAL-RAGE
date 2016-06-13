<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* Username */
	function validateLogin($login, $min_length) {
		$error_text = "Enter your login";
		$len = mb_strlen($login, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Password */
	function validatePass($pass, $min_length) {
		$error_text = "Password: min lenght " . $min_length . " characters";
		$len = mb_strlen($pass, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

?>
