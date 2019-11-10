<!--// banner-text -->
	</div>
	<!--//inner_banner-->
	<!--/short-->
	<div class="services-breadcrumb-w3ls-agile">
		<div class="inner_breadcrumb">

			<ul class="short">
				<li><a href="index">Home</a><span>|</span></li>
				<li><?php if ($pageTitle == "About") {
					echo "About Us";
				}else if ($pageTitle == "Contact") {
					echo "Contact Us";
				}else if ($pageTitle == "App") {
					echo "App";
				}else if ($pageTitle == "Events") {
					echo "Events";
				}else if ($pageTitle == "Admissions") {
					echo "Join now";
				}else if ($pageTitle == "404") {
					echo "404";
				}else if ($pageTitle == "Sign In") {
					echo "Portal Login";
				}else if ($pageTitle == "Sign Up") {
					echo "Portal Sign Up";
				}else if ($pageTitle == "Forgot Password") {
					echo "Forgot Password";
				}else if ($pageTitle == "Reset Password") {
					echo "Reset Password";
				}
				else if ($pageTitle == "500") {
					echo "500";
				}else{
					#do nothing;
				} ?></li>
			</ul>
		</div>
	</div>
	<!--//short-->
	<!-- //inner_content -->
