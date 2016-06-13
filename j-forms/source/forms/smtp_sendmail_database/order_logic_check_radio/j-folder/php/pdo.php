<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $cake_size, $filling, $candles, $show_inscription, $inscription, $delivery, $name,
									$phone, $email, $address) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".ORDER_SERVER.";dbname=".ORDER_DATABASE."", ORDER_USER, ORDER_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_cake_size,
																".$mysql_table."_filling,
																".$mysql_table."_candles,
																".$mysql_table."_show_inscription,
																".$mysql_table."_inscription,
																".$mysql_table."_delivery,
																".$mysql_table."_name,
																".$mysql_table."_phone,
																".$mysql_table."_email,
																".$mysql_table."_address)
														VALUES	(:cake_size,
																:filling,
																:candles,
																:show_inscription,
																:inscription,
																:delivery,
																:name,
																:phone,
																:email,
																:address)");

			$smt -> bindParam(":cake_size", $cake_size, PDO::PARAM_STR);
			$smt -> bindParam(":filling", $filling, PDO::PARAM_STR);
			$smt -> bindParam(":candles", $candles, PDO::PARAM_STR);
			$smt -> bindParam(":show_inscription", $show_inscription, PDO::PARAM_STR);
			$smt -> bindParam(":inscription", $inscription, PDO::PARAM_STR);
			$smt -> bindParam(":delivery", $delivery, PDO::PARAM_STR);
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