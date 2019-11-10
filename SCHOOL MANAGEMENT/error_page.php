
		<?php $pageTitle = "500" ?>
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

			<div class="error-404">
				<h4>500</h4>
                <h3 class="tx-sm-24 tx-normal">Oopps. Authentication error.</h3>
                <p>You cannot verify your account without the appropriate email and token.</p>
					
					<div class="clearfix"> </div>
				</form>
				<!-- <div class="error social-icons-wthree">
					<h6>Connect with us</h6>
					<a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
					<a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
					<a class="pinterest" href="#"><span class="fa fa-pinterest-p"></span></a>
					<a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>
				</div> -->
				<a class="b-home" href="index.php">Back to Home</a>
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