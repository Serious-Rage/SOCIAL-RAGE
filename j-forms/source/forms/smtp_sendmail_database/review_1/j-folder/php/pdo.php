<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $email, $message, $product, $service, $support) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".REV_SERVER.";dbname=".REV_DATABASE."", REV_USER, REV_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_message,
																".$mysql_table."_product,
																".$mysql_table."_service,
																".$mysql_table."_support)
														VALUES (:name,
																:email,
																:message,
																:product,
																:service,
																:support)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":message", $message, PDO::PARAM_STR);
			$smt -> bindParam(":product", $product, PDO::PARAM_INT);
			$smt -> bindParam(":service", $service, PDO::PARAM_INT);
			$smt -> bindParam(":support", $support, PDO::PARAM_INT);
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