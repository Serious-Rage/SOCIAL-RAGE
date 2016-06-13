<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* Username */
	function validateUsertName($user_name, $min_length) {
		$error_text = "Enter your username";
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

	/* Confirm password */
	function validateConfPass($pass, $conf_pass) {
		$error_text = "Mismatched passwords";
		return ($pass !== $conf_pass) ? $error_text : "valid";
	}

	/* First name */
	function validateFirstName($first_name, $min_length) {
		$error_text = "Enter your first name";
		$len = mb_strlen($first_name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Last name */
	function validateLastName($last_name, $min_length) {
		$error_text = "Enter your last name";
		$len = mb_strlen($last_name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Gender */
	function validateGender($gender) {
		$error_text = "Select your gender";
		return ($gender == "") ? $error_text : "valid";
	}
?>