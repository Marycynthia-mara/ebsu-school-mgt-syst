<?php $pageTitle = "Admissions" ?>
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
			<h3 class="headerw3">Join now</h3>
			<p class="criteria">Candidate must be up to 10 years of age and and must have completed Basic 6 (Primary School) Education. Obtain the admission form from the Bank or Download it below. Fill and and submit the admission form with your most recent passport photograph.
				Sit for the entrance examination and if you pass, proceed to the school for documentation and then go and pay your fees. Come back with receipts and begin schooling.</p>
			<div class="inner_sec_w3_agileinfo">
				<div class="register-form">
					<form action="#" method="post">
						<div class="fields-grid">
							<div class="styled-input">
								<input type="text" placeholder="Your Name" name="Your name" required="">
							</div>
							<div class="styled-input">
								<input id="datepicker" placeholder="Birth Date" name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
								    required="">
							</div>
							<div class="styled-input agile-styled-input-top">
								<select class="category2" required="">
												<option value="">Gender</option>
												<option value="">Female</option>
												<option value="">Male</option>
												<option value="">Other</option>
											</select>
							</div>
							<div class="styled-input">
								<input type="email" placeholder="Your E-mail" name="Email" required="">
							</div>
							<div class="styled-input">
								<input type="text" placeholder="Phone Number" name="Phone" required="">
							</div>
							<div class="styled-input agile-styled-input-top">
								<select class="category2" required="">
												<option value="">Select Course</option>
												<option value="">Web Designing</option>
												<option value="">Web Technology </option>
												<option value="">PC Systems </option>
												<option value="">IT Foundations </option>
												<option value="">HR Management </option>
												<option value="">Modeling </option>
												<option value="">Basic Marketing</option>
											</select>
								<span></span>
							</div>
							<div class="styled-input">
								<div class="agileits_w3layouts_grid">
									<select class="category2" name="category1" required="">
													<option value="">Select Course Time</option>
													<option value="">Hours: 8am - 10am</option>
													<option value="">Hours: 10am - 12pm</option>
													<option value="">Hours: 12pm - 4pm</option>
													<option value="">Hours: 4pm - 7pm</option>
													<option value="">Hours: 7pm - 9pm</option>
												</select>
								</div>
							</div>
							<div class="styled-input">
								<label class="headerw3">Your Address</label>
								<div class="">
									<input type="text" name="name" placeholder="Address" title="Please enter your Address" required="">
								</div>
								<div class="">
									<input type="text" name="name" placeholder="Line" title="Please enter your Line" required="">
								</div>
								<div class="">
									<input type="text" name="name" placeholder="City" title="Please enter your City" required="">
								</div>
								<div class="">
									<input type="text" name="name" placeholder="Zip Code" title="Please enter your Zip code" required="">
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<input type="submit" value="Submit">
					</form>
				</div>
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