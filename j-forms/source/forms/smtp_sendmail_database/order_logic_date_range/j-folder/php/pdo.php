<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $date_from, $date_to, $room_type, $extra_service, $total_room_price,
											$total_extra_service, $totals, $name, $email, $phone) {

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
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (
																".$mysql_table."_date_from,
																".$mysql_table."_date_to,
																".$mysql_table."_room_type,
																".$mysql_table."_extra_service,
																".$mysql_table."_total_room_price,
																".$mysql_table."_total_extra_service,
																".$mysql_table."_totals,
																".$mysql_table."_name,
																".$mysql_table."_email,
																".$mysql_table."_phone)
														VALUES	(:date_from,
																:date_to,
																:room_type,
																:extra_service,
																:total_room_price,
																:total_extra_service,
																:totals,
																:name,
																:email,
																:phone)");

			$smt -> bindParam(":date_from", $date_from, PDO::PARAM_STR);
			$smt -> bindParam(":date_to", $date_to, PDO::PARAM_STR);
			$smt -> bindParam(":room_type", $room_type, PDO::PARAM_STR);
			$smt -> bindParam(":extra_service", $extra_service, PDO::PARAM_STR);
			$smt -> bindParam(":total_room_price", $total_room_price, PDO::PARAM_STR);
			$smt -> bindParam(":total_extra_service", $total_extra_service, PDO::PARAM_STR);
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