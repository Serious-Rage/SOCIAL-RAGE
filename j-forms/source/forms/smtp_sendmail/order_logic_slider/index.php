<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('rental');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Apartment rental form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.ui.min.js"></script>
	<script src="j-folder/js/jquery.ui.touch-punch.min.js"></script>
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
				<p>Apartment Rental</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Apartment Info</span>
				</div>

				<!-- start type of apartment -->
				<div class="unit">
					<label class="label">Select type of apartment</label>
					<label class="input select">
						<select autocomplete="off" name="apartment_type">
							<option value="">---</option>
							<option value="Single Family Home">Single Family Home</option>
							<option value="Condo">Condo</option>
							<option value="Villa / Townhouse">Villa / Townhouse</option>
							<option value="Manufactured Home">Manufactured Home</option>
							<option value="Multi-Family">Multi-Family</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end type of apartment -->

				<!-- start bedrooms bathrooms -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="slider-group">
							Number of bedrooms:
							<label id="bedrooms"></label>
							<input type="hidden" id="bedrooms_input" name="bedrooms" value="1">
						</div>
						<div id="slider_bedrooms"></div>
					</div>
					<div class="span6 unit">
						<div class="slider-group">
							Number of bathrooms:
							<label id="bathrooms"></label>
							<input type="hidden" id="bathrooms_input" name="bathrooms" value="1">
						</div>
						<div id="slider_bathrooms"></div>
					</div>
				</div>
				<!-- end bedrooms bathrooms -->

				<div class="divider gap-bottom-25"></div>

				<!-- start square feets  -->
				<div class="unit">
					<div class="slider-group">
						About how many square feets do you want ( ft<sup>2</sup> ):
						<label id="feets"></label>
						<input type="hidden" id="feets_input" name="feets" value="1000">
					</div>
					<div id="slider_feets"></div>
				</div>
				<!-- end square feets  -->

				<!-- start price  -->
				<div class="unit">
					<div class="slider-group">
						Desired price per each 100 square feet:
						<label id="feets_price"></label>
						<input type="hidden" id="feets_price_input" name="feets_price" value="60">
					</div>
					<div id="slider_feets_price"></div>
				</div>
				<!-- end price -->

				<!-- start total price -->
				<div id="total-price" class="unit hidden">
					<div class="form-details total-price">
						<p>Square Feets: </p><span id="span_total_feets"></span><br >
						<p>Price per 100 Square Feet: </p><span id="span_total_feets_price"></span><br >
						<p>TOTAL: </p><span id="span_totals"></span>
					</div>
				</div>
				<!-- end total price-->

				<!-- start hidden totals -->
				<input type="hidden" name="total_feets" id="input_total_feets">
				<input type="hidden" name="total_feets_price" id="input_total_feets_price">
				<input type="hidden" name="totals" id="input_totals">
				<!-- end hidden totals -->

				<div class="divider-text gap-top-45 gap-bottom-45">
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
				<button type="submit" class="primary-btn">Send</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
