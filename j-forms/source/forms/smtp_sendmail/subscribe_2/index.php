<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('subscribe');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe form</title>

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
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="content">

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Subscribe to our newsletter</span>
				</div>

				<!-- start subscribe -->
				<div class="j-row">
					<div class="span6 unit check">
						<label class="label">Receive newsletter:</label>
						<label class="checkbox">
							<input type="checkbox" name="newsletter_group[]" value="every day">
							<i></i>
							Every day
						</label>
						<label class="checkbox">
							<input type="checkbox" name="newsletter_group[]" value="weekly newsletter" checked="">
							<i></i>
							Weekly newsletter
						</label>
						<label class="checkbox">
							<input type="checkbox" name="newsletter_group[]" value="mothly newsletter">
							<i></i>
							Mothly newsletter
						</label>
					</div>
					<div class="span6 unit check">
						<label class="label">News and Articles:</label>
						<label class="checkbox">
							<input type="checkbox" name="news_group[]" value="latest" checked="">
							<i></i>
							Only the latest
						</label>
						<label class="checkbox">
							<input type="checkbox" name="news_group[]" value="most viewed">
							<i></i>
							Most viewed
						</label>
						<label class="checkbox">
							<input type="checkbox" name="news_group[]" value="most rated">
							<i></i>
							Most rated
						</label>
					</div>
				</div>
				<!-- end subscribe -->

				<div class="divider gap-bottom-25"></div>

				<!-- start widget button 130 -->
				<div class="unit">
					<div class="widget right-130">
						<div class="input">
							<input type="email" placeholder="enter your email" name="email">
						</div>
						<button type="submit" class="addon-btn adn-130 adn-right">
							Subscribe
						</button>
					</div>
				</div>
				<!-- end widget button 130 -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

			</div>
			<!-- end /.content -->

		</form>
	</div>
</body>
</html>
