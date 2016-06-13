<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('step');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
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
				<p>Contact form</p>
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
						<span>Step 1/2 - Personal info</span>
					</div>

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

					<!-- start way to communicate -->
					<div class="unit check" id="way_to_communicate">
						<div class="inline-group">
							<label class="label">Best way to communicate</label>
							<label class="radio">
								<input type="radio" name="way_to_communicate" value="Email" id="email_to_communicate">
								<i></i>
								Email
							</label>
							<label class="radio">
								<input type="radio" name="way_to_communicate" value="Phone" id="phone_to_communicate">
								<i></i>
								Phone
							</label>
						</div>
					</div>
					<!-- end way to communicate -->

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Step 2/2 - Contact details</span>
					</div>

					<div id="email-step" class="hidden">

						<!-- start email -->
						<div class="unit">
							<label class="label">Your email</label>
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email">
							</div>
						</div>
						<!-- end email -->

						<!-- start message -->
						<div class="unit">
							<label class="label">Comments/Message</label>
							<div class="input">
								<textarea spellcheck="false" name="email_message"></textarea>
							</div>
						</div>
						<!-- end message -->

					</div>

					<div id="phone-step" class="hidden">

						<!-- start phone -->
						<div class="unit">
							<label class="label">Phone/Mobile</label>
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" id="phone" name="phone">
							</div>
						</div>
						<!-- end phone -->

						<!-- start time to call -->
						<div class="unit">
							<label class="label">Time</label>
							<label class="input select">
								<select autocomplete="off" name="time">
									<option value="">call me ...</option>
									<option value="now">now</option>
									<option value="5 min">in 5 minutes</option>
									<option value="10 min">in 10 minutes</option>
									<option value="30 min">in 30 minutes</option>
									<option value="1 hour">in an hour</option>
									<option value="tomorrow">tomorrow</option>
								</select>
								<i></i>
							</label>
						</div>
						<!-- end time to call -->

						<!-- start message -->
						<div class="unit">
							<label class="label">Comments/Message</label>
							<div class="input">
								<textarea spellcheck="false" name="phone_message"></textarea>
							</div>
						</div>
						<!-- end message -->

					</div>

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				</fieldset>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Send</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
