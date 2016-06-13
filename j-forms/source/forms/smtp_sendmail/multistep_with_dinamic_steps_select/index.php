<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('travel');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Travel Reservation</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.ui.min.js"></script>
	<script src="j-folder/js/jquery.ui.timepicker.min.js"></script>
	<script src="j-folder/js/jquery.ui.touch-punch.min.js"></script>
	<script src="j-folder/js/jquery.maskedinput.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>

<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms j-multistep" id="j-forms" novalidate>

			<div class="header">
				<p>Travel Reservation</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Personal info</span>
					</div>

					<!-- start name -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="name" name="name" placeholder="your name">
						</div>
					</div>
					<!-- end name -->

					<!-- start email phone -->
					<div class="j-row">
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email" placeholder="your email">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" id="phone" name="phone" placeholder="phone/mobile">
							</div>
						</div>
					</div>
					<!-- end email phone -->

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Trip Information</span>
					</div>

					<!-- start date and time -->
					<div class="j-row">
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="pickup_date">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="pickup_date" name="pickup_date" placeholder="pickup date">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="return_date">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="return_date" name="return_date" placeholder="return date">
							</div>
						</div>
					</div>
					<!-- end date and time -->

					<!-- start airport_pick_up -->
					<div class="unit logic-block-select">
						<label class="label">Is this an airport pick up?</label>
						<label class="input select">
							<select autocomplete="off" name="next_step_select">
								<option value="">---</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
							<i></i>
						</label>
						<span class="hint">
							<strong>Note:</strong>
							select "<strong>Yes</strong>" to show pick up info
						</span>
					</div>
					<!-- end airport_pick_up -->

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Airport Information</span>
					</div>

					<!-- start airport -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="airport">
								<i class="fa fa-plane"></i>
							</label>
							<input type="text" id="airport" name="airport" placeholder="which airport?">
						</div>
					</div>
					<!-- end airport -->

					<!-- start airline luggage -->
					<div class="j-row">
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="airline_flight_number">
									<i class="fa fa-list-ol"></i>
								</label>
								<input type="text" id="airline_flight_number" name="airline_flight_number" placeholder="airline and flight number">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="number_of_luggage">
									<i class="fa fa-suitcase"></i>
								</label>
								<input type="text" id="number_of_luggage" name="number_of_luggage" placeholder="number of luggage">
							</div>
						</div>
					</div>
					<!-- end airline luggage -->

					<!-- start pickup_address -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="pickup_address">
								<i class="fa fa-building-o"></i>
							</label>
							<input type="text" id="pickup_address" name="pickup_address" placeholder="pickup address">
						</div>
					</div>
					<!-- end pickup_address -->

					<!-- start drop_off -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="drop_off">
								<i class="fa fa-building-o"></i>
							</label>
							<input type="text" id="drop_off" name="drop_off" placeholder="drop off">
						</div>
					</div>
					<!-- end drop_off -->

					<!-- start message -->
					<div class="unit">
						<div class="input">
							<textarea spellcheck="false" name="message" placeholder="comments/message"></textarea>
						</div>
					</div>
					<!-- end message -->

				</fieldset>

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Submit</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
