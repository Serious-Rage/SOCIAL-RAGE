<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('job');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Job application form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
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

			<div class="content">

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Job application</span>
				</div>

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="first_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="first_name" name="first_name" placeholder="First name">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="last_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="last_name" name="last_name" placeholder="Last name">
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
							<input type="email" placeholder="Email" id="email" name="email">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" placeholder="Phone" id="phone" name="phone">
							<span class="tooltip tooltip-right-top">Your contact phone number</span>
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<div class="divider gap-bottom-25"></div>

				<!-- start country -->
				<div class="unit">
					<label class="input select">
						<select name="country">
							<option value="" selected="">Select country</option>
							<option value="Australia">Australia</option>
							<option value="Austria">Austria</option>
							<option value="Brazil">Brazil</option>
							<option value="Canada">Canada</option>
							<option value="Germany">Germany</option>
							<option value="India">India</option>
							<option value="Italy">Italy</option>
							<option value="Japan">Japan</option>
							<option value=">Netherlands">Netherlands</option>
							<option value=">New Zealand">New Zealand</option>
							<option value="Philippines">Philippines</option>
							<option value="Portugal">Portugal</option>
							<option value="South Africa">South Africa</option>
							<option value="Spain">Spain</option>
							<option value="Switzerland">Switzerland</option>
							<option value="Sweden">Sweden</option>
							<option value="Turkey">Turkey</option>
							<option value="United Arab Emirates">United Arab Emirates</option>
							<option value="United Kingdom">United Kingdom</option>
							<option value="USA">USA</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end country -->

				<!-- start city post code -->
				<div class="j-row">
					<div class="span8 unit">
						<div class="input">
							<label class="icon-right" for="city">
								<i class="fa fa-building-o"></i>
							</label>
							<input type="text" id="city" placeholder="City" name="city">
						</div>
					</div>
					<div class="span4 unit">
						<div class="input">
							<label class="icon-right" for="post">
								<i class="fa fa-bookmark-o"></i>
							</label>
							<input type="text" id="post" placeholder="Post code" name="post">
						</div>
					</div>
				</div>
				<!-- end city post code -->

				<!-- start address -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="address">
							<i class="fa fa-building-o"></i>
						</label>
						<input type="text" id="address" placeholder="Address" name="address">
					</div>
				</div>
				<!-- end address -->

				<div class="divider gap-bottom-25"></div>

				<!-- start position -->
				<div class="unit">
					<label class="input select">
						<select name="position">
							<option value="" selected>Choose desired position</option>
							<option value="tech lead">Tech Lead</option>
							<option value="product manager">Product Manager</option>
							<option value="senior developer">Senior Developer</option>
							<option value="middle developer">Middle Developer</option>
							<option value="junior developer">Junior Developer</option>
							<option value="QA specialist">QA Specialist</option>
							<option value="system administrator">System Administrator</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end position -->

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<textarea placeholder="Additional info" spellcheck="false" name="message"></textarea>
							<span class="tooltip tooltip-right-top">Any useful information about you</span>
					</div>
				</div>
				<!-- end message -->

				<!-- start files -->
				<div class="j-row">
					<div class="span6 unit">
						<label class="input append-small-btn">
							<div class="file-button">
								Browse
								<input type="file" name="file1" onchange="document.getElementById('file1_input').value = this.value;">
							</div>
							<input type="text" id="file1_input" readonly="" placeholder="add your CV">
							<span class="hint">Only: doc / docx / xls /xlsx, less 1Mb</span>
						</label>
					</div>
					<div class="span6 unit">
						<label class="input append-small-btn">
							<div class="file-button">
								Browse
								<input type="file" name="file2" onchange="document.getElementById('file2_input').value = this.value;">
							</div>
							<input type="text" id="file2_input" readonly="" placeholder="add your CV">
							<span class="hint">Only: doc / docx / xls /xlsx, less 1Mb</span>
						</label>
					</div>
				</div>
				<!-- end files -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				<button type="submit" class="primary-btn">Send</button>
				<button type="reset" class="secondary-btn">Reset</button>

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>
