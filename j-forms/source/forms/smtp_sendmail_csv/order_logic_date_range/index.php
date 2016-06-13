<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('booking');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Booking form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.ui.min.js"></script>
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

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Booking</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Room</span>
				</div>

				<!-- start date -->
				<div class="j-row calculate_date">
					<div class="span6 unit">
						<label class="label">Check-in (mm/dd/yyyy)</label>
						<div class="input">
							<label class="icon-right" for="date_from">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" id="date_from" name="date_from">
						</div>
					</div>
					<div class="span6 unit">
						<label class="label">Check-out (mm/dd/yyyy)</label>
						<div class="input">
							<label class="icon-right" for="date_to">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" id="date_to" name="date_to">
						</div>
					</div>
				</div>
				<!-- end date -->

				<!-- start type of room -->
				<div class="unit calculate_room">
					<label class="label">Select type of a room</label>
					<label class="input select">
						<select autocomplete="off" name="room_type">
							<option value="" data-price="0">---</option>
							<option value="Single Room-$29" data-price="29">Single Room - $29.00</option>
							<option value="Double Room-$39" data-price="39">Double Room - $39.00</option>
							<option value="Family Suite-$55" data-price="55">Family Suite - $55.00</option>
							<option value="Superior Suite-$75" data-price="75">Superior Suite - $75.00</option>
							<option value="Grande Suite-$119" data-price="119">Grande Suite - $119.00</option>
						</select>
						<i></i>
					</label>
					<span class="hint">
						<strong>Note:</strong>
						the price is per one night
					</span>
				</div>
				<!-- end type of room -->

				<div class="divider-text gap-top-45 gap-bottom-45">
					<span>Optional Services</span>
				</div>

				<!-- start Extras -->
				<div class="unit check calculate_extras">
					<label class="checkbox">
						<input type="checkbox" name="extra[]" value="Parking - $5" data-price="5">
						<i></i>
						Parking - $5.00
					</label>
					<label class="checkbox">
						<input type="checkbox" name="extra[]" value="Breakfast - $15" data-price="15">
						<i></i>
						Breakfast - $15.00
					</label>
					<label class="checkbox">
						<input type="checkbox" name="extra[]" value="Premium Internet Access - $2" data-price="2">
						<i></i>
						Premium Internet Access - $2.00
					</label>
					<span class="hint">
						<strong>Note:</strong>
						the cost of the optional services are per each night
					</span>
				</div>
				<!-- end Extras -->

				<!-- start total price -->
				<div id="total-price" class="unit hidden">
					<div class="form-details total-price">
						<p>Room Price: </p><span id="span_total_room"></span><br >
						<p>Optional Services: </p><span id="span_total_extras"></span><br >
						<p>TOTAL: </p><span id="span_totals"></span>
					</div>
				</div>
				<!-- end total price-->

				<!-- start hidden totals -->
				<input type="hidden" name="total_room" id="input_total_room">
				<input type="hidden" name="total_extras" id="input_total_extras">
				<input type="hidden" name="totals" id="input_totals">
				<!-- end hidden totals -->

				<div class="divider-text gap-top-45 gap-bottom-45">
					<span>Contact Details</span>
				</div>

				<!-- start name -->
				<div class="unit">
					<label class="label">Name</label>
					<div class="input">
						<label class="icon-right" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name">
					</div>
				</div>
				<!-- end name -->

				<!-- start email phone -->
				<div class="j-row">
					<div class="span6 unit">
						<label class="label">Email</label>
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" id="email" name="email">
						</div>
					</div>
					<div class="span6 unit">
						<label class="label">Phone</label>
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" id="phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Booking</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>