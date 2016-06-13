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
	$your_subject = "J-forms: Review form";

	/* Define your data to access MySQL database */
	define("REV_USER", "username");					// your username
	define("REV_SERVER", "host");					// your host
	define("REV_PASSWORD", "password");				// your password
	define("REV_DATABASE", "database");				// your database

	/* Your database table goes here */
	$mysql_table = "review";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name			= true;
	$validate_email			= true;
	$validate_message		= true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter 			= true;
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

	/* POST data */
	$name		 = (isset($_POST["name"]))			? strip_tags(trim($_POST["name"]))			: false;
	$email		 = (isset($_POST["email"]))			? strip_tags(trim($_POST["email"]))			: false;
	$product	 = (isset($_POST["prod_rating"]))	? strip_tags(trim($_POST["prod_rating"]))	: 0;
	$service	 = (isset($_POST["serv_rating"]))	? strip_tags(trim($_POST["serv_rating"]))	: 0;
	$support	 = (isset($_POST["supp_rating"]))	? strip_tags(trim($_POST["supp_rating"]))	: 0;
	$delivery	 = (isset($_POST["del_rating"]))	? strip_tags(trim($_POST["del_rating"]))	: 0;
	$message 	 = (isset($_POST["message"]))		? strip_tags(trim($_POST["message"]))		: false;
	$token		 = (isset($_POST["token_review"])) 	? strip_tags(trim($_POST["token_review"])) 	: false;

	$name		 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$email		 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$message	 = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$product	 = htmlspecialchars($product, ENT_QUOTES, 'UTF-8');
	$service	 = htmlspecialchars($service, ENT_QUOTES, 'UTF-8');
	$support	 = htmlspecialchars($support, ENT_QUOTES, 'UTF-8');
	$delivery	 = htmlspecialchars($delivery, ENT_QUOTES, 'UTF-8');
	$token		 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$name		 = substr($name, 0, 50);
	$email		 = substr($email, 0, 40);
	$message	 = substr($message, 0, 1000);
	$product	 = substr($product, 0, 5);
	$service	 = substr($service, 0, 5);
	$support	 = substr($support, 0, 5);
	$delivery	 = substr($delivery, 0, 5);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('review');
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

	/* Message */
	if ($validate_message){
		$result = validateMessage($message, 20);
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
			$row_id = queryMysqli($mysql_table, $name, $email, $message, $product, $service, $delivery, $support);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $name, $email, $message, $product, $service, $delivery, $support);
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