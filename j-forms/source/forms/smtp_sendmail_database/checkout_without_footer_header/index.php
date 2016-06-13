<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('checkout');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Checkout form</title>

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

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Personal info</span>
				</div>

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
						</div>
					</div>
				</div>
				<!-- end email phone -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Address</span>
				</div>

				<!-- start country -->
				<div class="unit">
					<label class="input select">
						<select name="country">
							<option value="" selected="">Select country</option>
							<option value="none">Select country</option>
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

				<!-- start message -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="message">
							<i class="fa fa-file-text-o"></i>
						</label>
						<textarea placeholder="Additional info" spellcheck="false" id="message" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<div class="divider-text gap-top-45 gap-bottom-45">
					<span>Payment info</span>
				</div>

				<!-- start payment -->
				<div class="unit">
					<div class="inline-group">
						<label class="radio">
							<input type="radio" name="payment" value="mastercard" checked="">
							<i></i>
							MasterCard
						</label>
						<label class="radio">
							<input type="radio" name="payment" value="visa">
							<i></i>
							Visa
						</label>
						<label class="radio">
							<input type="radio" name="payment" value="paypal">
							<i></i>
							PayPal
						</label>
						<label class="radio">
							<input type="radio" name="payment" value="check">
							<i></i>
							Check
						</label>
						<label class="radio">
							<input type="radio" name="payment" value="other">
							<i></i>
							Other
						</label>
					</div>
				</div>
				<!-- end payment -->

				<!-- start card info -->
				<div class="unit">
					<div class="input">
						<label class="icon-right" for="card_name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="card_name" placeholder="Name on card" name="card_name">
						<span class="tooltip-image tooltip-right-top"><img src="j-folder/img/name.jpg" /></span>
					</div>
				</div>
				<!-- end card info -->

				<!-- start card number + cvv2 -->
				<div class="j-row">
					<div class="span9 unit">
						<div class="input">
							<label class="icon-right" for="card_number">
								<i class="fa fa-credit-card"></i>
							</label>
							<input type="text" id="card_number" name="card_number" placeholder="Card number">
							<span class="tooltip-image tooltip-right-top"><img src="j-folder/img/number.jpg" /></span>
						</div>
					</div>
					<div class="span3 unit">
						<div class="input">
							<label class="icon-right" for="cvv2">
								<i class="fa fa-unlock"></i>
							</label>
							<input type="text" id="cvv2" name="cvv2" placeholder="CVV2">
							<span class="tooltip-image tooltip-right-top"><img src="j-folder/img/cvv.jpg" /></span>
						</div>
					</div>
				</div>
				<!-- end card number + cvv2 -->

				<!-- start expirity date -->
				<div class="j-row">
					<div class="span4">
						<label class="label label-center">Expires End</label>
					</div>
					<div class="span4 unit">
						<label class="input select">
							<select name="card_month">
								<option value="" selected="">Month</option>
								<option value="01">01 - Jan</option>
								<option value="02">02 - Feb</option>
								<option value="03">03 - Mar</option>
								<option value="04">04 - Apr</option>
								<option value="05">05 - May</option>
								<option value="06">06 - Jun</option>
								<option value="07">07 - Jul</option>
								<option value="08">08 - Aug</option>
								<option value="09">09 - Sep</option>
								<option value="10">10 - Oct</option>
								<option value="11">11 - Nov</option>
								<option value="12">12 - Dec</option>
							</select>
							<span class="tooltip-image tooltip-left-side"><img src="j-folder/img/month.jpg" /></span>
							<i></i>
						</label>
					</div>
					<div class="span4 unit">
						<label class="input select">
							<select name="card_year">
								<option value="" selected="">Year</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
							</select>
							<span class="tooltip-image tooltip-right-side"><img src="j-folder/img/year.jpg" /></span>
							<i></i>
						</label>
					</div>
				</div>
				<!-- end expirity date -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				<button type="submit" class="primary-btn">Continue</button>
				<button type="reset" class="secondary-btn">Reset</button>

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>