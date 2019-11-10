
		<?php $pageTitle = "404" ?>
<!DOCTYPE html>
<html>

<head>
	<title>Ebonyi State University Staff Secondary School Abakiliki | <?php echo $pageTitle; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Stretch a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link href="../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../css/about.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="../css/team.css" type="text/css" media="all" />
	<link href="../css/contact.css" rel='stylesheet' type='text/css' />
	<link href="../css/font-awesome.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mallanna" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	<link rel="icon" href="logo_name2.png">
</head>

<body>
	<!--Header-->
	<div class="top-bar_sub_w3layouts_agile">
		<a href="../index.php" class="txtLogo">EBONYI STATE UNIVERSITY STAFF SECONDARY SCHOOL ABAKALIKI</a>
		<div class="search">
			<h5><a class="sign" href="#" data-toggle="modal" data-target="#myModal2">Portal Login</a></h5>
			<div class="cd-main-header">
				<ul class="cd-header-buttons">
					<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
				</ul>
				<!-- cd-header-buttons -->
			</div>
			<div id="cd-search" class="cd-search">
				<form action="#" method="post">
					<input name="Search" type="search" placeholder="Click enter after typing...">
				</form>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="header <?php if($pageTitle != "Home"){echo "inner_banner";} ?>" id="home">

		<!--/top-bar-->
		<div class="top-bar">
			<div class="header-nav-agileits">

				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
						<a class="navbar-brand imgLogo" href="../index.php"><img src="logo_name2.png" alt="EBSU SCHOOL LOGO " class="img-responsive" /></a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<nav>
							<ul class="top_nav">
								<li><a href="../index.php" <?php if ($pageTitle == "Home") : ?>
									class="active"
								<?php endif; ?> >Home</a></li>
								<li><a href="../about.php" <?php if ($pageTitle == "About") : ?>
									class="active"
								<?php endif; ?> >About</a></li>
								<li><a href="../events.php" <?php if ($pageTitle == "Events") : ?>
									class="active"
								<?php endif; ?> >Events</a></li>
								<li><a href="../join.php" <?php if ($pageTitle == "Admissions") : ?>
									class="active"
								<?php endif; ?> >Admissions</a></li>
								<li><a href="../contact.php" <?php if ($pageTitle == "Contact") : ?>
									class="active"
								<?php endif; ?> >Contact</a></li>
							</ul>
						</nav>
					</div>
				</nav>

			</div>
		</div>
		<!--//top-bar-->
		<!-- banner-text -->
<!--// banner-text -->
	</div>
	<!--//inner_banner-->
	<!--/short-->
	<div class="services-breadcrumb-w3ls-agile">
		<div class="inner_breadcrumb">

			<ul class="short">
				<li><a href="../index.php">Home</a><span>|</span></li>
				<li><?php if ($pageTitle == "About") {
					echo "About Us";
				}else if ($pageTitle == "Contact") {
					echo "Contact Us";
				}else if ($pageTitle == "App") {
					echo "App";
				}else if ($pageTitle == "Events") {
					echo "Services";
				}else if ($pageTitle == "Admissions") {
					echo "Join now";
				}else if ($pageTitle == "404") {
					echo "404";
				}else{
					#do nothing;
				} ?></li>
			</ul>
		</div>
	</div>
	<!--//short-->
	<!-- //inner_content -->



