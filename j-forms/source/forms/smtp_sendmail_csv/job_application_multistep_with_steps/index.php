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

		<form action="j-folder/php/action.php" method="post" class="j-forms j-multistep" id="j-forms" enctype="multipart/form-data" novalidate>

			<div class="header">
				<p>Job application</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start steps -->
				<div class="j-row">
					<div class="span4 step">
						<div class="steps">
							<span>Step 1:</span>
							<p>Personal info</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 2:</span>
							<p>Address</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 3:</span>
							<p>Additional info</p>
						</div>
					</div>
				</div>
				<!-- end steps -->

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start name -->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">First name</label>
							<div class="input">
								<label class="icon-right" for="first_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="first_name" name="first_name" placeholder="e.g John">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Last name</label>
							<div class="input">
								<label class="icon-right" for="last_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="last_name" name="last_name" placeholder="e.g. Doe">
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
								<input type="email" placeholder="email@domail.com" id="email" name="email">
							</div>
						</div>
						<div class="span6 unit">
							<label class="label">Phone</label>
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" placeholder="phone/mobile" id="phone" name="phone">
								<span class="tooltip tooltip-right-top">Your contact phone number</span>
							</div>
						</div>
					</div>
					<!-- end email phone -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start country -->
					<div class="unit">
						<label class="label">Country</label>
						<label class="input select">
							<select name="country">
								<option value="" selected>select country</option>
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
							<label class="label">City</label>
							<div class="input">
								<label class="icon-right" for="city">
									<i class="fa fa-building-o"></i>
								</label>
								<input type="text" id="city" placeholder="e.g New York" name="city">
							</div>
						</div>
						<div class="span4 unit">
							<label class="label">Post code</label>
							<div class="input">
								<label class="icon-right" for="post">
									<i class="fa fa-bookmark-o"></i>
								</label>
								<input type="text" id="post" placeholder="e.g. 103-3478" name="post">
							</div>
						</div>
					</div>
					<!-- end city post code -->

					<!-- start address -->
					<div class="unit">
						<label class="label">Address</label>
						<div class="input">
							<label class="icon-right" for="address">
								<i class="fa fa-building-o"></i>
							</label>
							<input type="text" id="address" placeholder="e.g. 443 Seventh Avenue, 16th Floor" name="address">
						</div>
					</div>
					<!-- end address -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start position -->
					<div class="unit">
						<label class="label">Position</label>
						<label class="input select">
							<select name="position">
								<option value="" selected>choose desired position</option>
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
						<label class="label">Additional info</label>
						<div class="input">
							<textarea spellcheck="false" name="message"></textarea>
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

				</fieldset>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Send</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>