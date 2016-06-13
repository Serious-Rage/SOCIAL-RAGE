<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $name, $phone, $email, $pickup_date, $return_date, $next_step, $airport, 
											$airline_flight_number, $pickup_address, $drop_off, $message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(TRV_SERVER, TRV_USER, TRV_PASSWORD, TRV_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_pickup_date`,
																	`".$mysql_table."_return_date`,
																	`".$mysql_table."_next_step`,
																	`".$mysql_table."_airport`,
																	`".$mysql_table."_airline_flight_number`,
																	`".$mysql_table."_pickup_address`,
																	`".$mysql_table."_drop_off`,
																	`".$mysql_table."_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $name)."',
																		'".mysqli_real_escape_string($link, $phone)."',
																		'".mysqli_real_escape_string($link, $email)."',
																		'".mysqli_real_escape_string($link, $pickup_date)."',
																		'".mysqli_real_escape_string($link, $return_date)."',
																		'".mysqli_real_escape_string($link, $next_step)."',
																		'".mysqli_real_escape_string($link, $airport)."',
																		'".mysqli_real_escape_string($link, $airline_flight_number)."',
																		'".mysqli_real_escape_string($link, $pickup_address)."',
																		'".mysqli_real_escape_string($link, $drop_off)."',
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