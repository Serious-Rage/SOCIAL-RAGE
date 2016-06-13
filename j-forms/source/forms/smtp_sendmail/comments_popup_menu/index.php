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
	<script src="j-folder/js/additional-methods.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">

	<div class="popup-menu">
		<div class="popup-list">
			<ul>
				<li class="popup-list-open" id="com-popup-menu">
					Leave a comment
					<div class="popup-list-wrapper">
						<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

							<div class="content">

								<!-- start token -->
								<div class="token">
									<?php echo $new_token->get_token();?>
								</div>
								<!-- end token -->

								<!-- start response from server -->
								<div id="response"></div>
								<!-- end response from server -->

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
										<input type="email" id="email" name="email" placeholder="email@domail.com">
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

								<!-- start captcha -->
								<div class="unit">
									<label class="label">Captcha</label>
									<div class="captcha-group">
										<div class="input">
											<label class="icon-right" for="captcha_code">
												<i class="fa fa-unlock-alt"></i>
											</label>
											<input type="text" id="captcha_code" name="captcha_code" placeholder="solve the captcha">
											<span class="tooltip tooltip-right-top">Enter sum of the digits</span>
										</div>
										<label class="captcha" for="captcha_code">
											<img src="j-folder/php/captcha/captcha-image.php" alt="captcha" />
										</label>
									</div>
								</div>
								<!-- end captcha -->

								<button type="submit" class="primary-btn">Post comment</button>

							</div>
							<!-- end /.content -->

						</form>
					</div>
					<!-- /. popup-list-wrapper -->
				</li>
				<!-- /. popup-list-open -->

			</ul>
		</div>
		<!-- end /.popup-list -->
	</div>
	<!-- end /.popup-menu -->

</body>
</html>
