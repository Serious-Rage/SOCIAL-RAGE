<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $name, $company, $email, $phone, $service, $budget, $date_from, $date_to,
								$file_name, $message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(SER_SERVER, SER_USER, SER_PASSWORD, SER_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_company`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_service`,
																	`".$mysql_table."_budget`,
																	`".$mysql_table."_datefrom`,
																	`".$mysql_table."_dateto`,
																	`".$mysql_table."_filename`,
																	`".$mysql_table."_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $name)."',
																		'".mysqli_real_escape_string($link, $company)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $phone)."',
																		'".mysqli_real_escape_string($link, $service)."',
																		'".mysqli_real_escape_string($link, $budget)."',
																		'".mysqli_real_escape_string($link, $date_from)."',
																		'".mysqli_real_escape_string($link, $date_to)."',
																		'".mysqli_real_escape_string($link, $file_name)."',
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