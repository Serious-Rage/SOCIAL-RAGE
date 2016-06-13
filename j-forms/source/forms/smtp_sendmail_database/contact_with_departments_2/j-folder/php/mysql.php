<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $sender_name, $sender_email, $sender_phone, $recipient_name, $recipient_email,
									$subject, $message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(CON_SERVER, CON_USER, CON_PASSWORD, CON_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_sendername`,
																	`".$mysql_table."_senderemail`,
																	`".$mysql_table."_senderphone`,
																	`".$mysql_table."_recipientname`,
																	`".$mysql_table."_recipientemail`,
																	`".$mysql_table."_subject`,
																	`".$mysql_table."_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $sender_name)."',
																		'".mysqli_real_escape_string($link, $sender_email)."',
																		'".mysqli_real_escape_string($link, $sender_phone)."',
																		'".mysqli_real_escape_string($link, $recipient_name)."',
																		'".mysqli_real_escape_string($link, $recipient_email)."',
																		'".mysqli_real_escape_string($link, $subject)."',
																		'".mysqli_real_escape_string($link, $message)."')");

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($link);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($link);
		}

		/* Return result */
		mysqli_close($link);
		return $error_exists ? $error_mysql : $row_id;
	}
?>