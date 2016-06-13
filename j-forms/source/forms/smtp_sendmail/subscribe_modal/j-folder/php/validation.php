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

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}

	/* News group */
	function validateNewsGroup($newsgroup){
		$error_text = "Select type of newsletter";
		return (!$newsgroup) ? $error_text : "valid";
	}

	// Processing subscribe information
	// Making string from array
	function subscribeGroup($item) {
		$string = '';
		foreach ($item as $val) {
			$string .= strip_tags(trim($val)) . ", ";
		}
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = substr($string, 0, -2);
		return $string;
	}

?>
