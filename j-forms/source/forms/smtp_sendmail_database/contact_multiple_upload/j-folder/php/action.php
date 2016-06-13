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
	$your_subject = "J-forms: Contact form";

	/* Define your data to access MySQL database */
	define("CON_USER", "username");					// your username
	define("CON_SERVER", "host");					// your host
	define("CON_PASSWORD", "password");				// your password
	define("CON_DATABASE", "database");				// your database

	/* Your database table goes here */
	$mysql_table = "contact";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name			= true;
	$validate_email			= true;
	$validate_subject		= true;
	$validate_message		= true;
	$validate_first_file	= true;
	$validate_second_file	= true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter 			= true;
	$upload_first_file 		= true;
	$upload_second_file 	= true;
	$duplicate_to_database	= true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* Last row ID */
	/* In case, if data will not be duplicated to a database */
	$row_id = "No data in a database";

	/* File name */
	/* In case, if a file will not be uploaded to a server */
	$first_file_name = $second_file_name = "No file for upload";

	/* Allowed file types */
	$valid_types = array("image/jpg", "image/jpeg", "image/png", "application/msword",
							"application/vnd.openxmlformats-officedocument.wordprocessingml.document");

	/* POST data */
	$name	 = (isset($_POST["name"]))			? strip_tags(trim($_POST["name"]))			: false;
	$email	 = (isset($_POST["email"]))			? strip_tags(trim($_POST["email"]))			: false;
	$subject = (isset($_POST["subject"]))		? strip_tags(trim($_POST["subject"]))		: false;
	$message = (isset($_POST["message"]))		? strip_tags(trim($_POST["message"]))		: false;
	$token	 = (isset($_POST["token_contact"])) ? strip_tags(trim($_POST["token_contact"])) : false;

	$name	 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$email	 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
	$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$token	 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$name	 = substr($name, 0, 50);
	$email	 = substr($email, 0, 40);
	$subject = substr($subject, 0, 45);
	$message = substr($message, 0, 1000);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('contact');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* Name */
	if ($validate_name){
		$result = validateName($name, 1);
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

	/* Subject */
	if ($validate_subject){
		$result = validateSubject($subject, 1);
		if ($result !== "valid") {
				$error_text[] = $result;
			}
	}

	/* Message */
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
/* Duplicate info to a database */
/************************************************/
	if ($duplicate_to_database) {

		/* Select type of connection to a database */
		/* If you want to use connection - true, if you don't - false */
		/* For proper work you have to select only one type of connection */

		/* Mysqli connection to DB */
		$mysqli_connect = true;
		if ($mysqli_connect) {
			require dirname(__FILE__)."/mysql.php";
			$row_id = queryMysqli($mysql_table, $name, $email, $subject, $first_file_name, $second_file_name, $message);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $name, $email, $subject, $first_file_name, $second_file_name, $message);
		}
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
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your message has been sent</div>';
?>