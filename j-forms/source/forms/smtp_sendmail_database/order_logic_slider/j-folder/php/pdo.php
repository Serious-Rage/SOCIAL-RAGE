<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $apartment_type, $bedrooms, $bathrooms, $feets, $feets_price,
											 $totals, $name, $email, $phone) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".REN_SERVER.";dbname=".REN_DATABASE."", REN_USER, REN_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (
																".$mysql_table."_apartment_type,
																".$mysql_table."_bedrooms,
																".$mysql_table."_bathrooms,
																".$mysql_table."_feets,
																".$mysql_table."_feets_price,
																".$mysql_table."_totals,
																".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_phone)
														VALUES	(:apartment_type,
																:bedrooms,
																:bathrooms,
																:feets,
																:feets_price,
																:totals,
																:name,
																:email,
																:phone)");

			$smt -> bindParam(":apartment_type", $apartment_type, PDO::PARAM_STR);
			$smt -> bindParam(":bedrooms", $bedrooms, PDO::PARAM_STR);
			$smt -> bindParam(":bathrooms", $bathrooms, PDO::PARAM_STR);
			$smt -> bindParam(":feets", $feets, PDO::PARAM_STR);
			$smt -> bindParam(":feets_price", $feets_price, PDO::PARAM_STR);
			$smt -> bindParam(":totals", $totals, PDO::PARAM_STR);
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