<?php $pageTitle = "App" ?>
<?php require_once 'inc/page-header.inc.php'; ?>
<?php require_once 'inc/page-sub-header1.inc.php'; ?>


	<!-- Modal1 -->
	<?php require_once 'inc/sign_in.inc.php'; ?>
	<!-- //Modal1 -->
	<!-- Modal2 -->
	<?php require_once 'inc/sign_up.inc.php'; ?>
	<!-- //Modal2 -->

	<!--//Header-->
	<!--/inner_connectent-->
	<div class="banner_bottom">
		<div class="container">
			<!--/mobile-app -->
			<div class="inner_sec_w3_agileinfo">
				<div class="col-md-6 app-info">
					<h3 class="headerw3">Mobile App</h3>
					<p class="para_vl">Nam arcu mauris, tincidunt sed convallis non, egestas ut lacus. Cras sapien urna, malesuada ut varius consequat, hendrerit
						nisl. Aliquam vestibulum, odio non ullamcorper malesuada.</p>
					<div class="app-devices">
						<a href="#"><img src="images/app.png" alt=""></a>
						<a href="#"><img src="images/app1.png" alt=""></a>
						<div class="clearfix"> </div>
					</div>
					<p class="para_vl"><a href="#">Click here </a>to know more about apps.</p>
				</div>
				<div class="col-md-6 app-img">
					<img src="images/app_mb.png" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"></div>
				<!--//mobile-app -->
			</div>
		</div>
	</div>
	<!--//inner_connectent-->

	<!--footer-->
	
	<?php require_once 'inc/page-footer.inc.php'; ?>

	<!--/footer -->
	
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!--search-bar-->
	<script src="js/main.js"></script>
	<!--//search-bar-->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
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
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>

</html>