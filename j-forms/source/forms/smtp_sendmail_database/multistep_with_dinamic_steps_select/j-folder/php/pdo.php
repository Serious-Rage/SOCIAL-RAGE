<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $name, $phone, $email, $pickup_date, $return_date, $next_step, $airport, 
											$airline_flight_number, $pickup_address, $drop_off, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".TRV_SERVER.";dbname=".TRV_DATABASE."", TRV_USER, TRV_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_name,
																".$mysql_table."_phone,
																".$mysql_table."_email,
																".$mysql_table."_pickup_date,
																".$mysql_table."_return_date,
																".$mysql_table."_next_step,
																".$mysql_table."_airport,
																".$mysql_table."_airline_flight_number,
																".$mysql_table."_pickup_address,
																".$mysql_table."_drop_off,
																".$mysql_table."_message)
														VALUES (:name,
																:phone,
																:email,
																:pickup_date,
																:return_date,
																:next_step,
																:airport,
																:airline_flight_number,
																:pickup_address,
																:drop_off,
																:message)");

			$smt -> bindParam(":name", $name, PDO::PARAM_STR);
			$smt -> bindParam(":phone", $phone, PDO::PARAM_STR);
			$smt -> bindParam(":email", $email, PDO::PARAM_STR);
			$smt -> bindParam(":pickup_date", $pickup_date, PDO::PARAM_STR);
			$smt -> bindParam(":return_date", $return_date, PDO::PARAM_STR);
			$smt -> bindParam(":next_step", $next_step, PDO::PARAM_STR);
			$smt -> bindParam(":airport", $airport, PDO::PARAM_STR);
			$smt -> bindParam(":airline_flight_number", $airline_flight_number, PDO::PARAM_STR);
			$smt -> bindParam(":pickup_address", $pickup_address, PDO::PARAM_STR);
			$smt -> bindParam(":drop_off", $drop_off, PDO::PARAM_STR);
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