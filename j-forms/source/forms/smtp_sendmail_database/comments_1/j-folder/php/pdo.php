<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $first_name, $last_name, $email, $url, $comments, $notify) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".COM_SERVER.";dbname=".COM_DATABASE."", COM_USER, COM_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_firstname,
																".$mysql_table."_lastname,
																".$mysql_table."_email,
																".$mysql_table."_url,
																".$mysql_table."_comments,
																".$mysql_table."_notify)
														VALUES (:firstname,
																:lastname,
																:email,
																:url,
																:comments,
																:notify)");

			$smt -> bindParam(":firstname", $first_name, PDO::PARAM_STR);
			$smt -> bindParam(":lastname", $last_name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":url", $url, PDO::PARAM_STR);
			$smt -> bindParam(":comments", $comments, PDO::PARAM_STR);
			$smt -> bindParam(":notify", $notify, PDO::PARAM_STR);
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