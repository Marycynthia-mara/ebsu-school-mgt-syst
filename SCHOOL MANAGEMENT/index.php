<?php $pageTitle = "Home" ?>
<?php require_once 'inc/page-header.inc.php'; ?>


		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="banner-top">
							<div class="banner-info-w3ls-agileinfo">
								<h3>Opportunities For Lifelong Learning.</h3>
							</div>

						</div>
					</li>
					<li>
						<div class="banner-top1">
							<div class="banner-info-w3ls-agileinfo">
								<h3>Education is a path, not a destination</h3>
							</div>

						</div>
					</li>
					<li>
						<div class="banner-top2">
							<div class="banner-info-w3ls-agileinfo">
								<h3>An Investment in Knowledge Pays the Best Interest.</h3>
							</div>

						</div>
					</li>
					<li>
						<div class="banner-top3">
							<div class="banner-info-w3ls-agileinfo">
								<h3>Develop a Passion For Learning. If You Do You Will Never Cease To Grow. </h3>
							</div>

						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>

			<!--banner Slider starts Here-->
		</div>
		<!--//Slider-->
	</div>
	<!-- Modal1 -->
	<?php 
	require_once 'inc/sign_in.inc.php'; 
	?>
	<!-- //Modal1 -->
	<!-- Modal2 -->
	<?php 
	require_once 'inc/sign_up.inc.php'; 
	?>
	<!-- //Modal2 -->
	
	<!--/what-wedo-->
	<div class="top_spl_courses">
		<div class="container">
			<h3 class="headerw3" >Welcome</h3>
			<div class="inner_sec_w3_agileinfo">

				<div class="col-md-6 edu-left">
					<h4 class="sub-hdng two">WHO we ARE</h4>
					<p class="paragraph">The School started precisely on the 28 November 1994 in a mud building of 10 rooms, which has given way to a gigantic two storey building accommodating almost all the streams. There are other buildings like the Library block, as well as a well-equipped Laboratories for each of the science subjects, an ICT/Computer lab, a workshop for technology studies and a large room for indoor games. It is common knowledge that the first teachers of this school started with a long table and 6 seats as office furniture... but now the school has modern air conditioned staff rooms, well furnished in a two storey edifice, Ebsu Staff Secondary School has close to one thousand students and more than 70 qualified teachers and non-tutorial members of staff...<a href="about.php">Read More</a></p>

				</div>
				<div class="col-md-6 edu_img">
					<img src="images/stretch.jpg" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--/what-wedo-->
	
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
									<a href="events.php?event_id=<?php echo $events['event_id'] ?>">
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

	<!--what-we-do-->
	<div class="top_spl_courses">
		<div class="container">
			<h3 class="headerw3">WHAT we DO</h3>
			<div class="inner_sec_w3_agileinfo">
				<div class="tabs-grids">
					<div id="parentVerticalTab">
						<ul class="resp-tabs-list hor_1">
							<li>Educate</li>
							<li>Help & Support</li>
							<li>Certify</li>


						</ul>
						<div class="resp-tabs-container hor_1">
							<div class="text-info">
								<h4>Coursework</h4>
								<p>In EBSU Staff Secondary School Abakaliki, we have well ventilated class room blocks, well equipped laboratories for science, arts and technical learning, we have geographical garden, comfortable library for research and learning and a well organised time table to ensure that we provide our students with the best and most obtainable learning activities.</p>
								<p class="sec">We also have modern air conditioned staff rooms, well furnished in a two storey edifice. The management also supplied various sports equipment to promote sports in the school and a borehole with accompanying well located overhead tanks to give the school constant water supply, a good school canteen and a well ventilated and luminated hall for examination and confrences. Ebsu Staff Secondary School has close to one thousand students and more than 70 qualified teachers and non-tutorial members of staff.</p>
								<img src="images/banner1.jpg" alt=" " class="img-responsive" />

							</div>
							<div class="text-info">
								<h4>Help & Support</h4>
								<p>We have experienced and dedicated professionals to guide, direct, encourage and support every of our student on the part of a successful actualisation of his or her full potentials.</p>
								<p class="sec">We also have carefully selected team of professional instructors to support our students in classroom and laboratory activities and ensure a hitch free learning.</p>
								<img src="images/banner2.jpg" alt=" " class="img-responsive" />

							</div>

							<div class="text-info">
								<h4>Certificates</h4>
								<p>Students who have successfully completed their Junior Secondary School studies with us here at EBSU Staff Secondary School Abakaliki would seat for a certificate examination and on completion acquire a Junior School Certificate.</p>
								<p class="sec">And students who have successfully completed their Senior Secondary School studies with us here at EBSU Staff Secondary School Abakaliki would seat for a certificate examination and on completion acquire a Senior School Certificate.</p>
								<img src="images/banner3.jpg" alt=" " class="img-responsive" />

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- </div> -->
	<!--//what-we-do-->
	<div class="tesimonials">
		<div class="container">
			<h3 class="headerw3 two">Testimonials</h3>
			<div class="inner_sec_w3_agileinfo">
				<div class="test_grid_sec">
					<div class="col-md-offset-2 col-md-8">
						<div class="carousel slide two" data-ride="carousel" id="quote-carousel">
							<!-- Bottom Carousel Indicators -->
							<ol class="carousel-indicators two">
								<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#quote-carousel" data-slide-to="1"></li>
								<li data-target="#quote-carousel" data-slide-to="2"></li>
							</ol>

							<!-- Carousel Slides / Quotes -->
							<div class="carousel-inner">

								<!-- Quote 1 -->
								<div class="item active">
									<blockquote>
										<div class="test_grid">
											<div class="col-sm-3 text-center test_img">
												<i class="fa fa-user" aria-hidden="true"></i>

											</div>
											<div class="col-sm-9 test_img_info">
												<p>My daughter Amarachi has been performing well in her studies since i registered her in EBSU Staff Secondary School, Abakaliki.</p>
												<h6>Mrs. Chinelo</h6>
											</div>
										</div>
									</blockquote>
								</div>
								<!-- Quote 2 -->
								<div class="item">
									<blockquote>
										<div class="test_grid">
											<div class="col-sm-3 text-center test_img">
												<i class="fa fa-user" aria-hidden="true"></i>
											</div>
											<div class="col-sm-9 test_img_info">
												<p>EBSU Staff Secondary School Abakaliki has a very cerene environment and has a balanced way of combining learning and sporting activites, debate, quiz and seminars, I love EBSU !.</p>
												<h6>Mrs. Cynthia</h6>
											</div>
										</div>
									</blockquote>
								</div>
								<!-- Quote 3 -->
								<div class="item">
									<blockquote>
										<div class="test_grid">
											<div class="col-sm-3 text-center test_img">
												<i class="fa fa-user" aria-hidden="true"></i>
											</div>
											<div class="col-sm-9 test_img_info">
												<p>I am Impressed with the level of dedication from the instructors who give assignments after each class and as well revisit it.</p>
												<h6>Mr. Jude</h6>
											</div>
										</div>
									</blockquote>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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