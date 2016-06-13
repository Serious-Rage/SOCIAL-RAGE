<?php

	/* Duplicate information to DB */
	function queryPdo($mysql_table, $sender_name, $sender_email, $sender_phone, $recipient_name, $recipient_email,
									$subject, $message) {

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("mysql:host=".CON_SERVER.";dbname=".CON_DATABASE."", CON_USER, CON_PASSWORD,
							array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (".$mysql_table."_sendername,
																".$mysql_table."_senderemail,
																".$mysql_table."_senderphone,
																".$mysql_table."_recipientname,
																".$mysql_table."_recipientemail,
																".$mysql_table."_subject,
																".$mysql_table."_message)
														VALUES (:sendername,
																:senderemail,
																:senderphone,
																:recipientname,
																:recipientemail,
																:subject,
																:message)");

			$smt -> bindParam(":sendername", $sender_name, PDO::PARAM_STR);
			$smt -> bindParam(":senderemail", $sender_email, PDO::PARAM_STR);
			$smt -> bindParam(":senderphone", $sender_phone, PDO::PARAM_STR);
			$smt -> bindParam(":recipientname", $recipient_name, PDO::PARAM_STR);
			$smt -> bindParam(":recipientemail", $recipient_email, PDO::PARAM_STR);
			$smt -> bindParam(":subject", $subject, PDO::PARAM_STR);
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