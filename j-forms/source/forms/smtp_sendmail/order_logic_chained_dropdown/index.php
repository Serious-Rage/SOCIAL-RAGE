<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('notebook');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Notebook service</title>

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

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Service</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>How can we help you?</span>
				</div>

				<!-- start notebook -->
				<div class="unit">
					<label class="label">Notebook</label>
					<label class="input select">
						<select id="notebook" name="notebook">
							<option value="">select a type...</option>
							<option value="Acer">Acer</option>
							<option value="Asus">Asus</option>
							<option value="Apple">Apple</option>
							<option value="Lenovo">Lenovo</option>
							<option value="Samsung">Samsung</option>
						</select>
					</label>
				</div>
				<!-- end notebook -->

				<!-- start model -->
				<div class="unit">
					<label class="label">Model</label>
					<label class="input select">
						<select id="notebook_model" name="notebook_model">
							<option value="">select a model...</option>
						</select>
					</label>
				</div>
				<!-- end model -->

				<!-- start type of work -->
				<div class="unit">
					<label class="label">Type of work</label>
					<label class="input multiple-select">
						<select id="notebook_model_action" multiple="" name="notebook_model_action[]">
							<option value="">select an action...</option>
						</select>
					</label>
				</div>
				<!-- end type of work -->

				<!-- start additional service -->
				<div class="unit">
					<div class="j-row additional-service">
						<label class="label">Additional Service</label>
						<div class="span6">
							<label class="checkbox">
								<input type="checkbox" name="software" value="software-$15" data-price="15">
								<i></i>
								Update all my software + $15.00
							</label>
						</div>
						<div class="span6">
							<label class="checkbox">
								<input type="checkbox" name="courier" value="courier-$15" data-price="15" id="courier">
								<i></i>
								Send me a courier + $15.00
							</label>
						</div>
					</div>
				</div>
				<!-- end additional service -->

				<!-- start total service price -->
				<div id="total_service_price" class="unit hidden">
					<div class="form-details total-price">
						<p>Total Service Price: </p><span></span>
					</div>
				</div>
				<!-- end total service price -->

				<!-- start hidden total service -->
				<input type="hidden" name="total_service" id="total_service">
				<!-- end hidden total service -->

				<div class="divider-text gap-top-45 gap-bottom-45">
					<span>Contact Details</span>
				</div>

				<!-- start name -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" placeholder="Name" name="name">
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
							<input type="email" id="email" placeholder="Email" name="email">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" id="phone" placeholder="Phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<!-- start address -->
				<div class="unit hidden" id="courier_address">
					<div class="input">
						<label class="icon-right" for="address">
							<i class="fa fa-building-o"></i>
						</label>
						<input type="text" id="address" placeholder="Address" name="address">
					</div>
				</div>
				<!-- end address -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Send</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
