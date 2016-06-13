<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('feedback');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Feedback form</title>

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

	<div class="popup-btm-640">
		<input type="radio" id="popup-input-open" name="popup-btm">
		<input type="radio" id="popup-input-close" name="popup-btm" checked="">
		<div class="popup-btm-wrapper">

			<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

				<!-- start close-popup button -->
				<label class="popup-btm-close" for="popup-input-close">
					<i></i>
				</label>
				<!-- end close-popup button -->

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
								<input type="text" id="name" name="name" placeholder="name">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email" placeholder="email">
							</div>
						</div>
					</div>
					<!-- end name email -->

					<!-- start department -->
					<div class="unit">
						<label class="input select">
							<select name="department">
								<option value="" selected>select department</option>
								<option value="engineering">Engineering</option>
								<option value="technical">Technical</option>
								<option value="sales/marketing">Sales and marketing</option>
								<option value="other">Other</option>
							</select>
							<i></i>
						</label>
					</div>
					<!-- end department -->

					<!-- start textarea -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="textarea">
								<i class="fa fa-file-text-o"></i>
							</label>
							<textarea spellcheck="false" id="textarea" name="message"  placeholder="feedback message..."></textarea>
						</div>
					</div>
					<!-- end textarea -->

					<!-- start response from server -->
					<div id="response"></div>
					<!-- end response from server -->

					<button type="submit" class="primary-btn">Send</button>

				</div>
				<!-- end /.content -->

			</form>
		</div>
		<!-- /. popup-btm-wrapper -->

		<label class="popup-btm-label" for="popup-input-open">Leave a feedback</label>
	</div>
	<!-- end /.popup-btm -->

</body>
</html>
