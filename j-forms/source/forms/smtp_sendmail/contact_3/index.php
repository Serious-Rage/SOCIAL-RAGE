<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('contact');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact form</title>

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

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Contact form</p>
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
					<div class="span4">
						<label class="label label-center">Your name</label>
					</div>
					<div class="span8 unit">
						<div class="input">
							<input type="text" placeholder="e.g. John Doe" name="name">
						</div>
					</div>
				</div>
				<!-- end name -->

				<!-- start email -->
				<div class="j-row">
					<div class="span4">
						<label class="label label-center">Your email</label>
					</div>
					<div class="span8 unit">
						<div class="input">
							<input type="email" placeholder="email@gmail.com" name="email">
						</div>
					</div>
				</div>
				<!-- end email -->

				<!-- start subject -->
				<div class="j-row">
					<div class="span4">
						<label class="label label-center">Your subject</label>
					</div>
					<div class="span8 unit">
						<div class="input">
							<input type="text" placeholder="subject" name="subject">
						</div>
					</div>
				</div>
				<!-- end subject -->

				<!-- start textarea -->
				<div class="unit">
					<div class="input">
						<textarea placeholder="your message..." spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Send</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
