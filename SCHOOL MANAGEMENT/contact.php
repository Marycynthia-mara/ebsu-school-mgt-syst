<?php $pageTitle = "Contact" ?>
<?php require_once 'inc/page-header.inc.php'; ?>
<?php require_once 'inc/page-sub-header1.inc.php'; ?>


	<!-- Modal1 -->
	<?php require_once 'inc/sign_in.inc.php'; ?>
	<!-- //Modal1 -->
	<!-- Modal2 -->
	<?php require_once 'inc/sign_up.inc.php'; ?>
	<!-- //Modal2 -->

	<!--//Header-->
	<div class="banner_bottom">
		<div class="container">
			<div class="tittle_head">
				<h3 class="headerw3">Mail Us </h3>
			</div>
			<div class="inner_sec_w3_agileinfo">
				<div class="col-md-8 map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15862.141051240334!2d8.129518!3d6.324603!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x60558a24329d85df!2sEbonyi%20State%20University%20CAS%20Campus!5e0!3m2!1sen!2sng!4v1567984708484!5m2!1sen!2sng"
					    style="border:0"></iframe>
				</div>
				<div class="col-md-4 contact_grids_info">
					<div class="contact_grid" data-aos="flip-up">

						<div class="contact_grid">
						<div class="contact_grid_right">
							<h4> ADDRESS</h4>
							<p>1 Awgu Street, Abakaliki, EBonyi State</p>
							 <a href="mailto:http://ebsustaffschool@gmail.com">ebsustaffschool@gmail.com</a>
							<a href="tel:08114454029">08114454029</a>
						</div>
					</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>


<!-- mail us -->
	<?php
	
	if(isset($_POST['submit'])){
		$result = send_us_a_mail($_POST);
		extract($_POST);
			if($result === true){
				$msg = true;
			} else {
				$errors = $result;
		?>
			<?php if ($errors) { ?>
				<script>
					var sweetAlert = <?php echo json_encode($errors); ?>;
					var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'CONTACT US MESSAGE.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
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


		<?php if ( isset($msg
			)): ?>
			<script>

			function notifyWithToast(type, message) {
				const Toast = Swal.mixin({
					toast: true,
					position: 'bottom-start',
					showConfirmButton: false,
					timer: 10000
				});

				Toast.fire({
					type: type,
					title: message,
				})
			}
			notifyWithToast('success', 'Mail Sent');
		</script> 
		<?php endif; ?>

		<form method="post" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
			
			<div class="mail_form">
				<h3 class="headerw3">Send Us a Message</h3>
				<div class="inner_sec_w3_agileinfo">
					<form action="#" method="post">
						<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Name" type="text" id="input-13" placeholder=" " value="<?php if(isset($_POST['Name'])){echo $_POST['Name'];} ?>"  />
						<label class="input__label input__label--chisato" for="input-13">
							<span class="input__label-content input__label-content--chisato" data-content="Name">Name</span>
						</label>
						</span>
						<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Email" type="email" id="input-14" placeholder=" " value="<?php if(isset($_POST['Email'])){echo $_POST['Email'];} ?>" />
						<label class="input__label input__label--chisato" for="input-14">
							<span class="input__label-content input__label-content--chisato" data-content="Email">Email</span>
						</label>
						</span>
						<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Subject" type="text" id="input-15" placeholder=" " value="<?php if(isset($_POST['Subject'])){echo $_POST['Subject'];} ?>" />
						<label class="input__label input__label--chisato" for="input-15">
							<span class="input__label-content input__label-content--chisato" data-content="Subject">Subject</span>
						</label>
						</span>
						<textarea name="Message" placeholder="Your comment here..." value="<?php if(isset($_POST['Message'])){echo $_POST['Message'];} ?>"></textarea>
						<input type="submit" value="Submit" name="submit">
					</form>

				</div>
			</div>
			
		</form>
<!-- //mail us -->

			<div class="clearfix"> </div>

		</div>
	</div>
	<!-- </div> -->

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