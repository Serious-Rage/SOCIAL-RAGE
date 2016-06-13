<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $apartment_type, $bedrooms, $bathrooms, $feets, $feets_price,
											 $totals, $name, $email, $phone) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(REN_SERVER, REN_USER, REN_PASSWORD, REN_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_apartment_type`,
																	`".$mysql_table."_bedrooms`,
																	`".$mysql_table."_bathrooms`,
																	`".$mysql_table."_feets`,
																	`".$mysql_table."_feets_price`,
																	`".$mysql_table."_totals`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_phone`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $apartment_type)."',
																		'".mysqli_real_escape_string($link, $bedrooms)."',
																		'".mysqli_real_escape_string($link, $bathrooms)."',
																		'".mysqli_real_escape_string($link, $feets)."',
																		'".mysqli_real_escape_string($link, $feets_price)."',
																		'".mysqli_real_escape_string($link, $totals)."',
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