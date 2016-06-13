<?php
	header("Content-Type: text/html; charset=utf-8");

	if (!$_POST) exit;

	require dirname(__FILE__)."/validation.php";
	require dirname(__FILE__)."/csrf.php";

/************************************************/
/* Your data */
/************************************************/
	/* Your email goes here */
	$your_email = "example@domain.com";

	/* Your name or your company name goes here */
	$your_name = "Just Forms subscription info";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_first_name = true;
	$validate_last_name	 = true;
	$validate_email		 = true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter	= true;
	$subscribe 		= true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* POST data */
	$first_name	 = (isset($_POST["first_name"]))		? strip_tags(trim($_POST["first_name"]))	  : false;
	$last_name	 = (isset($_POST["last_name"]))			? strip_tags(trim($_POST["last_name"]))		  : false;
	$email		 = (isset($_POST["email"]))				? strip_tags(trim($_POST["email"]))			  : false;
	$token		 = (isset($_POST["token_subscribe"]))	? strip_tags(trim($_POST["token_subscribe"])) : false;

	$first_name	 = htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8');
	$last_name	 = htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8');
	$email		 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$token		 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$first_name	 = substr($first_name, 0, 50);
	$last_name	 = substr($last_name, 0, 50);
	$email		 = substr($email, 0, 40);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('subscribe');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* First Name */
	if ($validate_first_name){
		$result = validateFirstName($first_name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Last Name */
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

	/* If validation error occurs */
	if ($error_text) {
		foreach ($error_text as $val) {
			$error_message .= '<li>' . $val . '</li>';
		}
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! The following errors occurred:<ul>' . $error_message . '</ul></div>';
		exit;
	}

/************************************************/
/* Subscribe */
/************************************************/
	if ($subscribe) {
		require dirname(__FILE__)."/MCAPI.class.php";

		// Enter your MailChimp API key
		// For example: $api = new MCAPI('12dceee0f9158c65563339bc7effe9e6-us11');
		$api = new MCAPI('your_mailchimp_api_key');

		// Variables
		$merge_vars = array('FNAME'=>$first_name, 'LNAME'=>$last_name);

		// Submit subscriber data to MailChimp
		// For parameters doc, refer to: http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
		// Enter your MailChimp List ID as a first parameter
		// For example: $retval = $api->listSubscribe( 'a3a956351f', $email, $merge_vars, 'html', false, true );
		$retval = $api->listSubscribe( 'your_mailchimp_list_id', $email, $merge_vars, 'html', false, true );

		if ($api->errorCode){
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! Something wrong with subscription. Try again later</div>';
			exit;
		}
	}

/************************************************/
/* Sending confirmation email */
/************************************************/
	if ($send_letter) {

		/* Send confirmation email using sendmail function */
		/* If you want to use sendmail - true, if you don't - false */
		/* If you will use sendmail function - do not forget to set '$smtp' variable to 'false' */
		$sendmail = true;
		if ($sendmail) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/subscribe_message.php";
			$mail = new PHPMailer;
			$mail->isSendmail();
			$mail->IsHTML(true);
			$mail->From = $your_email;
			$mail->FromName = $your_name;
			$mail->CharSet = "UTF-8";
			$mail->Encoding = "base64";
			$mail->ContentType = "text/html";
			$mail->addAddress($email, $first_name);
			$mail->Subject = "Subscribe form";
			$mail->Body = $subscribe_message;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* Send confirmation email using smtp function */
		/* If you want to use smtp - true, if you don't - false */
		/* If you will use smtp function - do not forget to set '$sendmail' variable to 'false' */
		$smtp = false;
		if ($smtp) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/subscribe_message.php";
			$mail = new PHPMailer;
			$mail->isSMTP();											// Set mailer to use SMTP
			$mail->Host = "smtp1.example.com;smtp2.example.com";		// Specify main and backup server
			$mail->SMTPAuth = true;										// Enable SMTP authentication
			$mail->Username = "your-username";							// SMTP username
			$mail->Password = "your-password";							// SMTP password
			$mail->SMTPSecure = "tls";									// Enable encryption, 'ssl' also accepted
			$mail->Port = 465;											// SMTP Port number e.g. smtp.gmail.com uses port 465
			$mail->IsHTML(true);
			$mail->From = $your_email;
			$mail->FromName = $your_name;
			$mail->CharSet = "UTF-8";
			$mail->Encoding = "base64";
			$mail->ContentType = "text/html";
			$mail->addAddress($email, $first_name);
			$mail->Subject = "Subscribe form";
			$mail->Body = $subscribe_message;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* if error occurs while email sending */
		if(!$mail->send()) {
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Mailer Error: ' . $mail->ErrorInfo . '</div>';
			exit;
		}
	}
	// end sending confirmation email

/************************************************/
/* Success message */
/************************************************/
	echo'<div class="success-message unit"><i class="fa fa-check"></i>Thank you for subscription. Please check your mail box.</div>';
?>