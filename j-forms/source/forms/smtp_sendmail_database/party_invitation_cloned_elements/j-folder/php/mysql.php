<?php

	/* Duplicate information to DB */
	function queryMysqli($mysql_table, $you_make_it, $guest_quantity, $friends, $message) {

		/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$link = mysqli_connect(PARTY_SERVER, PARTY_USER, PARTY_PASSWORD, PARTY_DATABASE);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			return $error_mysql;
		}
		mysqli_set_charset($link, 'utf8');

		/* Query to DB */
		/* Add data to DB */
		$result = mysqli_query($link, "INSERT INTO ".$mysql_table."(`".$mysql_table."_id`,
																	`".$mysql_table."_you_make_it`,
																	`".$mysql_table."_guest_quantity`,
																	`".$mysql_table."_friends`,
																	`".$mysql_table."_message`)
														VALUES (NULL,	'".mysqli_real_escape_string($link, $you_make_it)."',
																		'".mysqli_real_escape_string($link, $guest_quantity)."',
																		'".mysqli_real_escape_string($link, $friends)."',
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