<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $notebook, $notebook_model, $notebook_model_action, $software, $courier, $total_service,
								$name, $phone, $email, $address) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".NOTE_SERVER.";dbname=".NOTE_DATABASE."", NOTE_USER, NOTE_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_notebook,
																".$mysql_table."_notebook_model,
																".$mysql_table."_notebook_model_action,
																".$mysql_table."_software,
																".$mysql_table."_courier,
																".$mysql_table."_total_service,
																".$mysql_table."_name,
																".$mysql_table."_phone,
																".$mysql_table."_email,
																".$mysql_table."_address)
														VALUES	(:notebook,
																:notebook_model,
																:notebook_model_action,
																:software,
																:courier,
																:total_service,
																:name,
																:phone,
																:email,
																:address)");

			$smt -> bindParam(":notebook", $notebook, PDO::PARAM_STR);
			$smt -> bindParam(":notebook_model", $notebook_model, PDO::PARAM_STR);
			$smt -> bindParam(":notebook_model_action", $notebook_model_action, PDO::PARAM_STR);
			$smt -> bindParam(":software", $software, PDO::PARAM_STR);
			$smt -> bindParam(":courier", $courier, PDO::PARAM_STR);
			$smt -> bindParam(":total_service", $total_service, PDO::PARAM_STR);
			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":address", $address, PDO::PARAM_STR);
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