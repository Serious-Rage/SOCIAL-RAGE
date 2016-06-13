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

	/* Company */
	function validateCompany($company, $min_length) {
		$error_text = "Enter your Company name";
		$len = mb_strlen($company, 'UTF-8');
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

	/* Service */
	function validateService($service) {
		$error_text = "Select service";
		return ($service == "") ? $error_text : "valid";
	}

	/* Budget */
	function validateBudget($budget) {
		$error_text = "Select budget";
		return ($budget == "") ? $error_text : "valid";
	}

	/* Date from */
	function validateDateFrom($date_from, $symbol) {
		$error_text = "Start date format: mm" . $symbol . "dd" . $symbol . "yyyy";
		$reg_symbol = '\\'.$symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-9]{4}$/";
		return (preg_match($date_template, $date_from) !== 1) ? $error_text : "valid";
	}

	/* Date to */
	function validateDateTo($date_to, $symbol) {
		$error_text = "Finish date format: mm" . $symbol . "dd" . $symbol . "yyyy";
		$reg_symbol = '\\'.$symbol;
		$date_template = "/^[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-3]{1}[0-9]{1}" . $reg_symbol . "[0-9]{4}$/";
		return (preg_match($date_template, $date_to) !== 1) ? $error_text : "valid";
	}

	/* Message */
	function validateMessage($message, $min_length) {
		$error_text = "The message is too short - min " . $min_length . " characters";
		$len = mb_strlen($message, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* File */
	function validateFile($valid_types) {
		$attach_file_size	= 1*1024*1024;
		$error_exist		= false;
		$error_text			= "File: incorrect extension and/or too big file size";
		if (!empty($_FILES["file"])) {
			if (!in_array($_FILES["file"]["type"], $valid_types)) {
				$error_exist = true;
			}
			if (!is_uploaded_file($_FILES["file"]["tmp_name"])) {
				$error_exist = true;
			}
			if ($_FILES["file"]["size"] > $attach_file_size) {
				$error_exist = true;
			}
			return ($error_exist) ? $error_text : "valid";
		} else {
			return "Upload some file";
		}
	}

	/* Generate uniq name for file */
	function generateFileName(){
		return uniqid().'-'.strtolower($_FILES["file"]["name"]);
	}

	/* Upload file */
	function uploadFile(){
		$new_file = 'No file to upload.';
		if (!empty($_FILES["file"])) {
			$new_file = generateFileName();
			move_uploaded_file($_FILES["file"]["tmp_name"], '../upload_file/'.$new_file);
		}
		return $new_file;
	}
?>
