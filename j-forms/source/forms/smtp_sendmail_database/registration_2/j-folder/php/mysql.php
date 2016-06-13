<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $user_name, $email, $pass, $first_name, $last_name, $gender) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(REG_SERVER, REG_USER, REG_PASSWORD, REG_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_username`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_password`,
																	`".$mysql_table."_firstname`,
																	`".$mysql_table."_lastname`,
																	`".$mysql_table."_gender`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $user_name)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $pass)."',
																		'".mysqli_real_escape_string($link, $first_name)."',
																		'".mysqli_real_escape_string($link, $last_name)."',
																		'".mysqli_real_escape_string($link, $gender)."')");

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