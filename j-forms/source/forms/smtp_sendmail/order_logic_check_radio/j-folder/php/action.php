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
	$your_subject = "J-forms: Order cake form";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_cake_size			= true;
	$validate_filling			= true;
	$validate_candles			= true;
	$validate_show_inscription	= true;
	$validate_inscription		= true;
	$validate_delivery			= true;
	$validate_name				= true;
	$validate_phone				= true;
	$validate_email				= true;
	$validate_address			= true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter = true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* POST data */
	$cake_size			 = (isset($_POST["cake_size"]))			? strip_tags(trim($_POST["cake_size"]))			 : false;
	$filling			 = (isset($_POST["filling"]))			? fillingGroup($_POST["filling"])				 : false;
	$candles			 = (isset($_POST["candles"]))			? strip_tags(trim($_POST["candles"]))			 : false;
	$show_inscription 	 = (isset($_POST["show-inscription"]))	? strip_tags(trim($_POST["show-inscription"]))	 : false;
	$inscription		 = (isset($_POST["inscription"]))		? strip_tags(trim($_POST["inscription"]))		 : false;
	$delivery			 = (isset($_POST["delivery"]))			? strip_tags(trim($_POST["delivery"]))			 : false;
	$name				 = (isset($_POST["name"]))				? strip_tags(trim($_POST["name"]))				 : false;
	$phone				 = (isset($_POST["phone"]))				? strip_tags(trim($_POST["phone"]))				 : false;
	$email				 = (isset($_POST["email"]))				? strip_tags(trim($_POST["email"]))				 : false;
	$address			 = (isset($_POST["address"]))			? strip_tags(trim($_POST["address"]))			 : false;
	$token				 = (isset($_POST["token_order"])) 		? strip_tags(trim($_POST["token_order"]))		 : false;

	$cake_size			 = htmlspecialchars($cake_size, ENT_QUOTES, 'UTF-8');
	$candles			 = htmlspecialchars($candles, ENT_QUOTES, 'UTF-8');
	$show_inscription 	 = htmlspecialchars($show_inscription, ENT_QUOTES, 'UTF-8');
	$inscription		 = htmlspecialchars($inscription, ENT_QUOTES, 'UTF-8');
	$delivery			 = htmlspecialchars($delivery, ENT_QUOTES, 'UTF-8');
	$name				 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone				 = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$email				 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$address			 = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
	$token				 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$cake_size			 = substr($cake_size, 0, 30);
	$candles			 = substr($candles, 0, 30);
	$show_inscription 	 = substr($show_inscription, 0, 30);
	$inscription 		 = substr($inscription, 0, 130);
	$delivery			 = substr($delivery, 0, 30);
	$name				 = substr($name, 0, 30);
	$phone				 = substr($phone, 0, 30);
	$email				 = substr($email, 0, 30);
	$address			 = substr($address, 0, 130);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('order');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* cake_size */
	if ($validate_cake_size){
		$result = validateCakeSize($cake_size, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* filling */
	if ($validate_filling){
		$result = validateFilling($filling, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* candles */
	if ($validate_candles){
		$result = validateCandles($candles, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* show_inscription */
	if ($validate_show_inscription){
		$result = validateShowInscription($show_inscription, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* inscription */
	if ($validate_inscription){
		if ($show_inscription) {
			$result = validateInscription($inscription, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}
	}

	/* delivery */
	if ($validate_delivery){
		$result = validateDelivery($delivery, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Name */
	if ($validate_name){
		$result = validateName($name, 1);
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

	/* email */
	if ($validate_email){
		$result = validateEmail($email);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* address */
	if ($validate_address){
		if ($delivery === "Delivery-5$") {
			$result = validateAddress($address, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
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
			$mail->From = $name;
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
			$mail->From = $name;
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
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your order has been sent successfully</div>';
?>
