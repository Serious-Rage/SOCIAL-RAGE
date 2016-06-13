<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $email, $phone, $adults, $children, $date_from, $date_to, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".BOOK_SERVER.";dbname=".BOOK_DATABASE."", BOOK_USER, BOOK_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_phone,
																".$mysql_table."_adults,
																".$mysql_table."_children,
																".$mysql_table."_date_from,
																".$mysql_table."_date_to,
																".$mysql_table."_message)
														VALUES	(:name,
																:email,
																:phone,
																:adults,
																:children,
																:date_from,
																:date_to,
																:message)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
			$smt -> bindParam(":adults", $adults, PDO::PARAM_INT);
			$smt -> bindParam(":children", $children, PDO::PARAM_INT);
			$smt -> bindParam(":date_from", $date_from, PDO::PARAM_STR);
			$smt -> bindParam(":date_to", $date_to, PDO::PARAM_STR);
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