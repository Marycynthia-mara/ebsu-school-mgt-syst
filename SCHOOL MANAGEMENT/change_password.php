<?php 
require_once 'inc/config.inc.php';

	if (isset($_GET['email']) && isset($_GET['token']) && isset($_GET['category']) && isset($_GET['logger'])) {
		if (preg_match('/[a-z0-9_.]+@[a-z0-9]+\.[a-z]{2,6}/i', $_GET["email"])) {
			$email = sanitize_email($_GET['email']);
			$token = sanitize($_GET['token']);
            $category = sanitize($_GET['category']);
            $logger = sanitize($_GET['logger']);

			$sql = "SELECT * FROM psw_confirm WHERE email = '$email' AND token = '$token'";
			$result = execute_select($sql);
			if ($result) {
				$confirm = true;
			}else{
				redirect_to('password.php');
			}
		}else{
			redirect_to('password.php');
		}
	}else{
			redirect_to('password.php');
		}


$pageTitle = "Reset Password" ?>
<?php require_once 'inc/page-header.inc.php'; ?>
<?php require_once 'inc/page-sub-header1.inc.php'; ?>

<?php


if (isset($_SESSION['user_id'])) {
    redirect_to("admin/dashboard.php");
}

if (isset($_POST['submit'])) {
		$result = Reset_password($_POST, $category, $email, $logger);

		if ($result === true) {
			$msg = true;
		}else {
			$errors = $result;
				foreach ($errors as $error) {
					// echo "$error" . "<br>"; 
				} ?>
	
	
				<?php if ($errors) { ?>
			<script>
				var sweetAlert = <?php echo json_encode($errors); ?>;
				var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'LOGIN NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
				var i;
				var timer = 0;
				for(i in sweetAlert){
					sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
				allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
				timer += + 3;
				}
	
		function notifyWithToast(type, message, timer) {
			var duration = timer * 3000;
			const Toast = Swal.mixin({
				toast: true,
				position: 'bottom-start',
				showConfirmButton: true,
				timer: duration
			});
	
			Toast.fire({
				type: type,
				// title: 'Something went wrong',
				html: '<p>' + message + '</p>'
			})
		}
		notifyWithToast('error', allAlerts, timer);
	</script> 
	
			<?php } ?>
		<?php
		}
	}
	?>
	
	<div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" style="display: block; position: static;" aria-hidden="false">
	
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"></button>
	
						<div class="signin-form profile">
	
							<div class="login-m_page_img">
	
								<img src="images/model.jpg" alt=" " class="img-responsive" />
	
							</div>
							<div class="login-m_page">
								<h3 class="sign">Reset Password</h3>
								<div class="login-form-wthree-agile">
									<form action="#" method="post">
										<input type="password" name="password" placeholder="New Password" value="<?php if (isset($password)) {
									              echo $password;
									          } ?>" class=" <?php if (isset($errors['password'])) {
								                echo "error";
								          } ?>">
									

                                    <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php if (isset($confirm_password)) {
									              echo $confirm_password;
									          } ?>" class=" <?php if (isset($errors['confirm_password'])) {
								                echo "error";
								          } ?>">
										
										<div class="tp">
											<input type="submit" value="Reset Password" id="SignIn" name="submit">
										</div>
									</form>
	
								</div>
								
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		   <!--footer-->
		
		<?php require_once 'inc/page-footer.inc.php'; ?>
	
		<!--/footer -->
			<!-- js -->
		<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
		<!-- //js -->
		<!--search-bar-->
		<script src="js/main.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		<script>
			$(function () {
				$("#slider4").responsiveSlides({
					auto: true,
					pager: true,
					nav: true,
					speed: 1000,
					namespace: "callbacks",
					before: function () {
						$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});
			});
		</script>
		<!--//search-bar-->
		<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
		<script src="js/easyResponsiveTabs.js"></script>
		<!--Plug-in Initialisation-->
		<script type="text/javascript">
			$(document).ready(function () {
	
				//Vertical Tab
				$('#parentVerticalTab').easyResponsiveTabs({
					type: 'vertical', //Types: default, vertical, accordion
					width: 'auto', //auto or any width like 600px
					fit: true, // 100% fit in a container
					closed: 'accordion', // Start closed if in accordion view
					tabidentify: 'hor_1', // The tab groups identifier
					activate: function (event) { // Callback function if tab is switched
						var $tab = $(this);
						var $info = $('#nested-tabInfo2');
						var $name = $('span', $info);
						$name.text($tab.text());
						$info.show();
					}
				});
			});
		</script>
		<!--/script-->
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