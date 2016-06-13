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

	/* Username */
	function validateUsertName($user_name, $min_length) {
		$error_text = "Enter your login";
		$len = mb_strlen($user_name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}

	/* Password */
	function validatePass($pass, $min_length) {
		$error_text = "Password: min lenght " . $min_length . " characters";
		$len = mb_strlen($pass, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

?>