<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('review');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Review form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/j-forms.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-400">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Review</p>
			</div>
			<!-- end /.header-->

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<!-- start name -->
				<div class="unit">
					<label class="label">Name</label>
					<div class="input">
						<label class="icon-right" for="name">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="name" name="name" placeholder="e.g. John Doe">
					</div>
				</div>
				<!-- end name -->

				<!-- start email-->
				<div class="unit">
					<label class="label">Email</label>
					<div class="input">
						<label class="icon-right" for="email">
							<i class="fa fa-envelope-o"></i>
						</label>
						<input type="email" placeholder="email@domain.com" id="email" name="email">
					</div>
				</div>
				<!-- end email -->

				<!-- start message -->
				<div class="unit">
					<label class="label">Review message</label>
					<div class="input">
						<textarea placeholder="message..." spellcheck="false" name="message"></textarea>
					</div>
				</div>
				<!-- end message -->

				<div class="divider gap-bottom-25"></div>

				<!-- start ratings -->
				<div class="unit">
					<div class="rating-group">
						<label class="label">Product quality</label>
						<div class="ratings">
							<input id="5q" type="radio" name="prod_rating" value="5">
							<label for="5q">
								<i class="fa fa-star"></i>
							</label>
							<input id="4q" type="radio" name="prod_rating" value="4">
							<label for="4q">
								<i class="fa fa-star"></i>
							</label>
							<input id="3q" type="radio" name="prod_rating" value="3">
							<label for="3q">
								<i class="fa fa-star"></i>
							</label>
							<input id="2q" type="radio" name="prod_rating" value="2">
							<label for="2q">
								<i class="fa fa-star"></i>
							</label>
							<input id="1q" type="radio" name="prod_rating" value="1" checked="">
							<label for="1q">
								<i class="fa fa-star"></i>
							</label>
						</div>
					</div>
					<div class="rating-group">
						<label class="label">Service quality</label>
						<div class="ratings">
							<input id="5s" type="radio" name="serv_rating" value="5">
							<label for="5s">
								<i class="fa fa-star"></i>
							</label>
							<input id="4s" type="radio" name="serv_rating" value="4">
							<label for="4s">
								<i class="fa fa-star"></i>
							</label>
							<input id="3s" type="radio" name="serv_rating" value="3">
							<label for="3s">
								<i class="fa fa-star"></i>
							</label>
							<input id="2s" type="radio" name="serv_rating" value="2">
							<label for="2s">
								<i class="fa fa-star"></i>
							</label>
							<input id="1s" type="radio" name="serv_rating" value="1" checked="">
							<label for="1s">
								<i class="fa fa-star"></i>
							</label>
						</div>
					</div>
					<div class="rating-group">
						<label class="label">Support quality</label>
						<div class="ratings">
							<input id="5supp" type="radio" name="supp_rating" value="5">
							<label for="5supp">
								<i class="fa fa-star"></i>
							</label>
							<input id="4supp" type="radio" name="supp_rating" value="4">
							<label for="4supp">
								<i class="fa fa-star"></i>
							</label>
							<input id="3supp" type="radio" name="supp_rating" value="3">
							<label for="3supp">
								<i class="fa fa-star"></i>
							</label>
							<input id="2supp" type="radio" name="supp_rating" value="2">
							<label for="2supp">
								<i class="fa fa-star"></i>
							</label>
							<input id="1supp" type="radio" name="supp_rating" value="1" checked="">
							<label for="1supp">
								<i class="fa fa-star"></i>
							</label>
						</div>
					</div>
				</div>
				<!-- end ratings -->

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
