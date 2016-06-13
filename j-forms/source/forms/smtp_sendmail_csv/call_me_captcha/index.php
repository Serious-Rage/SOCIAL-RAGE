<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('call');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Callback form</title>

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
	<script src="j-folder/js/additional-methods.min.js"></script>
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
				<p>Callback form</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name phone-->
				<div class="j-row">
					<div class="span6 unit">
						<label class="label">Name</label>
						<div class="input">
							<label class="icon-right" for="name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" placeholder="e.g. John Doe" id="name" name="name">
						</div>
					</div>
					<div class="span6 unit">
						<label class="label">Phone</label>
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" placeholder="telephone or mobile" id="phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end name phone -->

				<!-- start time to call -->
				<div class="unit">
					<label class="label">Time</label>
					<label class="input select">
						<select autocomplete="off" name="time">
							<option value="none" selected="" disabled="">call me ...</option>
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

				<!-- start textarea -->
				<div class="unit">
					<label class="label">Additional information</label>
					<div class="input">
						<textarea spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start captcha -->
				<div class="unit">
					<label class="label">Captcha</label>
					<div class="captcha-group">
						<div class="input">
							<label class="icon-right" for="code">
								<i class="fa fa-unlock-alt"></i>
							</label>
							<input type="text" id="captcha_code" name="captcha_code" placeholder="solve the captcha">
							<span class="tooltip tooltip-right-top">Enter sum of the digits</span>
						</div>
						<label class="captcha" for="captcha_code">
							<img src="j-folder/php/captcha/captcha-image.php" alt="captcha" />
						</label>
					</div>
				</div>
				<!-- end captcha -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Call me</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
