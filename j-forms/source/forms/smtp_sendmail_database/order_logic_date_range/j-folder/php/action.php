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
	$your_subject = "J-forms: Booking form";

	/* Define your data to access MySQL database */
	define("BOOK_USER", "username");					// your username
	define("BOOK_SERVER", "host");						// your host
	define("BOOK_PASSWORD", "password");				// your password
	define("BOOK_DATABASE", "database");				// your database

	/* Your database table goes here */
	$mysql_table = "booking";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_date_from		 = true;
	$validate_date_to		 = true;
	$validate_room_type		 = true;
	$validate_extra_service	 = true;
	$validate_name			 = true;
	$validate_phone			 = true;
	$validate_email			 = true;

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
	$date_from		 = (isset($_POST["date_from"]))		? strip_tags(trim($_POST["date_from"]))		 : false;
	$date_to		 = (isset($_POST["date_to"]))		? strip_tags(trim($_POST["date_to"]))		 : false;
	$room_type 		 = (isset($_POST["room_type"]))		? strip_tags(trim($_POST["room_type"]))		 : false;
	$extra_service	 = (isset($_POST["extra"]))			? extraServiceGroup($_POST["extra"])		 : false;
	$name			 = (isset($_POST["name"]))			? strip_tags(trim($_POST["name"]))			 : false;
	$phone			 = (isset($_POST["phone"]))			? strip_tags(trim($_POST["phone"]))			 : false;
	$email			 = (isset($_POST["email"]))			? strip_tags(trim($_POST["email"]))			 : false;
	$token			 = (isset($_POST["token_booking"])) ? strip_tags(trim($_POST["token_booking"]))	 : false;

	$date_from	 = htmlspecialchars($date_from, ENT_QUOTES, 'UTF-8');
	$date_to	 = htmlspecialchars($date_to, ENT_QUOTES, 'UTF-8');
	$room_type 	 = htmlspecialchars($room_type, ENT_QUOTES, 'UTF-8');
	$name		 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone		 = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$email		 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$token		 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');
	
	$date_from	 = substr($date_from, 0, 30);
	$date_to	 = substr($date_to, 0, 30);
	$room_type 	 = substr($room_type, 0, 50);
	$name		 = substr($name, 0, 50);
	$phone		 = substr($phone, 0, 30);
	$email		 = substr($email, 0, 30);

	/* Total prices */
	$total_room_price 	 = (isset($_POST["total_room"]))	? strip_tags(trim($_POST["total_room"]))	 : false;
	$total_extra_service = (isset($_POST["total_extras"]))	? strip_tags(trim($_POST["total_extras"]))	 : false;
	$totals 			 = (isset($_POST["totals"]))		? strip_tags(trim($_POST["totals"]))		 : false;

	$total_room_price 	 = htmlspecialchars($total_room_price, ENT_QUOTES, 'UTF-8');
	$total_extra_service = htmlspecialchars($total_extra_service, ENT_QUOTES, 'UTF-8');
	$totals 			 = htmlspecialchars($totals, ENT_QUOTES, 'UTF-8');

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('booking');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
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

	/* Room type */
	if ($validate_room_type){
		$result = validateRoomType($room_type);
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
			$row_id = queryMysqli($mysql_table, $date_from, $date_to, $room_type, $extra_service, $total_room_price,
											$total_extra_service, $totals, $name, $email, $phone);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $date_from, $date_to, $room_type, $extra_service, $total_room_price,
											$total_extra_service, $totals, $name, $email, $phone);
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
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your order has been sent successfully</div>';
?>