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
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Comment</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name -->
				<div class="unit">
					<label class="label">Name</label>
					<div class="input">
						<label class="icon-right" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name" placeholder="e.g. John Doe">
					</div>
				</div>
				<!-- end name -->

				<!-- start email  -->
				<div class="unit">
					<label class="label">Email</label>
					<div class="input">
						<label class="icon-right" for="email">
							<i class="fa fa-envelope-o"></i>
						</label>
						<input type="email" placeholder="email@domail.com" id="email" name="email">
					</div>
				</div>
				<!-- end email url -->

				<!-- start message -->
				<div class="unit">
					<label class="label">Comments</label>
					<div class="input">
						<label class="icon-right" for="message">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea placeholder="your comments..." spellcheck="false" id="message" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<!-- start notify me -->
				<div class="unit">
					<label class="checkbox">
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
