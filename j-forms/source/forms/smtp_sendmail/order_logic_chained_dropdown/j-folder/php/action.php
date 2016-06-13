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
	$your_subject = "J-forms: Notebook Service";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_notebook				= true;
	$validate_notebook_model		= true;
	$validate_notebook_model_action	= true;
	$validate_software				= true;
	$validate_courier				= true;
	$validate_name					= true;
	$validate_phone					= true;
	$validate_email					= true;
	$validate_address				= true;

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
	$notebook				= (isset($_POST["notebook"]))				? strip_tags(trim($_POST["notebook"]))			: false;
	$notebook_model			= (isset($_POST["notebook_model"]))			? strip_tags(trim($_POST["notebook_model"]))	: false;
	$notebook_model_action	= (isset($_POST["notebook_model_action"]))	? actionGroup($_POST["notebook_model_action"])	: false;
	$software				= (isset($_POST["software"]))				? strip_tags(trim($_POST["software"]))			: false;
	$courier				= (isset($_POST["courier"]))				? strip_tags(trim($_POST["courier"]))			: false;
	$name					= (isset($_POST["name"]))					? strip_tags(trim($_POST["name"]))				: false;
	$phone					= (isset($_POST["phone"]))					? strip_tags(trim($_POST["phone"]))				: false;
	$email					= (isset($_POST["email"]))					? strip_tags(trim($_POST["email"]))				: false;
	$address				= (isset($_POST["address"]))				? strip_tags(trim($_POST["address"]))			: false;
	$token					= (isset($_POST["token_notebook"])) 		? strip_tags(trim($_POST["token_notebook"]))	: false;

	$notebook				= htmlspecialchars($notebook, ENT_QUOTES, 'UTF-8');
	$notebook_model			= htmlspecialchars($notebook_model, ENT_QUOTES, 'UTF-8');
	$notebook_model_action	= htmlspecialchars($notebook_model_action, ENT_QUOTES, 'UTF-8');
	$software				= htmlspecialchars($software, ENT_QUOTES, 'UTF-8');
	$courier				= htmlspecialchars($courier, ENT_QUOTES, 'UTF-8');
	$name					= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone					= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$email					= htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$address				= htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
	$token					= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$notebook				= substr($notebook, 0, 30);
	$notebook_model			= substr($notebook_model, 0, 30);
	$notebook_model_action	= substr($notebook_model_action, 0, 1000);
	$software				= substr($software, 0, 40);
	$courier				= substr($courier, 0, 30);
	$name					= substr($name, 0, 30);
	$phone					= substr($phone, 0, 30);
	$email					= substr($email, 0, 30);
	$address				= substr($address, 0, 60);

	/* Total service price */
	$total_service = (isset($_POST["total_service"])) ? strip_tags(trim($_POST["total_service"])) : false;
	$total_service = htmlspecialchars($total_service, ENT_QUOTES, 'UTF-8');

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('notebook');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* notebook */
	if ($validate_notebook){
		$result = validateNotebook($notebook);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* notebook_model */
	if ($validate_notebook_model){
		$result = validateNotebookModel($notebook_model);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* notebook_model_action */
	if ($validate_notebook_model_action){
		$result = validateNotebookModelAction($notebook_model_action, 1);
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
		if ($courier === "courier-$15") {
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
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your message has been sent successfully</div>';
?>
