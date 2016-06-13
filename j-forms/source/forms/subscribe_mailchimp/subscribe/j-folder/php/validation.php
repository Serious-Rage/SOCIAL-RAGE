<?php

/******************************************************/
/* Validation methods */
/******************************************************/
	/* First Name */
	function validateFirstName($name, $min_length) {
		$error_text = "Enter your first name";
		$len = mb_strlen($name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Last Name */
	function validateLastName($name, $min_length) {
		$error_text = "Enter your last name";
		$len = mb_strlen($name, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}


?>