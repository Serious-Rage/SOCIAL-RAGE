<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $email, $department, $subject, $file_name, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".SUG_SERVER.";dbname=".SUG_DATABASE."", SUG_USER, SUG_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_department,
																".$mysql_table."_subject,
																".$mysql_table."_filename,
																".$mysql_table."_info)
														VALUES (:name,
																:email,
																:department,
																:subject,
																:filename,
																:info)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":department", $department, PDO::PARAM_STR);
			$smt -> bindParam(":subject", $subject, PDO::PARAM_STR);
			$smt -> bindParam(":filename", $file_name, PDO::PARAM_STR);
			$smt -> bindParam(":info", $message, PDO::PARAM_STR);
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