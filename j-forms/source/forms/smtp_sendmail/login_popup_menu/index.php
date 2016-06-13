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

	<div class="popup-menu">
		<div class="popup-list">
			<ul>
				<li class="popup-list-open" id="log-popup-menu">
					Login form
					<div class="popup-list-wrapper">
						<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

							<div class="content">

								<!-- start token -->
								<div class="token">
									<?php echo $new_token->get_token();?>
								</div>
								<!-- end token -->

								<!-- start response from server -->
								<div id="response"></div>
								<!-- end response from server -->

								<!-- start social -->
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
									</div>
								</div>
								<!-- end social -->

								<div class="divider gap-bottom-25"></div>

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
									</div>
								</div>
								<!-- end password -->

								<button type="submit" class="primary-btn">Sign in</button>

							</div>
							<!-- end /.content -->

						</form>
					</div>
					<!-- /. popup-list-wrapper -->
				</li>
				<!-- /. popup-list-open -->

			</ul>
		</div>
		<!-- end /.popup-list -->
	</div>
	<!-- end /.popup-menu -->

</body>
</html>
