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

		<form action="j-folder/php/action.php" method="post" class="j-forms j-multistep" id="j-forms" enctype="multipart/form-data" novalidate>

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

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Step 1/2 - Personal info</span>
					</div>

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

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Step 2/2 - Message</span>
					</div>

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

					<!-- start file -->
					<div class="unit">
						<label class="input append-big-btn">
							<label class="icon-left" for="file_input">
								<i class="fa fa-download"></i>
							</label>
							<div class="file-button">
								Browse
								<input type="file" name="file" onchange="document.getElementById('file_input').value = this.value;">
							</div>
							<input type="text" id="file_input" readonly="" placeholder="no file selected">
							<span class="hint">Only: jpg / png / doc, less 1Mb</span>
						</label>
					</div>
					<!-- end file -->

					<!-- start response from server -->
					<div id="response"></div>
					<!-- end response from server -->

				</fieldset>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Send message</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
