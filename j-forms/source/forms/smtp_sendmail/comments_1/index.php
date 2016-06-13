<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('comment');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comment form</title>

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
				<p>Comment form</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="first_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="first_name" name="first_name" placeholder="First name">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-left" for="last_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="last_name" name="last_name" placeholder="Last name">
						</div>
					</div>
				</div>
				<!-- end name -->

				<!-- start email url -->
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
							<label class="icon-left" for="url">
								<i class="fa fa-globe"></i>
							</label>
							<input type="url" placeholder="Website" id="url" name="url">
						</div>
					</div>
				</div>
				<!-- end email url -->

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="message">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea placeholder="Comments" spellcheck="false" id="message" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<!-- start notify me -->
				<div class="unit">
					<label class="checkbox-toggle">
						<input type="checkbox" name="notify" value="I agree" checked="">
						<i></i>
						Notify me about new comments
					</label>
				</div>
				<!-- end notify me -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Post comment</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