<!-- Modal1 -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<div class="signin-form profile">

						<div class="login-m_page_img">

							<img src="model.jpg" alt=" " class="img-responsive" />

						</div>
						<div class="login-m_page">
							<h3 class="sign">Sign In</h3>
							<div class="login-form-wthree-agile">
								<form action="#" method="post">
									<input type="text" name="text" placeholder="Reg No / Username" required="">
									<input type="password" name="password" placeholder="Password" required="">
									<div class="input-group mb-3 mul-input" >
										<div class="input-group-prepend" >
											<label class="input-group-text" for="users_category_signin">Select category</label>
										</div>
										<select class="custom-select" id="users_category_signin">
											<option disabled="" selected="">choose...</option>
											<option value="student">Student</option>
											<option value="staff">Staff</option>
											<option value="admin">Admin</option>
										</select>
									</div>
									<div class="tp">
										<input type="submit" value="Sign In">
									</div>
								</form>
							</div>
							
							<p><a href="#" data-toggle="modal" data-target="#myModal3"> Don't have an account? click here</a></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Modal1 -->
	<!-- Modal2 -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<div class="signin-form profile">

						<div class="login-m_page_img">

							<img src="model.jpg" alt=" " class="img-responsive" />

						</div>
						<div class="login-m_page">
							<h3 class="sign">Sign Up</h3>
							<div class="login-form-wthree-agile">
								<form action="#" method="post">
									<div class="input-group mb-3 mul-input" >
										<div class="input-group-prepend" >
											<label class="input-group-text" for="users_category_signup">Select category</label>
										</div>
										<select class="custom-select" id="users_category_signup">
											<option disabled="" selected="">choose...</option>
											<option value="student">Student</option>
											<option value="staff">Staff</option>
										</select>
									</div>
									<div id="imported_form"></div>

										<script>
				var cat_select = document.getElementById('users_category_signup');	
				var imported_form = document.getElementById('imported_form');		
			function fetchForm() {

				if (cat_select.value == "student") {
					var url = '../ajax_fetches/student_signup.php';
				}else{
					var url = '../ajax_fetches/teacher_signup.php';
				}
				

				var xhr = new XMLHttpRequest();
				xhr.open('GET', url, true);

				xhr.onreadystatechange = function () {
					if (xhr.readyState == 4 && xhr.status == 200) {
						imported_form.innerHTML = xhr.responseText;
					}
				}
				xhr.send();
						console.log(xhr.responseText);			
			}

			cat_select.addEventListener('change', fetchForm);
		</script>

								</form>
							</div>
							<p><a>Note that all fields with * is required else optional</a> </p>
							<p><a href="#"> By clicking Sign up, I agree to your terms</a></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- //Modal2 -->


	<!--//Header-->
	<!--/inner_connectent-->
	<div class="banner_bottom">
		<div class="container">

			<div class="error-404">
				<h4>404</h4>
				<p>Oops ! Nothing to See here. Kindly go back to the home page or search futher below.</p>
				<form action="#" method="post">
					<input class="serch" type="search" name="serch" placeholder="Search here" required="">
					<button class="btn1"><i class="fa fa-search" aria-hidden="true"></i></button>
					<div class="clearfix"> </div>
				</form>
				<div class="error social-icons-wthree">
					<h6>Connect with us</h6>
					<a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
					<a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
					<a class="pinterest" href="#"><span class="fa fa-pinterest-p"></span></a>
					<a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>
				</div>
				<a class="b-home" href="../index.php">Back to Home</a>
			</div>
		</div>
	</div>
	<!--//inner_connectent-->

	<!--footer-->
	<div class="contact-footer-w3layouts-agile">

		<div class="bottom-social-agileits-w3ls">
			<div class="container">
				<div class="col-md-8 botttom-nav-w3ls-agileits">
					<ul class="f_links col-md-4">
						<li>
							<a href="../index.php">Home</a>
						</li>
						<li>
							<a href="../about.php">About</a>
						</li>						
						<li>
							<a href="../contact.php">Contact</a>
						</li>
						<li>
							<a href="../events.php">Events</a>
						</li>
						<li>
							<a href="../join.php">Admissions</a>
						</li>
					</ul>
					
					<div class="clearfix"></div>
				</div>
				<div class="col-md-4 social-icons-wthree">
					<h6>Connect with us</h6>
					<a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
					<a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
					<a class="pinterest" href="#"><span class="fa fa-pinterest-p"></span></a>
					<a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>

					
				</div>
				<div class="clearfix"></div>

			</div>
		</div>
		<div class="copy-w3-agileits">
			<h2 class="footer-logo"><a href="../index.php">EBSU <span>Staff Secondary School</span></a></h2>
			<p>© 2019 <?php if (intval(date('Y')) > 2019) {
				echo  " - " . date('Y');
			} ?> EBSU . All Rights Reserved | Design by <a href="tel:07037251749">School Upgraders</a> </p>
			<div class="clearfix"></div>
		</div>
	</div>
	<!--/footer -->

	<!-- js -->
	<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!--search-bar-->
	<script src="../js/main.js"></script>
	<!--//search-bar-->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="../js/move-top.js"></script>
	<script type="text/javascript" src="../js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 900);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
									var defaults = {
							  			containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear' 
							 		};
									*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<script type="text/javascript" src="../js/bootstrap-3.1.1.min.js"></script>


</body>

</html>