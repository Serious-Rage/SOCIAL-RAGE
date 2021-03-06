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
	<div class="modal-block">
		Show modal <a href="#login-form" class="modal-link modal-open">Login</a> form
	</div>

	<div class="modal-form" id="login-form">
		<div class="wrapper wrapper-400">

			<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

				<div class="header">
					<p>Login</p>
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
							</div>
						</div>
					</div>
					<!-- end password -->

					<!-- start keep logged -->
					<div class="j-row">
						<div class="offset4 span8 unit">
							<label class="checkbox-toggle">
								<input type="checkbox" name="logged" value="true" checked="">
								<i></i>
								Keep me logged in
							</label>
						</div>
					</div>
					<!-- end keep logged -->

					<!-- start response from server -->
					<div id="response"></div>
					<!-- end response from server -->

				</div>
				<!-- end /.content -->

				<div class="footer">
					<button type="submit" class="primary-btn">Sign in</button>
				</div>
				<!-- end /.footer -->

			</form>
		</div>
	</div>

</body>
</html>
