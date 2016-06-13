<?php
	header("Content-Type: text/html; charset=utf-8");

	if (!$_POST) exit;

	require dirname(__FILE__)."/validation.php";
	require dirname(__FILE__)."/csrf.php";

/************************************************/
/* Your data */
/************************************************/
	/* Your email goes here */
	$your_email = "your_email@domain.com";

	/* Your name or your company name goes here */
	$your_name = "Your name";

	/* Message subject */
	$your_subject = "J-forms: Job application form";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_first_name	= true;
	$validate_last_name		= true;
	$validate_email			= true;
	$validate_phone			= true;
	$validate_country		= true;
	$validate_city			= true;
	$validate_post_code		= true;
	$validate_address		= true;
	$validate_position		= true;
	$validate_message		= true;
	$validate_first_file	= true;
	$validate_second_file	= true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter		= true;
	$upload_first_file  = true;
	$upload_second_file = true;
	$duplicate_to_csv	= true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* File name */
	/* In case, if a file will not be uploaded to a server */
	$first_file_name = $second_file_name = "No file for upload";

	/* Allowed file types */
	$valid_types = array("application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword",
							"application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

	/* POST data */
	$first_name  = (isset($_POST["first_name"])) ? strip_tags(trim($_POST["first_name"])) 	: false;
	$last_name	 = (isset($_POST["last_name"]))	 ? strip_tags(trim($_POST["last_name"]))	: false;
	$email		 = (isset($_POST["email"]))		 ? strip_tags(trim($_POST["email"]))		: false;
	$phone		 = (isset($_POST["phone"]))		 ? strip_tags(trim($_POST["phone"]))		: false;
	$country	 = (isset($_POST["country"]))	 ? strip_tags(trim($_POST["country"]))		: false;
	$city		 = (isset($_POST["city"]))		 ? strip_tags(trim($_POST["city"]))			: false;
	$post		 = (isset($_POST["post"]))		 ? strip_tags(trim($_POST["post"]))			: false;
	$address	 = (isset($_POST["address"]))	 ? strip_tags(trim($_POST["address"]))		: false;
	$position	 = (isset($_POST["position"]))	 ? strip_tags(trim($_POST["position"]))		: false;
	$message	 = (isset($_POST["message"]))	 ? strip_tags(trim($_POST["message"]))		: false;
	$token 		 = (isset($_POST["token_job"]))	 ? strip_tags(trim($_POST["token_job"]))	: false;

	$first_name  = htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8');
	$last_name	 = htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8');
	$email		 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$phone		 = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$country	 = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
	$city		 = htmlspecialchars($city, ENT_QUOTES, 'UTF-8');
	$address	 = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
	$post		 = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
	$message	 = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$position	 = htmlspecialchars($position, ENT_QUOTES, 'UTF-8');
	$token 		 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$first_name  = substr($first_name, 0, 20);
	$last_name	 = substr($last_name, 0, 20);
	$email		 = substr($email, 0, 30);
	$phone		 = substr($phone, 0, 20);
	$country	 = substr($country, 0, 70);
	$city		 = substr($city, 0, 30);
	$address	 = substr($address, 0, 60);
	$post		 = substr($post, 0, 10);
	$position	 = substr($position, 0, 30);
	$message	 = substr($message, 0, 1500);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('job');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* First name */
	if ($validate_first_name){
		$result = validateFirstName($first_name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Last name */
	if ($validate_last_name){
		$result = validateLastName($last_name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Email */
	if ($validate_email){
		$result = validateEmail($email);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Phone */
	if ($validate_phone){
		$result = validatePhone($phone);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Country */
	if ($validate_country){
		$result = validateCountry($country);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* City */
	if ($validate_city){
		$result = validateCity($city, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Post code */
	if ($validate_post_code){
		$result = validatePostCode($post);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Address */
	if ($validate_address){
		$result = validateAddress($address, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Position */
	if ($validate_position){
		$result = validatePosition($position);
		if ($result !== "valid") {
				$error_text[] = $result;
			}
	}

	/* Info */
	if ($validate_message){
		$result = validateMessage($message, 20);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* First file*/
	if ($validate_first_file){
		$result = validateFirstFile($valid_types);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Second file*/
	if ($validate_second_file){
		$result = validateSecondFile($valid_types);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* If validation error occurs */
	if ($error_text) {
		foreach ($error_text as $val) {
			$error_message .= '<li>' . $val . '</li>';
		}
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! The following errors occurred:<ul>' . $error_message . '</ul></div>';
		exit;
	}

/************************************************/
/* Upload file to the server */
/************************************************/
	/* Upload first file */
	if ($upload_first_file) {
		$first_file_name = uploadFirstFile();
	}

	/* Upload second file */
	if ($upload_second_file) {
		$second_file_name = uploadSecondFile();
	}

/************************************************/
/* Duplicate info to a CSV file */
/************************************************/
	if ($duplicate_to_csv) {

		/* Name of the CSV file */
		$file_csv = "../csv_file/j-forms-csv.csv";

		/* Headers for the rows in the CSV file */
		/* You can modify this array according to the variables, received through the form */
		/* If this array with headers has been modified - do not forget to modify the "$variable_csv" array */
		$header_csv = array(
							"First_Name",
							"Last_Name",
							"Email",
							"Phone",
							"Country",
							"City",
							"Address",
							"Post_Code",
							"Position",
							"First_File_Name",
							"Second_File_Name",
							"Message"
						);

		/* Array with data received through the form */
		/* Add the variables you want to be added to a csv file */
		/* If this array with data has been modified - do not forget to modify the "$header_csv" array */
		$variable_csv = array(
							$first_name,
							$last_name,
							$email,
							$phone,
							$country,
							$city,
							$address,
							$post,
							$position,
							$first_file_name,
							$second_file_name,
							$message
						);

		/* CSV file processing */
		/* If CSV file doesn't exist */
		if (!file_exists($file_csv)) {

			// Open CSV file
			$processing_csv = fopen($file_csv, 'a');
			// Add special symbols for correct encoding
			fwrite($processing_csv, "\xEF\xBB\xBF");
			// Add headers for the rows
			fputcsv($processing_csv,$header_csv);
			// Add variables to the file
			fputcsv($processing_csv, $variable_csv);

		/* If CSV file exists */
		} else {

			// Open CSV file
			$processing_csv = fopen($file_csv, 'a');
			// Add variables to the file
			fputcsv($processing_csv, $variable_csv);

		}
		fclose($processing_csv);
	}

/************************************************/
/* Sending email */
/************************************************/
	if ($send_letter) {

		/* Send email using sendmail function */
		/* If you want to use sendmail - true, if you don't - false */
		/* If you will use sendmail function - do not forget to set '$smtp' variable to 'false' */
		$sendmail = true;
		if ($sendmail) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/message.php";
			$mail = new PHPMailer;
			$mail->isSendmail();
			$mail->IsHTML(true);
			$mail->From = $email;
			$mail->CharSet = "UTF-8";
			$mail->FromName = "J-forms";
			$mail->Encoding = "base64";
			$mail->ContentType = "text/html";
			$mail->addAddress($your_email, $your_name);
			$mail->Subject = $your_subject;
			$mail->Body = $letter;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* Send email using smtp function */
		/* If you want to use smtp - true, if you don't - false */
		/* If you will use smtp function - do not forget to set '$sendmail' variable to 'false' */
		$smtp = false;
		if ($smtp) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/message.php";
			$mail = new PHPMailer;
			$mail->isSMTP();											// Set mailer to use SMTP
			$mail->Host = "smtp1.example.com;smtp2.example.com";		// Specify main and backup server
			$mail->SMTPAuth = true;										// Enable SMTP authentication
			$mail->Username = "your-username";							// SMTP username
			$mail->Password = "your-password";							// SMTP password
			$mail->SMTPSecure = "tls";									// Enable encryption, 'ssl' also accepted
			$mail->Port = 465;											// SMTP Port number e.g. smtp.gmail.com uses port 465
			$mail->IsHTML(true);
			$mail->From = $email;
			$mail->CharSet = "UTF-8";
			$mail->FromName = "J-forms";
			$mail->Encoding = "base64";
			$mail->Timeout = 200;
			$mail->SMTPDebug = 0;
			$mail->ContentType = "text/html";
			$mail->addAddress($your_email, $your_name);
			$mail->Subject = $your_subject;
			$mail->Body = $letter;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* Multiple email recepients */
		/* If you want to add multiple email recepients - true, if you don't - false */
		/* Enter email and name of the recipients */
		$recipients = false;
		if ($recipients) {
			$recipients = array("email@domain.com" => "name of recipient",
								"email@domain.com" => "name of recipient",
								"email@domain.com" => "name of recipient"
								);
			foreach ($recipients as $email => $name) {
				$mail->AddBCC($email, $name);
			}
		}

		/* if error occurs while email sending */
		if(!$mail->send()) {
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Mailer Error: ' . $mail->ErrorInfo . '</div>';
			exit;
		}
	}

/************************************************/
/* Success message */
/************************************************/
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your information has been sent successfully</div>';
?>