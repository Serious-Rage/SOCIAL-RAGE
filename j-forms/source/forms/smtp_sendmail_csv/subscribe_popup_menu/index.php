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

	<div class="popup-menu">
		<div class="popup-list">
			<ul>
				<li class="popup-list-open" id="sub-popup-menu">
					Subscribe
					<div class="popup-list-wrapper">
						<form action="j-folder/php/action.php" method="post" class="j-forms" id="j-forms" novalidate>

							<div class="content">

								<!-- start token -->
								<div class="token">
									<?php echo $new_token->get_token();?>
								</div>
								<!-- end token -->

								<!-- start response from server -->
								<div id="response"></div>
								<!-- end response from server -->

								<!-- start subscribe -->
								<div class="unit check">
									<label class="checkbox">
										<input type="checkbox" name="news_group[]" value="news_and_articles" checked="">
										<i></i>
										News and Articles (only the latest)
									</label>
									<label class="checkbox">
										<input type="checkbox" name="news_group[]" value="weekly_news" checked="">
										<i></i>
										Weekly newsletter
									</label>
									<label class="checkbox">
										<input type="checkbox" name="news_group[]" value="monthly_news">
										<i></i>
										Mothly newsletter
									</label>
								</div>
								<!-- end subscribe -->

								<div class="divider gap-bottom-25"></div>

								<!-- start email -->
								<div class="unit">
									<div class="input">
										<label class="icon-right" for="email">
											<i class="fa fa-envelope-o"></i>
										</label>
										<input type="email" placeholder="email@example.com" id="email" name="email">
									</div>
								</div>
								<!-- end email -->

								<button type="submit" class="primary-btn">Subscribe</button>

							</div>
							<!-- end /.content -->

						</form>
					</div>
					<!-- /. popup-list-wrapper -->
				</li>
				<!-- /. popup-list-open -->

			</ul>
		</div>
		<!-- end /.popup-list -->
	</div>
	<!-- end /.popup-menu -->

</body>
</html>