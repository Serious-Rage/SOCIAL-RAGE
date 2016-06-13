<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('order');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order fruits form</title>

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
	<script src="j-folder/js/autoNumeric.js"></script>
	<script src="j-folder/js/jquery.stepper.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Order fruits form</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Select desired fruits</span>
				</div>

				<!-- start  fruit coconut -->
				<div class="j-row fruits-calculation">
					<div class="span5 unit">
						<label class="label">Available fruits</label>
						<div class="input">
							<input type="text" id="first_field" value="Coconut" readonly="" name="first_field">
						</div>
					</div>
					<div class="span3 unit">
						<label class="label">Quantity</label>
						<div class="input quantity-events">
							<input type="text" id="first_field_quantity" name="first_field_quantity">
						</div>
					</div>
					<div class="span2 unit">
						<label class="label">Price</label>
						<div class="input">
							<input type="text" id="first_field_price" value="$ 1.30" readonly="" name="first_field_price">
						</div>
					</div>
					<div class="span2 unit">
						<label class="label">Total</label>
						<div class="input">
							<input type="text" id="first_field_total" readonly="" name="first_field_total">
						</div>
					</div>
				</div>
				<!-- end fruit coconut -->

				<!-- start fruit watermelon -->
				<div class="j-row fruits-calculation">
					<div class="span5 unit">
						<div class="input">
							<input type="text" id="second_field" value="Watermelon" readonly="" name="second_field">
						</div>
					</div>
					<div class="span3 unit">
						<div class="input quantity-events">
							<input type="text" id="second_field_quantity" name="second_field_quantity">
						</div>
					</div>
					<div class="span2 unit">
						<div class="input">
							<input type="text" id="second_field_price" value="$ 3.50" readonly="" name="second_field_price">
						</div>
					</div>
					<div class="span2 unit">
						<div class="input">
							<input type="text" id="second_field_total" readonly="" name="second_field_total">
						</div>
					</div>
				</div>
				<!-- end fruit watermelon -->

				<!-- start additional fruit -->
				<div class="j-row fruits-calculation">
					<div class="span5 unit">
						<div class="input">
							<input type="text" id="third_field" placeholder="add your fruit" name="third_field">
						</div>
					</div>
					<div class="span3 unit">
						<div class="input quantity-events">
							<input type="text" id="third_field_quantity" name="third_field_quantity">
						</div>
					</div>
					<div class="span2 unit">
						<div class="input">
							<input type="text" id="third_field_price" data-a-sign="$ " name="third_field_price">
						</div>
					</div>
					<div class="span2 unit">
						<div class="input">
							<input type="text" id="third_field_total" readonly="" name="third_field_total">
						</div>
					</div>
				</div>
				<!-- end additional fruit -->

				<!-- start totals -->
				<div class="j-row">
					<div class="offset8 span4 unit">
						<div class="input">
							<input type="text" placeholder="Totals" id="field_totals" readonly="" name="field_totals">
						</div>
					</div>
				</div>
				<!-- end totals -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Contact Details</span>
				</div>

				<!-- start name -->
				<div class="unit">
					<label class="label">Name</label>
					<div class="input">
						<label class="icon-right" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name">
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
						<label class="label">Phone</label>
						<div class="input">
							<label class="icon-right" for="phone">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" id="phone" name="phone">
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Order</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>