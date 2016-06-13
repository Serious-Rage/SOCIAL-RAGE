<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('party');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Party Invitation</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery-cloneya.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>

<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Party Invitation</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Come and join our party</span>
				</div>

				<!-- start Can you make it -->
				<div class="unit check">
					<label class="label">Can you make it?</label>
					<label class="radio">
						<input type="radio" name="you_make_it" value="Yeah" checked="">
						<i></i>
						Yeah!
					</label>
					<label class="radio">
						<input type="radio" name="you_make_it" value="Maybe">
						<i></i>
						Maybe?
					</label>
					<label class="radio">
						<input type="radio" name="you_make_it" value="I can't">
						<i></i>
						I can't!
					</label>
				</div>
				<!-- end Can you make it -->

				<!-- start How many people are you going to bring? -->
				<div class="unit add-friends">
					<label class="label">How many people are you going to bring?</label>
					<label class="input select">
						<select autocomplete="off" name="guest_quantity">
							<option value="">---</option>
							<option value="just me">Just me</option>
							<option value="me and friends">Me with friends!</option>
						</select>
						<i></i>
					</label>
					<span class="hint">
						<strong>Note:</strong>
						select <strong>"Me with friends!"</strong> to show cloned element
					</span>
				</div>
				<!-- end How many people are you going to bring? -->

				<!-- start cloned friends -->
				<div id="friends" class="hidden">
					<div class="friends">
						<div class="unit toclone-widget-right toclone">
							<div class="input">
								<input type="text" placeholder="friend's name" name="friends[]">
							</div>
							<button type="button" class="primary-btn clone-btn-right clone">
								<i class="fa fa-plus"></i>
							</button>
							<button type="button" class="secondary-btn clone-btn-right delete">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
				<!-- end cloned friends -->

				<div class="divider gap-bottom-25"></div>

				<!-- start message -->
				<div class="unit">
					<label class="label">Comments</label>
					<div class="input">
						<textarea spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Submit</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
