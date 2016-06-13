<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $notebook, $notebook_model, $notebook_model_action, $software, $courier, $total_service,
									$name, $phone, $email, $address) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(NOTE_SERVER, NOTE_USER, NOTE_PASSWORD, NOTE_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_notebook`,
																	`".$mysql_table."_notebook_model`,
																	`".$mysql_table."_notebook_model_action`,
																	`".$mysql_table."_software`,
																	`".$mysql_table."_courier`,
																	`".$mysql_table."_total_service`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_address`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $notebook)."',
																		'".mysqli_real_escape_string($link, $notebook_model)."',
																		'".mysqli_real_escape_string($link, $notebook_model_action)."',
																		'".mysqli_real_escape_string($link, $software)."',
																		'".mysqli_real_escape_string($link, $courier)."',
																		'".mysqli_real_escape_string($link, $total_service)."',
																		'".mysqli_real_escape_string($link, $name)."',
																		'".mysqli_real_escape_string($link, $phone)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $address)."')");

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