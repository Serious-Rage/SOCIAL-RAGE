<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $login, $pass, $logged_in) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".LOGIN_SERVER.";dbname=".LOGIN_DATABASE."", LOGIN_USER, LOGIN_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_login,
																".$mysql_table."_password,
																".$mysql_table."_loggedin)
														VALUES (:login,
																:password,
																:loggedin)");
			$smt -> bindParam(":login", $login, PDO::PARAM_STR);
			$smt -> bindParam(":password", $pass, PDO::PARAM_STR);
			$smt -> bindParam(":loggedin", $logged_in, PDO::PARAM_STR);
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