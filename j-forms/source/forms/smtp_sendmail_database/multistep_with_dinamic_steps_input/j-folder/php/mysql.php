<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $child_first_name, $child_last_name, $name_of_school, $grade, $age, $parent_first_name,
											$parent_last_name, $email, $phone, $message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(CAMP_SERVER, CAMP_USER, CAMP_PASSWORD, CAMP_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_child_first_name`,
																	`".$mysql_table."_child_last_name`,
																	`".$mysql_table."_name_of_school`,
																	`".$mysql_table."_grade`,
																	`".$mysql_table."_age`,
																	`".$mysql_table."_parent_first_name`,
																	`".$mysql_table."_parent_last_name`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $child_first_name)."',
																		'".mysqli_real_escape_string($link, $child_last_name)."',
																		'".mysqli_real_escape_string($link, $name_of_school)."',
																		'".mysqli_real_escape_string($link, $grade)."',
																		'".mysqli_real_escape_string($link, $age)."',
																		'".mysqli_real_escape_string($link, $parent_first_name)."',
																		'".mysqli_real_escape_string($link, $parent_last_name)."',
																		'".mysqli_real_escape_string($link, $phone)."',
																		'".mysqli_real_escape_string($link, $email)."',
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