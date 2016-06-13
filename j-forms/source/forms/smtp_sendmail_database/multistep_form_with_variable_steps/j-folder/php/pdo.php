<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $way_to_communicate, $email, $email_message, $phone,
											$time, $phone_message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".STEP_SERVER.";dbname=".STEP_DATABASE."", STEP_USER, STEP_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_way_to_communicate,
																".$mysql_table."_email,
																".$mysql_table."_email_message,
																".$mysql_table."_phone,
																".$mysql_table."_time,
																".$mysql_table."_phone_message)
														VALUES (:name,
																:way_to_communicate,
																:email,
																:email_message,
																:phone,
																:time,
																:phone_message)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":way_to_communicate", $way_to_communicate, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":email_message", $email_message, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
			$smt -> bindParam(":time", $time, PDO::PARAM_STR);
			$smt -> bindParam(":phone_message", $phone_message, PDO::PARAM_STR);
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