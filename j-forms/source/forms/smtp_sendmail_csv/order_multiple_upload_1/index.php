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

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" enctype="multipart/form-data" novalidate>

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

				<!-- start name -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="name" placeholder="name" name="name">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="company">
								<i class="fa fa-briefcase"></i>
							</label>
							<input type="text" id="company" placeholder="company" name="company">
						</div>
					</div>
				</div>
				<!-- end name -->

				<!-- start email phone -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="email">
								<i class="fa fa-envelope-o"></i>
							</label>
							<input type="email" placeholder="email" id="email" name="email">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" placeholder="phone/mobile" id="phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<div class="divider gap-bottom-25"></div>

				<div class="j-row">
					<div class="span6 unit"><!-- start service -->
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
						<div class="input">
							<label class="icon-right" for="date_from">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" placeholder="start date" id="date_from" name="date_from">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="date_to">
								<i class="fa fa-calendar"></i>
							</label>
							<input type="text" placeholder="finish date" id="date_to" name="date_to">
						</div>
					</div>
				</div>
				<!-- end date -->

				<div class="divider gap-bottom-25"></div>

				<!-- start textarea -->
				<div class="unit">
					<div class="input">
						<textarea spellcheck="false" placeholder="message or comment" name="message"></textarea>
					</div>
				</div>
				<!-- end textarea -->

				<!-- start files -->
				<div class="j-row">
					<div class="span6 unit">
						<label class="input append-small-btn">
							<div class="file-button">
								Browse
								<input type="file" name="file1" onchange="document.getElementById('file1_input').value = this.value;">
							</div>
							<input type="text" id="file1_input" readonly="" placeholder="no file selected">
							<span class="hint">Only: jpg / png / doc, less 1Mb</span>
						</label>
					</div>
					<div class="span6 unit">
						<label class="input append-small-btn">
							<div class="file-button">
								Browse
								<input type="file" name="file2" onchange="document.getElementById('file2_input').value = this.value;">
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
				<button type="submit" class="primary-btn">Order</button>
				<button type="reset" class="secondary-btn">Reset</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>