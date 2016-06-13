<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $child_first_name, $child_last_name, $name_of_school, $grade, $age, $parent_first_name,
											$parent_last_name, $email, $phone, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".CAMP_SERVER.";dbname=".CAMP_DATABASE."", CAMP_USER, CAMP_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_child_first_name,
																".$mysql_table."_child_last_name,
																".$mysql_table."_name_of_school,
																".$mysql_table."_grade,
																".$mysql_table."_age,
																".$mysql_table."_parent_first_name,
																".$mysql_table."_parent_last_name,
																".$mysql_table."_email,
																".$mysql_table."_phone,
																".$mysql_table."_message)
														VALUES (:child_first_name,
																:child_last_name,
																:name_of_school,
																:grade,
																:age,
																:parent_first_name,
																:parent_last_name,
																:email,
																:phone,
																:message)");

			$smt -> bindParam(":child_first_name", $child_first_name, PDO::PARAM_STR);
			$smt -> bindParam(":child_last_name", $child_last_name, PDO::PARAM_STR);
			$smt -> bindParam(":name_of_school", $name_of_school, PDO::PARAM_STR);
			$smt -> bindParam(":grade", $grade, PDO::PARAM_STR);
			$smt -> bindParam(":age", $age, PDO::PARAM_STR);
			$smt -> bindParam(":parent_first_name", $parent_first_name, PDO::PARAM_STR);
			$smt -> bindParam(":parent_last_name", $parent_last_name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
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