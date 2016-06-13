<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $date_from, $date_to, $room_type, $extra_service, $total_room_price,
											$total_extra_service, $totals, $name, $email, $phone) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(BOOK_SERVER, BOOK_USER, BOOK_PASSWORD, BOOK_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_date_from`,
																	`".$mysql_table."_date_to`,
																	`".$mysql_table."_room_type`,
																	`".$mysql_table."_extra_service`,
																	`".$mysql_table."_total_room_price`,
																	`".$mysql_table."_total_extra_service`,
																	`".$mysql_table."_totals`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_phone`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $date_from)."',
																		'".mysqli_real_escape_string($link, $date_to)."',
																		'".mysqli_real_escape_string($link, $room_type)."',
																		'".mysqli_real_escape_string($link, $extra_service)."',
																		'".mysqli_real_escape_string($link, $total_room_price)."',
																		'".mysqli_real_escape_string($link, $total_extra_service)."',
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