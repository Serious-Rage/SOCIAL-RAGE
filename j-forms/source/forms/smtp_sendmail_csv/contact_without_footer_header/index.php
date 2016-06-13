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
	<script src="j-folder/js/additional-methods.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Drop us a line</span>
				</div>

				<!-- start name email -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="name" name="name" placeholder="your name...">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" id="email" name="email" placeholder="your email...">
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
						<input type="text" id="subject" name="subject" placeholder="subject...">
					</div>
				</div>
				<!-- end subject -->

				<!-- start textarea -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="textarea">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea spellcheck="false" id="textarea" name="message" placeholder="your message/comment..."></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start captcha -->
				<div class="unit">
					<div class="captcha-group">
						<div class="input">
							<label class="icon-right" for="captcha_code">
								<i class="fa fa-unlock-alt"></i>
							</label>
							<input type="text" id="captcha_code" name="captcha_code" placeholder="solve the captcha...">
							<span class="tooltip tooltip-right-top">Enter sum of the digits</span>
						</div>
						<label class="captcha" for="captcha_code">
							<img src="j-folder/php/captcha/captcha-image.php" alt="captcha" />
						</label>
					</div>
				</div>
				<!-- end captcha -->

				<!-- start copy -->
				<div class="unit">
					<label class="checkbox">
						<input type="checkbox" name="send_copy" value="true">
						<i></i>
						Send me a copy of this message
					</label>
				</div>
				<!-- end copy -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				<button type="submit" class="primary-btn">Send message</button>
				<button type="reset" class="secondary-btn">Reset</button>

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>