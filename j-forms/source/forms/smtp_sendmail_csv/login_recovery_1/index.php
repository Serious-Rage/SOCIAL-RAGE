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
	<div class="wrapper wrapper-400">

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

				<!-- start login -->
				<div class="j-row">
					<div class="span4">
						<label class="label label-center">Login</label>
					</div>
					<div class="span8 unit">
						<div class="input">
							<label class="icon-right" for="login">
								<i class="fa fa-user"></i>
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
							<span class="hint">
								<a href="#recovery-form" class="link modal-open">Forgot password?</a>
							</span>
						</div>
					</div>
				</div>
				<!-- end password -->

				<!-- start keep logged -->
				<div class="unit">
					<div class="j-row">
						<div class="offset4 span8">
							<label class="checkbox-toggle">
								<input type="checkbox" name="logged" value="true" checked="">
								<i></i>
								Keep me logged in
							</label>
						</div>
					</div>
				</div>
				<!-- end keep logged -->

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