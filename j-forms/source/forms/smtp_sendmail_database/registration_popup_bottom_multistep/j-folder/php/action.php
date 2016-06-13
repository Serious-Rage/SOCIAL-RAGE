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
	$your_subject = "J-forms: Registration form";

	/* Define your data to access MySQL database */
	define("REG_USER", "username");						// your username
	define("REG_SERVER", "host");						// your host
	define("REG_PASSWORD", "password");					// your password
	define("REG_DATABASE", "database");					// your database

	/* Your database table goes here */
	$mysql_table = "register";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_user_name	 = true;
	$validate_email		 = true;
	$validate_pass		 = true;
	$validate_conf_pass	 = true;
	$validate_first_name = true;
	$validate_last_name	 = true;
	$validate_gender	 = true;

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
	$user_name	= (isset($_POST["username"]))			? strip_tags(trim($_POST["username"]))			: false;
	$email		= (isset($_POST["email"]))				? strip_tags(trim($_POST["email"]))				: false;
	$pass		= (isset($_POST["password"]))			? strip_tags(trim($_POST["password"]))			: false;
	$conf_pass	= (isset($_POST["confirm_password"]))	? strip_tags(trim($_POST["confirm_password"]))	: false;
	$first_name = (isset($_POST["first_name"]))			? strip_tags(trim($_POST["first_name"]))		: false;
	$last_name	= (isset($_POST["last_name"]))			? strip_tags(trim($_POST["last_name"]))			: false;
	$gender		= (isset($_POST["gender"]))				? strip_tags(trim($_POST["gender"]))			: false;
	$token 		= (isset($_POST["token_register"])) 	? strip_tags(trim($_POST["token_register"]))	: false;

	$user_name	= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
	$email		= htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$pass		= htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
	$conf_pass	= htmlspecialchars($conf_pass, ENT_QUOTES, 'UTF-8');
	$first_name = htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8');
	$last_name	= htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8');
	$gender		= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8');
	$token 		= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$user_name	= substr($user_name, 0, 30);
	$email		= substr($email, 0, 30);
	$pass		= substr($pass, 0, 30);
	$conf_pass	= substr($conf_pass, 0, 30);
	$first_name = substr($first_name, 0, 30);
	$last_name	= substr($last_name, 0, 30);
	$gender		= substr($gender, 0, 10);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('register');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* Username */
	if ($validate_user_name){
		$result = validateUsertName($user_name, 1);
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

	/* Password */
	if ($validate_pass) {
		$result = validatePass($pass, 6);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Confirm password */
	if ($validate_conf_pass) {
		$result = validateConfPass($pass, $conf_pass);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

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

	/* Gender */
	if ($validate_gender){
		$result = validateGender($gender);
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
			$row_id = queryMysqli($mysql_table, $user_name, $email, $pass, $first_name, $last_name, $gender);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $user_name, $email, $pass, $first_name, $last_name, $gender);
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