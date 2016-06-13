<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('subscribe');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe form</title>

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
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Subscribe</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start first last name -->
				<div class="j-row">
					<div class="span6 unit">
						<label class="label">First name</label>
						<div class="input">
							<label class="icon-right" for="first_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" placeholder="e.g. John" id="first_name" name="first_name">
						</div>
					</div>
					<div class="span6 unit">
						<label class="label">Last name</label>
						<div class="input">
							<label class="icon-right" for="last_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" placeholder="e.g. Doe" id="last_name" name="last_name">
						</div>
					</div>
				</div>
				<!-- end first last name -->

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
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Subscribe</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>