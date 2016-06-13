<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('feedback');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Feedback form</title>

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

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Feedback form</p>
			</div>
			<!-- end /.header-->

			<div class="content">

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

				<!-- start email phone-->
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

				<!-- start department -->
				<div class="unit">
					<label class="input select">
						<select name="department">
							<option value="" selected>Select department</option>
							<option value="engineering">Engineering</option>
							<option value="technical">Technical</option>
							<option value="sales/marketing">Sales and marketing</option>
							<option value="other">Other</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end department -->

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<textarea placeholder="Your feedback goes here..." spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Send</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
