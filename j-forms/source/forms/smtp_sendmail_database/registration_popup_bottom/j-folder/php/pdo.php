<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $user_name, $email, $pass, $first_name, $last_name) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_username,
																".$mysql_table."_email,
																".$mysql_table."_password,
																".$mysql_table."_firstname,
																".$mysql_table."_lastname)
														VALUES (:username,
																:email,
																:password,
																:firstname,
																:lastname)");

			$smt -> bindParam(":username", $user_name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":password", $pass, PDO::PARAM_STR);
			$smt -> bindParam(":firstname", $first_name, PDO::PARAM_STR);
			$smt -> bindParam(":lastname", $last_name, PDO::PARAM_STR);
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