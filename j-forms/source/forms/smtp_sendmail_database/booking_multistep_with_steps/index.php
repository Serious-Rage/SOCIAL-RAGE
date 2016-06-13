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

		<form action="j-folder/php/action.php" method="post" class="j-forms j-multistep" id="j-forms" novalidate>

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

				<!-- start steps -->
				<div class="j-row">
					<div class="span4 step">
						<div class="steps">
							<span>Step 1:</span>
							<p>Personal info</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 2:</span>
							<p>Booking details</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 3:</span>
							<p>Comments</p>
						</div>
					</div>
				</div>
				<!-- end steps -->

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start name -->
					<div class="unit">
						<label class="label">Your name</label>
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
							<label class="label">Your email</label>
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Phone/Mobile</label>
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" id="phone" name="phone">
							</div>
						</div>
					</div>
					<!-- end email phone -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start guests -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Adult guests</label>
							<div class="input">
								<label class="icon-right" for="adults">
									<i class="fa fa-male"></i>
								</label>
								<input type="text" id="adults" name="adults">
								<span class="tooltip tooltip-right-top">Number of adult guests</span>
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Children guests</label>
							<div class="input">
								<label class="icon-right" for="children">
									<i class="fa fa-female"></i>
								</label>
								<input type="text" id="children" name="children">
								<span class="tooltip tooltip-right-top">Number of children</span>
							</div>
						</div>
					</div>
					<!-- end guests -->

					<!-- start date -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Check-in date</label>
							<div class="input">
								<label class="icon-right" for="date_from">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="date_from" name="date_from">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Check-out date</label>
							<div class="input">
								<label class="icon-right" for="date_to">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="date_to" name="date_to">
							</div>
						</div>
					</div>
					<!-- end date -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start message -->
					<div class="unit">
						<label class="label">Comments/Message</label>
						<div class="input">
							<textarea spellcheck="false" name="message"></textarea>
						</div>
					</div>
					<!-- end message -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				</fieldset>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Booking</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>