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
				<p>Registration</p>
			</div>
			<!-- end /.header -->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name email -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="username">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="username" name="username" placeholder="username">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" id="email" name="email" placeholder="email">
						</div>
					</div>
				</div>
				<!-- end name email -->

				<!-- start password -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="password">
								<i class="fa fa-lock"></i>
							</label>
							<input type="password" id="password" name="password" placeholder="password">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="confirm_password">
								<i class="fa fa-unlock"></i>
							</label>
							<input type="password" id="confirm_password" name="confirm_password" placeholder="confirm password">
						</div>
					</div>
				</div>
				<!-- end confirm password -->

				<div class="divider gap-bottom-25"></div>

				<!-- start name -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<input type="text" placeholder="first name" name="first_name">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<input type="text" placeholder="last name" name="last_name">
						</div>
					</div>
				</div>
				<!-- end name -->

				<!-- start gender -->
				<div class="unit">
					<label class="input select">
						<select name="gender">
							<option value="" selected>select gender...</option>
							<option value="male">male</option>
							<option value="female">female</option>
							<option value="other">other</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end gender -->

				<!-- start captcha -->
				<div class="unit">
					<div class="captcha-group">
						<div class="input">
							<input type="text" id="captcha_code" name="captcha_code" placeholder="solve the captcha">
							<span class="tooltip tooltip-left-top">Enter sum of the digits</span>
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
				<button type="submit" class="primary-btn">Register</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>