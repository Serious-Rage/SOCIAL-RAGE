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
	$your_subject = "J-forms: Order friuts form";

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */

	$validate_first_field			 = true;
	$validate_first_field_quantity	 = true;
	$validate_first_field_price		 = true;
	$validate_first_field_total		 = true;
	$validate_second_field			 = true;
	$validate_second_field_quantity	 = true;
	$validate_second_field_price	 = true;
	$validate_second_field_total	 = true;
	$validate_third_field			 = true;
	$validate_third_field_quantity	 = true;
	$validate_third_field_price		 = true;
	$validate_third_field_total		 = true;
	$validate_field_totals			 = true;
	$validate_name					 = true;
	$validate_email					 = true;
	$validate_phone					 = true;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter 		= true;
	$duplicate_to_csv 	= true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* POST data */
	$first_field			 = (isset($_POST["first_field"]))			 ? strip_tags(trim($_POST["first_field"]))			 : false;
	$first_field_quantity	 = (isset($_POST["first_field_quantity"]))	 ? strip_tags(trim($_POST["first_field_quantity"]))	 : false;
	$first_field_price		 = (isset($_POST["first_field_price"]))		 ? strip_tags(trim($_POST["first_field_price"]))	 : false;
	$first_field_total		 = (isset($_POST["first_field_total"]))		 ? strip_tags(trim($_POST["first_field_total"]))	 : false;
	$second_field			 = (isset($_POST["second_field"]))			 ? strip_tags(trim($_POST["second_field"]))			 : false;
	$second_field_quantity	 = (isset($_POST["second_field_quantity"]))  ? strip_tags(trim($_POST["second_field_quantity"])) : false;
	$second_field_price		 = (isset($_POST["second_field_price"]))	 ? strip_tags(trim($_POST["second_field_price"]))	 : false;
	$second_field_total		 = (isset($_POST["second_field_total"]))	 ? strip_tags(trim($_POST["second_field_total"]))	 : false;
	$third_field			 = (isset($_POST["third_field"]))			 ? strip_tags(trim($_POST["third_field"]))			 : false;
	$third_field_quantity	 = (isset($_POST["third_field_quantity"])) 	 ? strip_tags(trim($_POST["third_field_quantity"]))  : false;
	$third_field_price		 = (isset($_POST["third_field_price"]))		 ? strip_tags(trim($_POST["third_field_price"]))	 : false;
	$third_field_total		 = (isset($_POST["third_field_total"]))		 ? strip_tags(trim($_POST["third_field_total"]))	 : false;
	$field_totals			 = (isset($_POST["field_totals"]))			 ? strip_tags(trim($_POST["field_totals"]))			 : false;
	$name					 = (isset($_POST["name"]))					 ? strip_tags(trim($_POST["name"]))					 : false;
	$email					 = (isset($_POST["email"]))					 ? strip_tags(trim($_POST["email"]))				 : false;
	$phone					 = (isset($_POST["phone"]))					 ? strip_tags(trim($_POST["phone"]))				 : false;
	$token					 = (isset($_POST["token_order"]))			 ? strip_tags(trim($_POST["token_order"]))			 : false;

	$first_field			 = htmlspecialchars($first_field, ENT_QUOTES, 'UTF-8');
	$first_field_quantity	 = htmlspecialchars($first_field_quantity, ENT_QUOTES, 'UTF-8');
	$first_field_price		 = htmlspecialchars($first_field_price, ENT_QUOTES, 'UTF-8');
	$first_field_total		 = htmlspecialchars($first_field_total, ENT_QUOTES, 'UTF-8');
	$second_field			 = htmlspecialchars($second_field, ENT_QUOTES, 'UTF-8');
	$second_field_quantity	 = htmlspecialchars($second_field_quantity, ENT_QUOTES, 'UTF-8');
	$second_field_price		 = htmlspecialchars($second_field_price, ENT_QUOTES, 'UTF-8');
	$second_field_total		 = htmlspecialchars($second_field_total, ENT_QUOTES, 'UTF-8');
	$third_field			 = htmlspecialchars($third_field, ENT_QUOTES, 'UTF-8');
	$third_field_quantity	 = htmlspecialchars($third_field_quantity, ENT_QUOTES, 'UTF-8');
	$third_field_price		 = htmlspecialchars($third_field_price, ENT_QUOTES, 'UTF-8');
	$third_field_total		 = htmlspecialchars($third_field_total, ENT_QUOTES, 'UTF-8');
	$field_totals			 = htmlspecialchars($field_totals, ENT_QUOTES, 'UTF-8');
	$name					 = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$email					 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$phone					 = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
	$token					 = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	$first_field			 = substr($first_field, 0, 30);
	$first_field_quantity	 = substr($first_field_quantity, 0, 30);
	$first_field_price		 = substr($first_field_price, 0, 30);
	$first_field_total		 = substr($first_field_total, 0, 30);
	$second_field			 = substr($second_field, 0, 30);
	$second_field_quantity	 = substr($second_field_quantity, 0, 30);
	$second_field_price		 = substr($second_field_price, 0, 30);
	$second_field_total		 = substr($second_field_total, 0, 30);
	$third_field			 = substr($third_field, 0, 30);
	$third_field_quantity	 = substr($third_field_quantity, 0, 30);
	$third_field_price		 = substr($third_field_price, 0, 30);
	$third_field_total		 = substr($third_field_total, 0, 30);
	$field_totals			 = substr($field_totals, 0, 30);
	$name					 = substr($name, 0, 30);
	$email					 = substr($email, 0, 30);
	$phone					 = substr($phone, 0, 30);

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

	/* first_field */
	if ($validate_first_field){
		$result = validateFirstField($first_field, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* first_field_quantity */
	if ($validate_first_field_quantity){
		$result = validateFirstFieldQuantity($first_field_quantity, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* first_field_price */
	if ($validate_first_field_price){
		$result = validateFirstFieldPrice($first_field_price, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* watermalon */
	if ($validate_second_field){
		$result = validateSecondField($second_field, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* second_field_quantity */
	if ($validate_second_field_quantity){
		$result = validateSecondFieldQuantity($second_field_quantity, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* second_field_price */
	if ($validate_second_field_price){
		$result = validateSecondFieldPrice($second_field_price, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* third_field */
	if ($validate_third_field){
		$result = validateThirdField($third_field, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* third_field_quantity */
	if ($validate_third_field_quantity){
		$result = validateThirdFieldQuantity($third_field_quantity, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* third_field_price */
	if ($validate_third_field_price){
		$result = validateThirdFieldPrice($third_field_price, 1);
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
/* Duplicate info to a CSV file */
/************************************************/
	if ($duplicate_to_csv) {

		/* Name of the CSV file */
		$file_csv = "../csv_file/j-forms-csv.csv";

		/* Headers for the rows in the CSV file */
		/* You can modify this array according to the variables, received through the form */
		/* If this array with headers has been modified - do not forget to modify the "$variable_csv" array */
		$header_csv = array(
							"First field",
							"First field quantity",
							"First field price",
							"First field total",
							"Second field",
							"Second field quantity",
							"Second field price",
							"Second field total",
							"Third field",
							"Third field quantity",
							"Third field price",
							"Third field total",
							"Field_totals",
							"Name",
							"Email",
							"Phone"
						);

		/* Array with data received through the form */
		/* Add the variables you want to be added to a csv file */
		/* If this array with data has been modified - do not forget to modify the "$header_csv" array */
		$variable_csv = array(
							$first_field,
							$first_field_quantity,
							$first_field_price,
							$first_field_total,
							$second_field,
							$second_field_quantity,
							$second_field_price,
							$second_field_total,
							$third_field,
							$third_field_quantity,
							$third_field_price,
							$third_field_total,
							$field_totals,
							$name,
							$email,
							$phone
						);

		/* CSV file processing */
		/* If CSV file doesn't exist */
		if (!file_exists($file_csv)) {

			// Open CSV file
			$processing_csv = fopen($file_csv, 'a');
			// Add special symbols for correct encoding
			fwrite($processing_csv, "\xEF\xBB\xBF");
			// Add headers for the rows
			fputcsv($processing_csv,$header_csv);
			// Add variables to the file
			fputcsv($processing_csv, $variable_csv);

		/* If CSV file exists */
		} else {

			// Open CSV file
			$processing_csv = fopen($file_csv, 'a');
			// Add variables to the file
			fputcsv($processing_csv, $variable_csv);

		}
		fclose($processing_csv);
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