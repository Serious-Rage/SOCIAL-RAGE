<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('register');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="modal-block">
		Show modal <a href="#registration-form" class="modal-link modal-open">Registration</a> form
	</div>

	<div class="modal-form" id="registration-form">
		<div class="wrapper wrapper-400">

			<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

				<div class="header">
					<p>Registration</p>
					<!-- start close-modal button -->
					<label class="modal-close">
						<i></i>
					</label>
					<!-- end close-modal button -->
				</div>
				<!-- end /.header -->

				<div class="content">

					<!-- start token -->
					<div class="token">
						<?php echo $new_token->get_token();?>
					</div>
					<!-- end token -->

					<!-- start name -->
					<div class="j-row">
						<div class="span4">
							<label class="label label-center">Name</label>
						</div>
						<div class="span8 unit">
							<div class="input">
								<label class="icon-right" for="name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="name" name="name">
							</div>
						</div>
					</div>
					<!-- end name -->

					<!-- start email -->
					<div class="j-row">
						<div class="span4">
							<label class="label label-center">Email</label>
						</div>
						<div class="span8 unit">
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email">
							</div>
						</div>
					</div>
					<!-- end email -->

					<!-- start login -->
					<div class="j-row">
						<div class="span4">
							<label class="label label-center">Login</label>
						</div>
						<div class="span8 unit">
							<div class="input">
								<label class="icon-right" for="login">
									<i class="fa fa-check"></i>
								</label>
								<input type="text" id="login" name="login">
							</div>
						</div>
					</div>
					<!-- end login -->

					<!-- start password -->
					<div class="j-row">
						<div class="span4">
							<label class="label label-center">Password</label>
						</div>
						<div class="span8 unit">
							<div class="input">
								<label class="icon-right" for="password">
									<i class="fa fa-lock"></i>
								</label>
								<input type="password" id="password" name="password">
							</div>
						</div>
					</div>
					<!-- end password -->

					<!-- start terms -->
					<div class="j-row">
						<div class="offset4 span8 unit">
							<label class="checkbox">
								<input type="checkbox" id="check-enable-button">
								<i></i>
								I agree with <a href="#" class="link">Terms of use</a>
							</label>
						</div>
					</div>
					<!-- end terms -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				</div>
				<!-- end /.content -->

				<div class="footer">
				<button type="submit" class="primary-btn disabled-view" id="enable-button" disabled="">Register</button>
				</div>
				<!-- end /.footer -->

			</form>
		</div>
	</div>
</body>
</html>