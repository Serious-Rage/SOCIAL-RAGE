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
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms-log" novalidate>

			<div class="content">

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Sigh in with</span>
				</div>

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start social -->
				<div class="unit">
					<div class="social-btn twitter">
						<i class="fa fa-twitter"></i>
						<button type="button">Sign in with Twitter</button>
					</div>
					<div class="social-btn google-plus">
						<i class="fa fa-google-plus"></i>
						<button type="button">Sign in with Google+</button>
					</div>
					<div class="social-btn facebook">
						<i class="fa fa-facebook"></i>
						<button type="button">Sign in with Facebook</button>
					</div>
				</div>
				<!-- end social -->

				<div class="divider-text gap-top-45 gap-bottom-45">
					<span>Or login</span>
				</div>

				<!-- start login -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="login">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="login" name="login" placeholder="your login...">
					</div>
				</div>
				<!-- end login -->

				<!-- start password -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="password">
							<i class="fa fa-lock"></i>
						</label>
						<input type="password" id="password" name="password" placeholder="your password...">
						<span class="hint">
							<a href="#" class="link">Forgot password?</a>
						</span>
					</div>
				</div>
				<!-- end password -->

				<!-- start keep logged -->
				<div class="unit">
					<label class="checkbox">
						<input type="checkbox" name="logged" value="true" checked="">
						<i></i>
						Keep me logged in
					</label>
				</div>
				<!-- end keep logged -->

				<!-- start response from server -->
				<div class="response"></div>
				<!-- end response from server -->

				<button type="submit" class="primary-btn">Sign in</button>

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>
