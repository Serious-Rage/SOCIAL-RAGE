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
	$your_subject = "J-forms: Order service";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name		 = true;
	$validate_company	 = true;
	$validate_email		 = true;
	$validate_phone		 = true;
	$validate_service	 = true;
	$validate_budget	 = true;
	$validate_date_from	 = true;
	$validate_date_to	 = true;
	$validate_file		 = true;
	$validate_message	 = true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter = true;
	$upload_file = true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* File name */
	/* In case, if a file will not be uploaded to a server */
	$file_name = "No file for upload";

	/* Allowed file types */
	$valid_types = array("image/jpg", "image/jpeg", "image/png", "application/msword",
							"application/vnd.openxmlformats-officedocument.wordprocessingml.document");

	/* POST data */
	$name		= (isset($_POST["name"]))		 ? strip_tags(trim($_POST["name"]))			 : false;
	$company	= (isset($_POST["company"]))	 ? strip_tags(trim($_POST["company"]))		 : false;
	$email		= (isset($_POST["email"]))		 ? strip_tags(trim($_POST["email"]))		 : false;
	$phone		= (isset($_POST["phone"]))		 ? strip_tags(trim($_POST["phone"]))		 : false;
	$message	= (isset($_POST["message"]))	 ? strip_tags(trim($_POST["message"]))		 : false;
	$date_from	= (isset($_POST["date_from"]))	 ? strip_tags(trim($_POST["date_from"]))	 : false;
	$date_to	= (isset($_POST["date_to"]))	 ? strip_tags(trim($_POST["date_to"]))		 : false;
	$service	= (isset($_POST["service"]))	 ? strip_tags(trim($_POST["service"]))		 : false;
	$budget		= (isset($_POST["budget"]))		 ? strip_tags(trim($_POST["budget"]))		 : false;
	$token		= (isset($_POST["token_order"])) ? strip_tags(trim($_POST["token_order"]))	 : false;

	$name		= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$company	= htmlspecialchars($company, ENT_QUOTES, 'UTF-8');
	$email		= htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$phone		= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$message	= htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$date_from	= htmlspecialchars($date_from, ENT_QUOTES, 'UTF-8');
	$date_to	= htmlspecialchars($date_to, ENT_QUOTES, 'UTF-8');
	$service	= htmlspecialchars($service, ENT_QUOTES, 'UTF-8');
	$budget		= htmlspecialchars($budget, ENT_QUOTES, 'UTF-8');
	$token		= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$name		= substr($name, 0, 30);
	$company	= substr($company, 0, 30);
	$email		= substr($email, 0, 30);
	$phone		= substr($phone, 0, 30);
	$message	= substr($message, 0, 1500);
	$date_from	= substr($date_from, 0, 20);
	$date_to	= substr($date_to, 0, 20);
	$service	= substr($service, 0, 40);
	$budget		= substr($budget, 0, 40);

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
	/* Name */
	if ($validate_name){
		$result = validateName($name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Company */
	if ($validate_company){
		$result = validateCompany($company, 1);
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

	/* Service */
	if ($validate_service){
		$result = validateService($service);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Budget */
	if ($validate_budget){
		$result = validateBudget($budget);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Date from */
	if ($validate_date_from){
		$result = validateDateFrom($date_from, "/");
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Date to */
	if ($validate_date_to){
		$result = validateDateTo($date_to, "/");
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

	/* File*/
	if ($validate_file){
		$result = validateFile($valid_types);
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
	/* Upload file */
	if ($upload_file) {
		$file_name = uploadFile();
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
