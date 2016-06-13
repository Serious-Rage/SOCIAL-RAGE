<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('er_report');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error report</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/additional-methods.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" enctype="multipart/form-data" novalidate>

			<div class="header">
				<p>Error report</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start textarea -->
				<div class="unit">
					<label class="label">The problem is</label>
					<div class="input">
						<textarea placeholder="your message..." spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start email -->
				<div class="unit">
					<label class="label">Email</label>
					<div class="input">
						<label class="icon-left" for="email">
							<i class="fa fa-envelope-o"></i>
						</label>
						<input type="email" placeholder="email@example.com" id="email" name="email">
					</div>
				</div>
				<!-- end email -->

				<!-- start file -->
				<div class="unit">
					<label class="label">Error screenshot</label>
					<label class="input append-small-btn">
						<label class="icon-left" for="file-input">
							<i class="fa fa-download"></i>
						</label>
						<div class="file-button">
							Browse
							<input type="file" name="file" onchange="document.getElementById('file-input').value = this.value;">
						</div>
						<input type="text" id="file-input" readonly="" placeholder="no file selected">
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
				<button type="submit" class="primary-btn">Report</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
