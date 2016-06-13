<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $cake_size, $filling, $candles, $show_inscription, $inscription, $delivery, $name,
									$phone, $email, $address) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(ORDER_SERVER, ORDER_USER, ORDER_PASSWORD, ORDER_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_cake_size`,
																	`".$mysql_table."_filling`,
																	`".$mysql_table."_candles`,
																	`".$mysql_table."_show_inscription`,
																	`".$mysql_table."_inscription`,
																	`".$mysql_table."_delivery`,
																	`".$mysql_table."_name`,
																	`".$mysql_table."_phone`,
																	`".$mysql_table."_email`,
																	`".$mysql_table."_address`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $cake_size)."',
																		'".mysqli_real_escape_string($link, $filling)."',
																		'".mysqli_real_escape_string($link, $candles)."',
																		'".mysqli_real_escape_string($link, $show_inscription)."',
																		'".mysqli_real_escape_string($link, $inscription)."',
																		'".mysqli_real_escape_string($link, $delivery)."',
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