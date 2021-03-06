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
	$your_subject = "J-forms: Callback form";

	/* reCaptcha secret key */
	/* $secret = "6LcVnAwTAAAAqMk-QtVnCDrf-pa33iEkgh"; - an example of the secret key*/
	$secret = "your-secret-key";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name		= true;
	$validate_phone		= true;
	$validate_time		= true;
	$validate_message	= true;
	$validate_captcha	= true;

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
	$name		= (isset($_POST["name"]))					? strip_tags(trim($_POST["name"]))					 : false;
	$phone		= (isset($_POST["phone"]))					? strip_tags(trim($_POST["phone"]))					 : false;
	$time		= (isset($_POST["time"]))					? strip_tags(trim($_POST["time"]))					 : false;
	$message	= (isset($_POST["message"]))				? strip_tags(trim($_POST["message"]))				 : false;
	$token		= (isset($_POST["token_call"])) 			? strip_tags(trim($_POST["token_call"]))			 : false;
	$captcha	= (isset($_POST["g-recaptcha-response"]))	? strip_tags(trim($_POST["g-recaptcha-response"]))	 : false;

	$name		= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone		= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$time		= htmlspecialchars($time, ENT_QUOTES, 'UTF-8');
	$message	= htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$token		= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$name		= substr($name, 0, 30);
	$phone		= substr($phone, 0, 30);
	$time		= substr($time, 0, 30);
	$message	= substr($message, 0, 1500);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('call');
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

	/* Phone */
	if ($validate_phone){
		$result = validatePhone($phone);
		if ($result !== "valid") {
				$error_text[] = $result;
			}
	}

	/* Time */
	if ($validate_time){
		$result = validateTime($time);
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
/* reCaptcha verification */
/************************************************/
	if ($validate_captcha) {
		require dirname(__FILE__)."/reCaptcha/autoload.php";

		// Create an instance of the service using your secret
		$re_captcha = new \ReCaptcha\ReCaptcha($secret);

		// If file_get_contents() is locked down on your PHP installation to disallow
		// its use with URLs, then you can use the alternative request method instead.
		// This makes use of fsockopen() instead.
		// $re_captcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());

		// Make the call to verify the response and also pass the user's IP address
		$valid_captcha = $re_captcha->verify($captcha, $_SERVER["REMOTE_ADDR"]);

		if (!$valid_captcha->isSuccess()) {
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! Are you a robot?</div>';
			exit;
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