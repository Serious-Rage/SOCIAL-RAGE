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
				<p>Contact form</p>
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
							<p>Sender's info</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 2:</span>
							<p>Recipient's info</p>
						</div>
					</div>
					<div class="span4 step">
						<div class="steps">
							<span>Step 3:</span>
							<p>Message</p>
						</div>
					</div>
				</div>
				<!-- end steps -->

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start name -->
					<div class="unit">
						<label class="label">Sender's name</label>
						<div class="input">
							<label class="icon-right" for="sender_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="sender_name" name="sender_name" placeholder="your name...">
						</div>
					</div>
					<!-- end name -->

					<!-- start email-from phone-->
					<div class="j-row">
						<div class="span6 unit">
							<label class="label">Sender's department</label>
							<label class="input select">
								<select name="sender_email">
									<option value="" selected>select department...</option>
									<option value="general@domain.com">General -- general@domain.com</option>
									<option value="it@domain.com">IT -- it@domain.com</option>
									<option value="hr@domain.com">HR -- hr@domain.com</option>
									<option value="sales@domain.com">Sales -- sales@domain.com</option>
									<option value="support@domain.com">Support -- support@domain.com</option>
									<option value="market@domain.com">Marketing -- market@domain.com</option>
								</select>
								<i></i>
							</label>
						</div>
						<div class="span6 unit">
							<label class="label">Sender's phone</label>
							<label class="input select">
								<select name="sender_phone">
									<option value="" selected>select phone...</option>
									<option value="(123)-123-555100">General -- (123)-123-555100</option>
									<option value="(123)-123-555101">IT -- (123)-123-555101</option>
									<option value="(123)-123-555102">HR -- (123)-123-555102</option>
									<option value="(123)-123-555103">Sales -- (123)-123-555103</option>
									<option value="(123)-123-555104">Support -- (123)-123-555104</option>
									<option value="(123)-123-555105">Marketing -- (123)-123-555105</option>
								</select>
								<i></i>
							</label>
						</div>
					</div>
					<!-- end email-from phone -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start name-to -->
					<div class="unit">
						<label class="label">Recipient's name</label>
						<div class="input">
							<label class="icon-right" for="recipient_name">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="recipient_name" name="recipient_name" placeholder="e.g. John Doe">
						</div>
					</div>
					<!-- end name-to -->

					<!-- start email-to -->
					<div class="unit">
						<label class="label">Recipient's department</label>
						<label class="input select">
							<select name="recipient_email">
								<option value="" selected>select department...</option>
								<option value="general@domain.com">General -- general@domain.com</option>
								<option value="it@domain.com">IT -- it@domain.com</option>
								<option value="hr@domain.com">HR -- hr@domain.com</option>
								<option value="sales@domain.com">Sales -- sales@domain.com</option>
								<option value="support@domain.com">Support -- support@domain.com</option>
								<option value="market@domain.com">Marketing -- market@domain.com</option>
							</select>
							<i></i>
						</label>
					</div>
					<!-- end email-to -->

				</fieldset>

				<fieldset>

					<div class="divider gap-bottom-25"></div>

					<!-- start subject -->
					<div class="unit">
						<label class="label">Subject</label>
						<div class="input">
							<label class="icon-right" for="subject">
								<i class="fa fa-tag"></i>
							</label>
							<input type="text" id="subject" name="subject" placeholder="your subject...">
						</div>
					</div>
					<!-- end subject -->

					<!-- start textarea -->
					<div class="unit">
						<label class="label">Message</label>
						<div class="input">
							<textarea spellcheck="false" name="message" placeholder="message or comment..."></textarea>
							<span class="tooltip tooltip-right-top">Describe your proposal as detailed as possible</span>
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

				</fieldset>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn multi-submit-btn">Send message</button>
				<button type="button" class="primary-btn multi-next-btn">Next</button>
				<button type="button" class="secondary-btn multi-prev-btn">Back</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
