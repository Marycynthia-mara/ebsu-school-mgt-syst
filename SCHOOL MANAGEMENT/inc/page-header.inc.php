<?php require_once 'config.inc.php'; ?>
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

	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/about.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/team.css" type="text/css" media="all" />
	<link href="css/contact.css" rel='stylesheet' type='text/css' />
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mallanna" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="icon" href="images/logo_name2.png">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
	<script src="js/sweetalert2.all.min.js"></script>

	<style>
	@media only screen and (min-width:405px) and (max-width:3204px){
		a.sign_in_nav{
			display:none; 
			color: red;
		}
	}

	@media only screen and (max-width:405px){
		a.sign_in_nav{
			display:block; 
			text-align: center;
			text-transform:uppercase;
			font-size :15px;
			color: #333;
		}
	}
	</style>
</head>

<body>
	<!--Header-->
	<div class="top-bar_sub_w3layouts_agile">
		<a href="index" class="txtLogo">EBONYI STATE UNIVERSITY STAFF SECONDARY SCHOOL ABAKALIKI</a>
		<div class="search" style="width: 220px;">
			<a class="sign" href="signin" style="float:right">Login</a>
			<!-- <a class="sign" href="signup">Sign Up</a> -->
				<!-- <div class="cd-main-header">
					<ul class="cd-header-buttons">
						<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
					</ul>
					cd-header-buttons -->
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
						<a class="navbar-brand imgLogo" href="index"><img src="images/logo_name2.png" alt="EBSU SCHOOL LOGO " class="img-responsive" /></a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<nav>
							<ul class="top_nav">
								<li><a href="index" <?php if ($pageTitle == "Home") : ?>
									class="active"
								<?php endif; ?> >Home</a></li>
								<li><a href="about" <?php if ($pageTitle == "About") : ?>
									class="active"
								<?php endif; ?> >About</a></li>
								<li><a href="events" <?php if ($pageTitle == "Events") : ?>
									class="active"
								<?php endif; ?> >Events</a></li>
								<!-- <li><a href="join" <?php if ($pageTitle == "Admissions") : ?>
									class="active"
								<?php endif; ?> >Admissions</a></li> -->
								<li><a href="contact" <?php if ($pageTitle == "Contact") : ?>
									class="active"
								<?php endif; ?> >Contact</a></li>
								<a class="sign_in_nav"  href="signin">Login</a>
							</ul>
						</nav>
					</div>
				</nav>

			</div>
		</div>
		<!--//top-bar-->
		<!-- banner-text -->