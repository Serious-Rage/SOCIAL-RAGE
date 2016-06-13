<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $first_field, $first_field_quantity, $first_field_price, $first_field_total, $second_field,
									$second_field_quantity, $second_field_price, $second_field_total, $third_field, $third_field_quantity,
									$third_field_price, $third_field_total, $field_totals, $name, $email, $phone) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".FRUIT_SERVER.";dbname=".FRUIT_DATABASE."", FRUIT_USER, FRUIT_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_first_field,
																".$mysql_table."_first_field_quantity,
																".$mysql_table."_first_field_price,
																".$mysql_table."_first_field_total,
																".$mysql_table."_second_field,
																".$mysql_table."_second_field_quantity,
																".$mysql_table."_second_field_price,
																".$mysql_table."_second_field_total,
																".$mysql_table."_third_field,
																".$mysql_table."_third_field_quantity,
																".$mysql_table."_third_field_price,
																".$mysql_table."_third_field_total,
																".$mysql_table."_field_totals,
																".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_phone)
														VALUES	(:first_field,
																:first_field_quantity,
																:first_field_price,
																:first_field_total,
																:second_field,
																:second_field_quantity,
																:second_field_price,
																:second_field_total,
																:third_field,
																:third_field_quantity,
																:third_field_price,
																:third_field_total,
																:field_totals,
																:name,
																:email,
																:phone)");

			$smt -> bindParam(":first_field", $first_field, PDO::PARAM_STR);
			$smt -> bindParam(":first_field_quantity", $first_field_quantity, PDO::PARAM_STR);
			$smt -> bindParam(":first_field_price", $first_field_price, PDO::PARAM_STR);
			$smt -> bindParam(":first_field_total", $first_field_total, PDO::PARAM_STR);
			$smt -> bindParam(":second_field", $second_field, PDO::PARAM_STR);
			$smt -> bindParam(":second_field_quantity", $second_field_quantity, PDO::PARAM_STR);
			$smt -> bindParam(":second_field_price", $second_field_price, PDO::PARAM_STR);
			$smt -> bindParam(":second_field_total", $second_field_total, PDO::PARAM_STR);
			$smt -> bindParam(":third_field", $third_field, PDO::PARAM_STR);
			$smt -> bindParam(":third_field_quantity", $third_field_quantity, PDO::PARAM_STR);
			$smt -> bindParam(":third_field_price", $third_field_price, PDO::PARAM_STR);
			$smt -> bindParam(":third_field_total", $third_field_total, PDO::PARAM_STR);
			$smt -> bindParam(":field_totals", $field_totals, PDO::PARAM_STR);
			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
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