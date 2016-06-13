<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $you_make_it, $guest_quantity, $friends, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".PARTY_SERVER.";dbname=".PARTY_DATABASE."", PARTY_USER, PARTY_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_you_make_it,
																".$mysql_table."_guest_quantity,
																".$mysql_table."_friends,
																".$mysql_table."_message)
														VALUES (:you_make_it,
																:guest_quantity,
																:friends,
																:message)");

			$smt -> bindParam(":you_make_it", $you_make_it, PDO::PARAM_STR);
			$smt -> bindParam(":guest_quantity", $guest_quantity, PDO::PARAM_STR);
			$smt -> bindParam(":friends", $friends, PDO::PARAM_STR);
			$smt -> bindParam(":message", $message, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId();

			/* Close connection */
			$pdo = null;

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;
	}
?>