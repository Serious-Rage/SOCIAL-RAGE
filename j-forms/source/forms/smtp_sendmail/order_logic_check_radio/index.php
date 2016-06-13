<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('order');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order cake form</title>

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
				<i class="fa fa-birthday-cake"></i>
				<p>Order cake form</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Make your cake!</span>
				</div>

				<!-- start size of the cake -->
				<div class="unit check cake-size">
					<label class="label">Size of the Cake</label>
					<div class="j-row">
						<div class="span6">
							<label class="radio">
								<input type="radio" name="cake_size" value="round-6" data-price="20">
								<i></i>
								round 6" - serves 8 people ($20)
							</label>
							<label class="radio">
								<input type="radio" name="cake_size" value="round-8" data-price="25">
								<i></i>
								round 8" - serves 12 people ($25)
							</label>
						</div>
						<div class="span6">
							<label class="radio">
								<input type="radio" name="cake_size" value="square-6" data-price="20">
								<i></i>
								square 6" - serves 8 people ($20)
							</label>
							<label class="radio">
								<input type="radio" name="cake_size" value="square-8" data-price="25">
								<i></i>
								square 8" - serves 12 people ($25)
							</label>
						</div>
					</div>
				</div>
				<!-- end size of the cake -->

				<div class="divider gap-bottom-25"></div>

				<!-- start filling of the cake -->
				<div class="unit filling">
					<label class="label">Filling</label>
					<label class="input multiple-select">
						<select autocomplete="off" name="filling[]" multiple="">
							<option value="" data-price="0">select filling</option>
							<option value="lemon-5$" data-price="5">Lemon + $5.00</option>
							<option value="custard-5$" data-price="5">Custard + $5.00</option>
							<option value="fudge-7$" data-price="7">Fudge + $7.00</option>
							<option value="mocha-8$" data-price="8">Mocha + $8.00</option>
							<option value="raspberry-10$" data-price="10">Raspberry + $10.00</option>
							<option value="pineapple-5$" data-price="5">Pineapple + $5.00</option>
							<option value="dobash-9$" data-price="9">Dobash + $9.00</option>
							<option value="mint-5$" data-price="5">Mint + $5.00</option>
							<option value="cherry-$5" data-price="5">Cherry + $5.00</option>
							<option value="apricot-8$" data-price="8">Apricot + $8.00</option>
							<option value="buttercream-7$" data-price="7">Buttercream + $7.00</option>
							<option value="chocolate mousse-12$" data-price="12">Chocolate Mousse + $12.00</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end filling of the cake -->

				<div class="divider gap-bottom-25"></div>

				<!-- start additional things for the cake -->
				<div class="unit lovely-things">
					<label class="label">Lovely Things</label>
					<label class="checkbox">
						<input type="checkbox" name="candles" value="candles-5$" data-price="5">
						<i></i>
						Include candles + $5.00
					</label>
					<label class="checkbox">
						<input type="checkbox" name="show-inscription" value="inscription-20$" data-price="20" id="show-inscription">
						<i></i>
						Include inscription + $20.00
					</label>
					<div class="input hidden" id="inscription">
						<input type="text" placeholder="enter inscription" name="inscription">
					</div>
				</div>
				<!-- end additional things for the cake -->

				<div class="divider gap-bottom-25"></div>

				<!-- start Pick Up or Delivery -->
				<div class="unit delivery" id="delivery">
					<label class="label">Pick Up or Delivery</label>
					<label class="input select">
						<select autocomplete="off" name="delivery">
							<option value="Pick Up" data-price="0">Pick Up</option>
							<option value="Delivery-5$" data-price="5">Delivery + $5.00</option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end Pick Up or Delivery -->

				<!-- start total price of the cake -->
				<div id="total-cake-price" class="unit hidden">
					<div class="form-details total-price">
						<p>Total Cake Price: </p><span></span>
					</div>
				</div>
				<!-- end total price of the cake-->

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
				<div class="unit hidden" id="delivery-address">
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
				<button type="submit" class="primary-btn">I want this cake!</button>
			</div>
			<!-- end /.footer -->

		</form>
	</div>
</body>
</html>
