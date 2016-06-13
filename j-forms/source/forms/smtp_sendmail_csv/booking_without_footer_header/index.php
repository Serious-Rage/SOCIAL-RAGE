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

			<div class="content">

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Booking</span>
				</div>

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name" placeholder="Name">
					</div>
				</div>
				<!-- end name -->

				<!-- start email phone -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" placeholder="Email" id="email" name="email">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" placeholder="Phone" id="phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<div class="divider gap-bottom-25"></div>

				<!-- start guests -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="adults">
								<i class="fa fa-male"></i>
							</label>
							<input type="text" placeholder="Adult guests" id="adults" name="adults">
							<span class="tooltip tooltip-left-top">Number of adult guests</span>
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="children">
								<i class="fa fa-female"></i>
							</label>
							<input type="text" placeholder="Children guests" id="children" name="children">
							<span class="tooltip tooltip-left-top">Number of children</span>
						</div>
					</div>
				</div>
				<!-- end guests -->

				<!-- start date -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="date_from">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" placeholder="Check-in date" id="date_from" name="date_from">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="date_to">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" placeholder="Check-out date" id="date_to" name="date_to">
						</div>
					</div>
				</div>
				<!-- end date -->

				<div class="divider gap-bottom-25"></div>

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="message">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea placeholder="Your questions and comments..." spellcheck="false" id="message" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				<button type="submit" class="primary-btn">Booking</button>

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>
