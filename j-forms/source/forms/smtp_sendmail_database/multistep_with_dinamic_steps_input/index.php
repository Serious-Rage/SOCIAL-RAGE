<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('camp');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Summer Camp</title>

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
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>

<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms j-multistep" id="j-forms" novalidate>

			<div class="header">
				<p>Summer Camp</p>
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
						<span>Child Information</span>
					</div>

					<!-- start name -->
					<div class="j-row">
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="child_first_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="child_first_name" name="child_first_name" placeholder="first name">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="child_last_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="child_last_name" name="child_last_name" placeholder="last name">
							</div>
						</div>
					</div>
					<!-- end name -->

					<!-- start name_of_school -->
					<div class="unit">
						<div class="input">
							<label class="icon-right" for="name_of_school">
								<i class="fa fa-graduation-cap"></i>
							</label>
							<input type="text" id="name_of_school" name="name_of_school" placeholder="name of school">
						</div>
					</div>
					<!-- end name_of_school -->

					<!-- start grade -->
					<div class="unit">
						<label class="input select">
							<select autocomplete="off" name="grade">
								<option value="">select grade...</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
							<i></i>
						</label>
					</div>
					<!-- end grade -->

					<!-- start age -->
					<div class="unit logic-block-input">
						<div class="input">
							<input type="text" name="age" placeholder="age of the child">
						</div>
						<span class="hint">
							<strong>Note:</strong>
							enter value from <strong>1</strong> to <strong>16</strong> to show parent information
						</span>
					</div>
					<!-- end age -->

				</fieldset>

				<fieldset>

					<div class="divider-text gap-top-20 gap-bottom-45">
						<span>Parent/Guardian Information</span>
					</div>

					<!-- start name -->
					<div class="j-row">
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="parent_first_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="parent_first_name" name="parent_first_name" placeholder="first name">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="parent_last_name">
									<i class="fa fa-user"></i>
								</label>
								<input type="text" id="parent_last_name" name="parent_last_name" placeholder="last name">
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
								<input type="email" id="email" name="email" placeholder="email">
							</div>
						</div>
						<div class="span6 unit">
							<div class="input">
								<label class="icon-right" for="phone">
									<i class="fa fa-phone"></i>
								</label>
								<input type="text" id="phone" name="phone" placeholder="phone/mobile">
							</div>
						</div>
					</div>
					<!-- end email phone -->

					<!-- start message -->
					<div class="unit">
						<div class="input">
							<textarea spellcheck="false" name="message" placeholder="comments/message"></textarea>
						</div>
					</div>
					<!-- end message -->

				</fieldset>

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Submit</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>