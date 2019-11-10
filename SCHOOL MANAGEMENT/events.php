<?php $pageTitle = "Events" ?>
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
	<!--/banner_bottom-->
	<div class="banner_bottom" id="events">
		<div class="banner_bottom_in">

			<?php 	
				$offset = 0;
				$limit = 1;
				if(isset($_GET['event_id'])){
					$event_id = $_GET['event_id'];
				}else{
					$event_id = fetch_column4('events', 'event_reg_date', $offset, $limit);
					$event_id = $event_id['event_id'];
				}								
				$events = fetch_column5('events', 'event_id', $event_id);
				// fetch_column4('events', 'event_reg_date', $offset, $limit);

			?>

			<h3 class="headerw3"><?php echo $events['event_title'] ?></h3>

			<p><?php echo $events['event_desc'] ?></p>

			
			<img src="admin/<?php if(isset($events['event_image'])){
				echo $events['event_image'];
				}else{
				echo "http://via.placeholder.com/500x500";
				} ?>" alt="Image" style="height:auto; width:50%;">

			<!-- <iframe src="https://www.youtube.com/embed/HndV87XpkWg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
				
		</div>
	</div>
	<!--//banner_bottom-->

	<!--/top_spl_courses-->
	<div class="top_spl_courses">
		<div class="container">
			<h3 class="headerw3">Latest Events</h3>
			<div class="inner_sec_w3_agileinfo">
				<div class="mid_slider">
					<!-- banner -->
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1" class=""></li>
							<li data-target="#myCarousel" data-slide-to="2" class=""></li>
							<li data-target="#myCarousel" data-slide-to="3" class=""></li>
						</ol>
						<div class="carousel-inner" role="listbox">

								<?php 	
								$offset = 0;
								$limit = 4;								
								$events = fetch_column4('events', 'event_reg_date', $offset, $limit);

							?>
							
							<div class="item active">

								<div class="row">	
									<?php foreach ($events as $event):
									$offset++; 
									?>
										<a href="events.php?event_id=<?php echo $event['event_id'] ?>">
										<div class="col-md-3 col-sm-3 col-xs-3 slidering">
											<div class="thumbnail"><img src="admin/<?php if(isset($event		['event_image'])){
													echo $event['event_image'];
													}else{
													echo "http://via.placeholder.com/500x500";
													} ?>" alt="Image" style="height:252.5px; width:252.5px;">
											</div>
											<h5><?php if(isset($event['event_title'])){
													echo $event['event_title'];}  ?></h5>
										</div>
										</a>		
										
									<?php endforeach ?>
								</div>
							</div>
							
							
								<?php

								$events = fetch_column4('events', 'event_reg_date', $offset, $limit);
								?>

						<?php if($events != false){  ?>
							<div class="item ">
								<div class="row">
								
									<?php
									// var_dump($limit);
									if(count($events) === count($events, COUNT_RECURSIVE)){ ?>
									<a href="events.php?event_id=<?php echo $event['event_id'] ?>">
										<div class="col-md-3 col-sm-3 col-xs-3 slidering">
											<div class="thumbnail"><img src="admin/<?php if(isset($events		['event_image'])){
													echo $events['event_image'];
													}else{
													echo "http://via.placeholder.com/500x500";
													} ?>" alt="Image" style="height:252.5px; width:252.5px;">
											</div>
											<h5><?php if(isset($events['event_title'])){
													echo $events['event_title'];}  ?></h5>
										</div>
									</a>	
									<?php }else{?>
										<?php foreach ($events as $event):
										$offset++; 
										?>
											<a href="events.php?event_id=<?php echo $event['event_id'] ?>">
											<div class="col-md-3 col-sm-3 col-xs-3 slidering">
												<div class="thumbnail"><img src="admin/<?php if(isset($event		['event_image'])){
														echo $event['event_image'];
														}else{
														echo "http://via.placeholder.com/500x500";
														} ?>" alt="Image" style="height:252.5px; width:252.5px;">
												</div>
												<h5><?php if(isset($event['event_title'])){
														echo $event['event_title'];}  ?></h5>
											</div>
											</a>
											
										<?php 
										endforeach ?>
										<?php }?>	
									
								</div>
							</div>
						<?php } ?>
							
						</div>
						<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="fa fa-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="fa fa-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
						<!-- The Modal -->
					</div>
				</div>
				<!--//slider-->
			</div>
		</div>
	</div>
	<!--//top_spl_courses-->

	<!-- /newsletter-->
	<?php
	
	if(isset($_POST['newsletter'])){
		$result = add_newsletter_email($_POST);
		extract($_POST);
			if($result === true){
				$msg = true;
			} else {
				$errors = $result;
		?>
			<?php if ($errors) { ?>
				<script>
					var sweetAlert = <?php echo json_encode($errors); ?>;
					var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'SUBSCRIPTION MESSAGE.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
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
			notifyWithToast('success', 'Subscription Successful');
		</script> 
		<?php endif; ?>

	<form method="post" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
		<div class="newsletter">
			<div class="col-sm-6 newsleft">
				<h3>Subscribe for Our Newsletter! and Notifications</h3>
			</div>
			<div class="col-sm-6 newsright">
				<form action="#" method="post">
					<input type="email" placeholder="Enter your email..." name="newsletter_email" >
					<input type="submit" value="Submit" name="newsletter">
				</form>
			</div>

			<div class="clearfix"></div>
		</div>
	</form>
	<!-- //newsletter-->

	<!-- bootstrap-modal-pop-up -->
	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Luscious
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<img src="images/model.jpg" alt=" " class="img-responsive" />
					<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
						consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur,
						vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- //bootstrap-modal-pop-up -->

	<!--footer-->
	
	<?php require_once 'inc/page-footer.inc.php'; ?>

	<!--/footer -->
	
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!--search-bar-->
	<script src="js/main.js"></script>
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