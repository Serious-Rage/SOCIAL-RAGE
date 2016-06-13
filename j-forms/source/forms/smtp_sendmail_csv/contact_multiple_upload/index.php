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
	<script src="j-folder/js/additional-methods.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" enctype="multipart/form-data" novalidate>

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

				<!-- start name email -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="name" placeholder="your name" name="name">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" id="email" placeholder="your email" name="email">
						</div>
					</div>
				</div>
				<!-- end name email -->

				<!-- start subject -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="subject">
							<i class="fa fa-tag"></i>
						</label>
						<input type="text" id="subject" placeholder="your subject" name="subject">
					</div>
				</div>
				<!-- end subject -->

				<div class="divider gap-bottom-25"></div>

				<!-- start textarea -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="textarea">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea spellcheck="false" id="textarea" placeholder="message or comment" name="message"></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start files -->
				<div class="j-row">
					<div class="span6 unit">
						<label class="input append-small-btn" for="file1">
							<div class="file-button">
								Browse
								<input type="file" id="file1" name="file1" onchange="document.getElementById('file1_input').value = this.value;">
							</div>
							<input type="text" id="file1_input" readonly="" placeholder="no file selected">
							<span class="hint">Only: jpg / png / doc, less 1Mb</span>
						</label>
					</div>
					<div class="span6 unit">
						<label class="input append-small-btn" for="file2">
							<div class="file-button">
								Browse
								<input type="file" id="file2" name="file2" onchange="document.getElementById('file2_input').value = this.value;">
							</div>
							<input type="text" id="file2_input" readonly="" placeholder="no file selected">
							<span class="hint">Only: jpg / png / doc, less 1Mb</span>
						</label>
					</div>
				</div>
				<!-- end files -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Send message</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>