<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $first_field, $first_field_quantity, $first_field_price, $first_field_total, $second_field,
									$second_field_quantity, $second_field_price, $second_field_total, $third_field, $third_field_quantity,
									$third_field_price, $third_field_total, $field_totals, $name, $email, $phone) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(FRUIT_SERVER, FRUIT_USER, FRUIT_PASSWORD, FRUIT_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_first_field`,
																	`".$mysql_table."_first_field_quantity`,
																	`".$mysql_table."_first_field_price`,
																	`".$mysql_table."_first_field_total`,
																	`".$mysql_table."_second_field`,
																	`".$mysql_table."_second_field_quantity`,
																	`".$mysql_table."_second_field_price`,
																	`".$mysql_table."_second_field_total`,
																	`".$mysql_table."_third_field`,
																	`".$mysql_table."_third_field_quantity`,
																	`".$mysql_table."_third_field_price`,
																	`".$mysql_table."_third_field_total`,
																	`".$mysql_table."_field_totals`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_phone`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $first_field)."',
																		'".mysqli_real_escape_string($link, $first_field_quantity)."',
																		'".mysqli_real_escape_string($link, $first_field_price)."',
																		'".mysqli_real_escape_string($link, $first_field_total)."',
																		'".mysqli_real_escape_string($link, $second_field)."',
																		'".mysqli_real_escape_string($link, $second_field_quantity)."',
																		'".mysqli_real_escape_string($link, $second_field_price)."',
																		'".mysqli_real_escape_string($link, $second_field_total)."',
																		'".mysqli_real_escape_string($link, $third_field)."',
																		'".mysqli_real_escape_string($link, $third_field_quantity)."',
																		'".mysqli_real_escape_string($link, $third_field_price)."',
																		'".mysqli_real_escape_string($link, $third_field_total)."',
																		'".mysqli_real_escape_string($link, $field_totals)."',
																		'".mysqli_real_escape_string($link, $name)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $phone)."')");

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