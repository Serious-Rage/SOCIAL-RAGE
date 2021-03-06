<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $name, $way_to_communicate, $email, $email_message, $phone,
											$time, $phone_message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(STEP_SERVER, STEP_USER, STEP_PASSWORD, STEP_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_way_to_communicate`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_email_message`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_time`,
																	`".$mysql_table."_phone_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $name)."',
																		'".mysqli_real_escape_string($link, $way_to_communicate)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $email_message)."',
																		'".mysqli_real_escape_string($link, $phone)."',
																		'".mysqli_real_escape_string($link, $time)."',
																		'".mysqli_real_escape_string($link, $phone_message)."')");

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