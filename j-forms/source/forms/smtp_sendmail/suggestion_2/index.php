<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('suggestion');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Suggestion form</title>

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
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" enctype="multipart/form-data" novalidate>

			<div class="header">
				<p>Suggestion form</p>
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
					<div class="input">
						<label class="icon-left" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name" placeholder="Name">
					</div>
				</div>
				<!-- end name -->

				<!-- start email -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="email">
							<i class="fa fa-envelope-o"></i>
						</label>
						<input type="email" placeholder="Email" id="email" name="email">
					</div>
				</div>
				<!-- end email -->

				<!-- start country -->
				<div class="unit">
					<label class="input select">
						<select name="department">
							<option value="" selected>Choose your department</option>
							<option value="general">General</option>
							<option value="sales and marketing">Sales and Marketing</option>
							<option value="deposit">Deposit</option>
							<option value="IT and development">IT and Development</option>
							<option value="design and branding">Design and Branding</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end country -->

				<div class="divider gap-bottom-25"></div>

				<!-- start subject -->
				<div class="unit">
					<div class="input">
						<label class="icon-left" for="subject">
							<i class="fa fa-check"></i>
						</label>
						<input type="text" id="subject" name="subject" placeholder="Subject">
					</div>
				</div>
				<!-- end subject -->

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<textarea placeholder="Additional info" spellcheck="false" name="message"></textarea>
						<span class="tooltip tooltip-right-top">Describe your proposal as detailed as possible</span>
					</div>
				</div>
				<!-- end message -->

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

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Send</button>
				<button type="reset" class="secondary-btn">Reset</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
