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
	$your_subject = "J-forms: Summer Camp form";

	/* Define your data to access MySQL database */
	define("CAMP_USER", "username");					// your username
	define("CAMP_SERVER", "host");						// your host
	define("CAMP_PASSWORD", "password");				// your password
	define("CAMP_DATABASE", "database");				// your database

	/* Your database table goes here */
	$mysql_table = "camp";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_child_first_name	= true;
	$validate_child_last_name	= true;
	$validate_name_of_school	= true;
	$validate_grade				= true;
	$validate_age				= true;
	$validate_parent_first_name	= true;
	$validate_parent_last_name	= true;
	$validate_email				= true;
	$validate_phone				= true;
	$validate_message			= true;

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

	/* POST data */
	$child_first_name	= (isset($_POST["child_first_name"]))	? strip_tags(trim($_POST["child_first_name"]))	: false;
	$child_last_name	= (isset($_POST["child_last_name"]))	? strip_tags(trim($_POST["child_last_name"]))	: false;
	$name_of_school		= (isset($_POST["name_of_school"]))		? strip_tags(trim($_POST["name_of_school"]))	: false;
	$grade				= (isset($_POST["grade"]))				? strip_tags(trim($_POST["grade"]))				: false;
	$age				= (isset($_POST["age"]))				? strip_tags(trim($_POST["age"]))				: false;
	$parent_first_name	= (isset($_POST["parent_first_name"]))	? strip_tags(trim($_POST["parent_first_name"]))	: false;
	$parent_last_name	= (isset($_POST["parent_last_name"]))	? strip_tags(trim($_POST["parent_last_name"]))	: false;
	$email				= (isset($_POST["email"]))				? strip_tags(trim($_POST["email"]))				: false;
	$phone				= (isset($_POST["phone"]))				? strip_tags(trim($_POST["phone"]))				: false;
	$message			= (isset($_POST["message"]))			? strip_tags(trim($_POST["message"]))			: false;
	$token				= (isset($_POST["token_camp"]))			? strip_tags(trim($_POST["token_camp"]))		: false;

	$child_first_name	= htmlspecialchars($child_first_name, ENT_QUOTES, 'UTF-8');
	$child_last_name	= htmlspecialchars($child_last_name, ENT_QUOTES, 'UTF-8');
	$name_of_school		= htmlspecialchars($name_of_school, ENT_QUOTES, 'UTF-8');
	$grade				= htmlspecialchars($grade, ENT_QUOTES, 'UTF-8');
	$age				= htmlspecialchars($age, ENT_QUOTES, 'UTF-8');
	$parent_first_name	= htmlspecialchars($parent_first_name, ENT_QUOTES, 'UTF-8');
	$parent_last_name	= htmlspecialchars($parent_last_name, ENT_QUOTES, 'UTF-8');
	$email				= htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$phone				= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$message			= htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$token				= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$child_first_name	= substr($child_first_name, 0, 30);
	$child_last_name	= substr($child_last_name, 0, 30);
	$name_of_school		= substr($name_of_school, 0, 50);
	$grade				= substr($grade, 0, 30);
	$age				= substr($age, 0, 30);
	$parent_first_name	= substr($parent_first_name, 0, 30);
	$parent_last_name	= substr($parent_last_name, 0, 30);
	$email				= substr($email, 0, 30);
	$phone				= substr($phone, 0, 30);
	$message			= substr($message, 0, 1500);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('camp');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/

	/* child_first_name */
	if ($validate_child_first_name){
		$result = validateChildFirstName($child_first_name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* child_last_name */
	if ($validate_child_last_name){
		$result = validateChildLastName($child_last_name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* name_of_school */
	if ($validate_name_of_school){
		$result = validateNameOfSchool($name_of_school, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* grade */
	if ($validate_grade){
		$result = validateGrade($grade, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* age */
	if ($validate_age){
		$result = validateAge($age);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	// validate next variables
	// only if second step is shown
	$valid_age = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
	if (in_array($age, $valid_age)) {

		/* parent_first_name */
		if ($validate_parent_first_name){
			$result = validateParentFirstName($parent_first_name, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* parent_last_name */
		if ($validate_parent_last_name){
			$result = validateParentLastName($parent_last_name, 1);
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

		/* message */
		if ($validate_message){
			$result = validateMessage($message, 10);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

	}
	// end next_step

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
			$row_id = queryMysqli($mysql_table, $child_first_name, $child_last_name, $name_of_school, $grade, $age, $parent_first_name,
											$parent_last_name, $email, $phone, $message);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $child_first_name, $child_last_name, $name_of_school, $grade, $age, $parent_first_name,
											$parent_last_name, $email, $phone, $message);
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
			$mail->From = $child_first_name;
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
			$mail->From = $child_first_name;
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