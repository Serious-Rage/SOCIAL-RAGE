<?php

	require dirname(__FILE__)."/j-folder-log/php/csrf.php";
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
	<link rel="stylesheet" href="j-folder-log/css/demo.css">
	<link rel="stylesheet" href="j-folder-log/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder-log/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder-log/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder-log/js/jquery.validate.min.js"></script>
	<script src="j-folder-log/js/jquery.form.min.js"></script>
	<script src="j-folder-log/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder-log/php/action.php" method="post" class="j-forms" id="j-forms-log" novalidate>

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

				<div class="j-row">
					<div class="span6">

						<div class="divider-text gap-top-20 gap-bottom-45">
							<span>Sign in with</span>
						</div>

						<!-- start social icons-->
						<div class="unit">
							<div class="social-center">
								<div class="social-icon twitter">
									<i class="fa fa-twitter"></i>
									<button type="button"></button>
								</div>
								<div class="social-icon google-plus">
									<i class="fa fa-google-plus"></i>
									<button type="button"></button>
								</div>
								<div class="social-icon facebook">
									<i class="fa fa-facebook"></i>
									<button type="button"></button>
								</div>
								<div class="social-icon linkedin">
									<i class="fa fa-linkedin"></i>
									<button type="button"></button>
								</div>
							</div>
						</div>
						<!-- end social icons-->

					</div>
					<!-- end /.span6 -->

					<div class="span6">

						<div class="divider-text gap-top-20 gap-bottom-45">
							<span>Or login</span>
						</div>

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
									<a href="#recovery-form" class="link modal-open">Forgot password?</a>
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

					</div>
					<!-- end /.span6 -->
				</div>
				<!-- end /.j-row -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Sign in</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>

	<!-- start password recovery form -->
	<div class="modal-form" id="recovery-form">
		<div class="wrapper wrapper-640">

			<form action="j-folder-rec/php/action.php" method="post" class="j-forms" id="j-forms-rec" novalidate>

				<div class="header">
					<p>Password recovery</p>
					<!-- start close-modal button -->
					<label class="modal-close">
						<i></i>
					</label>
					<!-- end close-modal button -->
				</div>
				<!-- end /.header-->

				<div class="content">

					<!-- start email -->
					<div class="unit">
						<label class="label">Email</label>
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" placeholder="email@example.com" id="email" name="email">
						</div>
					</div>
					<!-- end email -->

					<!-- start response from server -->
					<div class="response"></div>
					<!-- end response from server -->

				</div>
				<!-- end /.content -->

				<div class="footer">
					<button type="submit" class="primary-btn">Send</button>
				</div>
				<!-- end /.footer -->

			</form>
		</div>
	</div>
	<!-- end password recovery form -->
</body>
</html>
