<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('order');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.ui.min.js"></script>
	<script src="j-folder/js/jquery.maskedinput.min.js"></script>
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
				<p>Order service</p>
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
						<span>Step 1/3 - Personal info</span>
					</div>

					<!-- start name -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Your name</label>
							<div class="input">
								<label class="icon-right" for="name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="name" name="name">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Company name</label>
							<div class="input">
								<label class="icon-right" for="company">
									<i class="fa fa-briefcase"></i>
								</label>
								<input type="text" id="company" name="company">
							</div>
						</div>
					</div>
					<!-- end name -->

					<!-- start email phone -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Email</label>
							<div class="input">
								<label class="icon-right" for="email">
									<i class="fa fa-envelope-o"></i>
								</label>
								<input type="email" id="email" name="email">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Phone/Mobile</label>
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" id="phone" name="phone">
							</div>
						</div>
					</div>
					<!-- end email phone -->

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Step 2/3 - Service info</span>
					</div>

					<div class="j-row">
						<div class="span6 unit"><!-- start service -->
							<label class="label">Service</label>
							<label class="input select">
								<select name="service">
									<option value="" selected>interested in</option>
									<option value="design">Design</option>
									<option value="development">Development</option>
									<option value="branding">Branding</option>
									<option value="logo">Logo</option>
								</select>
								<i></i>
							</label>
						</div><!-- end service -->
						<div class="span6 unit"><!-- start budget -->
							<label class="label">Budget</label>
							<label class="input select">
								<select name="budget">
									<option value="" selected>select budget</option>
									<option value="less 1000$">less 1 000$</option>
									<option value="1000-2000$">1 000$ - 2 000$</option>
									<option value="2000-5000$">2 000$ - 5 000$</option>
									<option value="5000-10000$">5 000$ - 10 000$</option>
									<option value="more 10000$">more 10 000$</option>
								</select>
								<i></i>
							</label>
						</div><!-- end budget -->
					</div>

					<!-- start date -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Date from</label>
							<div class="input">
								<label class="icon-right" for="date_from">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="date_from" name="date_from">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Date to</label>
							<div class="input">
								<label class="icon-right" for="date_to">
									<i class="fa fa-calendar"></i>
								</label>
								<input type="text" id="date_to" name="date_to">
							</div>
						</div>
					</div>
					<!-- end date -->

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Step 3/3 - Additional info</span>
					</div>

					<!-- start textarea -->
					<div class="unit">
						<label class="label">Message or comment</label>
						<div class="input">
							<textarea spellcheck="false" name="message"></textarea>
						</div>
					</div>
					<!-- end textarea -->

					<!-- start file -->
					<div class="unit">
						<label class="input append-big-btn">
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
				<button type="submit" class="primary-btn multi-submit-btn">Order</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
