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
	$your_subject = "J-forms: Apartment rental form";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_apartment_type = true;
	$validate_name			 = true;
	$validate_phone			 = true;
	$validate_email			 = true;

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
	$apartment_type	 = (isset($_POST["apartment_type"]))	? strip_tags(trim($_POST["apartment_type"])) : false;
	$bedrooms		 = (isset($_POST["bedrooms"]))			? strip_tags(trim($_POST["bedrooms"]))		 : false;
	$bathrooms		 = (isset($_POST["bathrooms"]))			? strip_tags(trim($_POST["bathrooms"]))		 : false;
	$feets 			 = (isset($_POST["feets"]))				? strip_tags(trim($_POST["feets"]))			 : false;
	$feets_price 	 = (isset($_POST["feets_price"]))		? strip_tags(trim($_POST["feets_price"]))	 : false;
	$name			 = (isset($_POST["name"]))				? strip_tags(trim($_POST["name"]))			 : false;
	$phone			 = (isset($_POST["phone"]))				? strip_tags(trim($_POST["phone"]))			 : false;
	$email			 = (isset($_POST["email"]))				? strip_tags(trim($_POST["email"]))			 : false;
	$token			 = (isset($_POST["token_rental"])) 		? strip_tags(trim($_POST["token_rental"]))	 : false;

	$apartment_type	 = htmlspecialchars($apartment_type, ENT_QUOTES, 'UTF-8');
	$bedrooms		 = htmlspecialchars($bedrooms, ENT_QUOTES, 'UTF-8');
	$bathrooms		 = htmlspecialchars($bathrooms, ENT_QUOTES, 'UTF-8');
	$feets 			 = htmlspecialchars($feets, ENT_QUOTES, 'UTF-8');
	$feets_price 	 = htmlspecialchars($feets_price, ENT_QUOTES, 'UTF-8');
	$name			 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone			 = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$email			 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$token			 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$apartment_type	 = substr($apartment_type, 0, 50);
	$bedrooms		 = substr($bedrooms, 0, 10);
	$bathrooms		 = substr($bathrooms, 0, 10);
	$feets_price 	 = substr($feets_price, 0, 30);
	$feets 			 = substr($feets, 0, 30);
	$name			 = substr($name, 0, 50);
	$phone			 = substr($phone, 0, 30);
	$email			 = substr($email, 0, 30);

	/* Total prices */
	$total_feets 		= (isset($_POST["total_feets"]))		? strip_tags(trim($_POST["total_feets"]))		: false;
	$total_feets_price 	= (isset($_POST["total_feets_price"]))	? strip_tags(trim($_POST["total_feets_price"]))	: false;
	$totals 			= (isset($_POST["totals"]))				? strip_tags(trim($_POST["totals"]))			: false;

	$total_feets 		= htmlspecialchars($total_feets, ENT_QUOTES, 'UTF-8');
	$total_feets_price 	= htmlspecialchars($total_feets_price, ENT_QUOTES, 'UTF-8');
	$totals 			= htmlspecialchars($totals, ENT_QUOTES, 'UTF-8');

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('rental');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* Apartment type */
	if ($validate_apartment_type){
		$result = validateApartmentType($apartment_type);
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

	/* email */
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
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your message has been sent successfully</div>';
?>
