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
	$your_subject = "J-forms: Travel Reservation form";

	/* Define your data to access MySQL database */
	define("TRV_USER", "username");					// your username
	define("TRV_SERVER", "host");					// your host
	define("TRV_PASSWORD", "password");				// your password
	define("TRV_DATABASE", "database");				// your database

	/* Your database table goes here */
	$mysql_table = "travel";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name					= true;
	$validate_phone					= true;
	$validate_email					= true;
	$validate_pickup_date			= true;
	$validate_return_date			= true;
	$validate_next_step				= true;
	$validate_airport				= true;
	$validate_airline_flight_number	= true;
	$validate_pickup_address		= true;
	$validate_drop_off				= true;
	$validate_message				= true;

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
	$name					= (isset($_POST["name"]))					? strip_tags(trim($_POST["name"]))					 : false;
	$phone					= (isset($_POST["phone"]))					? strip_tags(trim($_POST["phone"]))					 : false;
	$email					= (isset($_POST["email"]))					? strip_tags(trim($_POST["email"]))					 : false;
	$pickup_date			= (isset($_POST["pickup_date"]))			? strip_tags(trim($_POST["pickup_date"]))			 : false;
	$return_date			= (isset($_POST["return_date"]))			? strip_tags(trim($_POST["return_date"]))			 : false;
	$next_step 				= (isset($_POST["next_step_checkbox"]))		? strip_tags(trim($_POST["next_step_checkbox"]))	 : false;
	$airport				= (isset($_POST["airport"]))				? strip_tags(trim($_POST["airport"]))				 : false;
	$airline_flight_number	= (isset($_POST["airline_flight_number"]))	? strip_tags(trim($_POST["airline_flight_number"]))	 : false;
	$pickup_address			= (isset($_POST["pickup_address"]))			? strip_tags(trim($_POST["pickup_address"]))		 : false;
	$drop_off				= (isset($_POST["drop_off"]))				? strip_tags(trim($_POST["drop_off"]))				 : false;
	$message				= (isset($_POST["message"]))				? strip_tags(trim($_POST["message"]))				 : false;
	$token					= (isset($_POST["token_travel"])) 			? strip_tags(trim($_POST["token_travel"]))			 : false;

	$name					= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$phone					= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$email					= htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$pickup_date			= htmlspecialchars($pickup_date, ENT_QUOTES, 'UTF-8');
	$return_date			= htmlspecialchars($return_date, ENT_QUOTES, 'UTF-8');
	$next_step				= htmlspecialchars($next_step, ENT_QUOTES, 'UTF-8');
	$airport				= htmlspecialchars($airport, ENT_QUOTES, 'UTF-8');
	$airline_flight_number	= htmlspecialchars($airline_flight_number, ENT_QUOTES, 'UTF-8');
	$pickup_address			= htmlspecialchars($pickup_address, ENT_QUOTES, 'UTF-8');
	$drop_off				= htmlspecialchars($drop_off, ENT_QUOTES, 'UTF-8');
	$message				= htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
	$token					= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$name					= substr($name, 0, 30);
	$phone					= substr($phone, 0, 30);
	$email					= substr($email, 0, 30);
	$pickup_date			= substr($pickup_date, 0, 30);
	$return_date			= substr($return_date, 0, 30);
	$next_step				= substr($next_step, 0, 30);
	$airport				= substr($airport, 0, 50);
	$airline_flight_number	= substr($airline_flight_number, 0, 50);
	$pickup_address			= substr($pickup_address, 0, 50);
	$drop_off				= substr($drop_off, 0, 50);
	$message				= substr($message, 0, 1500);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('travel');
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

	/* email */
	if ($validate_email){
		$result = validateEmail($email);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* pickup_date */
	if ($validate_pickup_date){
		$result = validatePickupDate($pickup_date, "/", ":");
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* return_date */
	if ($validate_return_date){
		$result = validateReturnDate($return_date, "/", ":");
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	// validate next variables
	// only if second step is shown
	if ($next_step === "Yes") {

		/* airport */
		if ($validate_airport){
			$result = validateAirport($airport, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* airline_flight_number */
		if ($validate_airline_flight_number){
			$result = validateAirlineFlightNumber($airline_flight_number, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* pickup_address */
		if ($validate_pickup_address){
			$result = validatePickupAddress($pickup_address, 1);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* drop_off */
		if ($validate_drop_off){
			$result = validateDropOff($drop_off, 1);
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
			$row_id = queryMysqli($mysql_table, $name, $phone, $email, $pickup_date, $return_date, $next_step, $airport, 
											$airline_flight_number, $pickup_address, $drop_off, $message);
		}
		/* PDO connection to DB */
		$pdo_connect = false;
		if ($pdo_connect) {
			require dirname(__FILE__)."/pdo.php";
			$row_id = queryPdo($mysql_table, $name, $phone, $email, $pickup_date, $return_date, $next_step, $airport, 
											$airline_flight_number, $pickup_address, $drop_off, $message);
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