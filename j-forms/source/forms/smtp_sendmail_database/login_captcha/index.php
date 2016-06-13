<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('login');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login form</title>

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
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms-log" novalidate>

			<div class="header">
				<p>Login</p>
			</div>
			<!-- end /.header -->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start login -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="login">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="login" name="login" placeholder="your login...">
					</div>
				</div>
				<!-- end login -->

				<!-- start password -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="password">
							<i class="fa fa-lock"></i>
						</label>
						<input type="password" id="password" name="password" placeholder="your password...">
						<span class="hint">
							<a href="#" class="link">Forgot password?</a>
						</span>
					</div>
				</div>
				<!-- end password -->

				<!-- start captcha -->
				<div class="unit">
					<div class="captcha-group">
						<div class="input">
							<label class="icon-right" for="captcha_code">
								<i class="fa fa-unlock-alt"></i>
							</label>
							<input type="text" id="captcha_code" name="captcha_code">
							<span class="tooltip tooltip-right-top">Enter sum of the digits</span>
						</div>
						<label class="captcha" for="captcha_code">
							<img src="j-folder/php/captcha/captcha-image.php" alt="captcha" />
						</label>
					</div>
				</div>
				<!-- end captcha -->

				<!-- start response from server -->
				<div class="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Sign in</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>