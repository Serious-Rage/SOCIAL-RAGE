<?php

/******************************************************/
/* Validation methods */
/******************************************************/
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

	/* Email */
	function validateEmail($email){
		$error_text = "Incorrect email format";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
	}

	/* Phone */
	function validatePhone($phone) {
		$error_text = "Phone format: (xxx) xxx-xxxx";
		$phone_template = "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/";
		return (preg_match($phone_template, $phone) !== 1) ? $error_text : "valid";
	}

	/* Country */
	function validateCountry($country) {
		$error_text = "Select your country";
		return ($country == "") ? $error_text : "valid";
	}

	/* City */
	function validateCity($city, $min_length) {
		$error_text = "Enter your city";
		$len = mb_strlen($city, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Post code */
	function validatePostCode($post){
		$error_text = "Enter your post code";
		$item_template = "/^[0-9]{3}-[0-9]{4}+$/";
		return (preg_match($item_template, $post) !== 1) ? $error_text : "valid";
	}

	/* Adrress */
	function validateAddress($address, $min_length) {
		$error_text = "Enter your address";
		$len = mb_strlen($address, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Position */
	function validatePosition($item) {
		$error_text = "Select desired position";
		return ($item == "") ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* First file */
	function validateFirstFile($valid_types) {
		$attach_file_size	= 1*1024*1024;
		$error_exist		= false;
		$error_text			= "First file: incorrect extension and/or too big file size";
		if (!empty($_FILES["file1"])) {
			if (!in_array($_FILES["file1"]["type"], $valid_types)) {
				$error_exist = true;
			}
			if (!is_uploaded_file($_FILES["file1"]["tmp_name"])) {
				$error_exist = true;
			}
			if ($_FILES["file1"]["size"] > $attach_file_size) {
				$error_exist = true;
			}
			return ($error_exist) ? $error_text : "valid";
		} else {
			return "Upload first file";
		}
	}

	/* Generate uniq name for first file */
	function generateFirstFileName(){
		return uniqid().'-'.strtolower($_FILES["file1"]["name"]);
	}

	/* Upload first file */
	function uploadFirstFile(){
		$new_file = 'No file to upload.';
		if (!empty($_FILES["file1"])) {
			$new_file = generateFirstFileName();
			move_uploaded_file($_FILES["file1"]["tmp_name"], '../upload_file/'.$new_file);
		}
		return $new_file;
	}

	/* Second file */
	function validateSecondFile($valid_types) {
		$attach_file_size	= 1*1024*1024;
		$error_exist		= false;
		$error_text			= "Second file: incorrect extension and/or too big file size";
		if (!empty($_FILES["file2"])) {
			if (!in_array($_FILES["file2"]["type"], $valid_types)) {
				$error_exist = true;
			}
			if (!is_uploaded_file($_FILES["file2"]["tmp_name"])) {
				$error_exist = true;
			}
			if ($_FILES["file2"]["size"] > $attach_file_size) {
				$error_exist = true;
			}
			return ($error_exist) ? $error_text : "valid";
		} else {
			return "Upload second file";
		}
	}

	/* Generate uniq name for second file */
	function generateSecondFileName(){
		return uniqid().'-'.strtolower($_FILES["file2"]["name"]);
	}

	/* Upload second file */
	function uploadSecondFile(){
		$new_file = 'No file to upload.';
		if (!empty($_FILES["file2"])) {
			$new_file = generateSecondFileName();
			move_uploaded_file($_FILES["file2"]["tmp_name"], '../upload_file/'.$new_file);
		}
		return $new_file;
	}

?>