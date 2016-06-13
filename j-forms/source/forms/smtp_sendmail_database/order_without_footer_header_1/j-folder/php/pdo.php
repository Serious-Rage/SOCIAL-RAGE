<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $company, $email, $phone, $service, $budget, $date_from, $date_to,
								$file_name, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".SER_SERVER.";dbname=".SER_DATABASE."", SER_USER, SER_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_company,
																".$mysql_table."_email,
																".$mysql_table."_phone,
																".$mysql_table."_service,
																".$mysql_table."_budget,
																".$mysql_table."_datefrom,
																".$mysql_table."_dateto,
																".$mysql_table."_filename,
																".$mysql_table."_message)
														VALUES (:name,
																:company,
																:email,
																:phone,
																:service,
																:budget,
																:datefrom,
																:dateto,
																:filename,
																:message)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":company", $company, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
			$smt -> bindParam(":service", $service, PDO::PARAM_STR);
			$smt -> bindParam(":budget", $budget, PDO::PARAM_STR);
			$smt -> bindParam(":datefrom", $date_from, PDO::PARAM_STR);
			$smt -> bindParam(":dateto", $date_to, PDO::PARAM_STR);
			$smt -> bindParam(":filename", $file_name, PDO::PARAM_STR);
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