<?php
    include('connection.php');

 ?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Opinion Sharing</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
<!-- ******************************* -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
<!--*********************************-->
	</head>
	<body class="homepage">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						<h1><a href="index.html" id="logo">Opinion Sharing</a></h1>
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>
									<a href="">Search</a>
									<ul>
										<li><a href="user_search.php">Search User</a></li>
										<li><a href="post_search.php">Search Post</a></li>
										<li><a href="#">link1</a></li>
										<li><a href="#">link2</a></li>
									</ul>
								</li>
								<li><a href="all_post.php">Post</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="login.php">Sign in</a></li>
							</ul>
						</nav>


					<!-- Banner -->
						<div id="banner">
							<div class="container">
								<section>
									<header class="major">
										<h2>Welcome!</h2>
										<span class="byline"><i>"Your opinion can be  my solution"</i>
<br> Come , Join and share your ideas and opinions.</span>
									</header>
									<a href="signup.php" class="button alt">Join Us</a>
								</section>			
							</div>
						</div>

				</div>
			</div>

		<!-- Featured -->
			<div class="wrapper style2">
				<section class="container">
					<header class="major">
						<h2>Trending ideas</h2>
						<span class="byline">Read and join us to share your opinion</span>
					</header>
					<div class="row no-collapse-1">
						<section class="4u">
							<a href="#" class="image feature"><img src="images/pic02.jpg" alt=""></a>
							<p>Health is the level of functional and metabolic efficiency of a living organism. In humans it is the ability of individuals or communities to adapt and self-manage when facing physical, mental, psychological and social changes with environment.</p>
						</section>
						<section class="4u">
							<a href="#" class="image feature"><img src="images/pic03.jpg" alt=""></a>
							<p>Sports are usually governed by a set of rules or customs, which serve to ensure fair competition, and allow consistent adjudication of the winner. Winning can be determined by physical events such as scoring goals or crossing a line first. </p>
						</section>
						<section class="4u">
							<a href="#" class="image feature"><img src="images/pic04.jpg" alt=""></a>
							<p>The use of the term "technology" has changed significantly over the last 200 years. Before the 20th century, the term was uncommon in English, and it was used either to refer to the description or study of the useful arts[3] or to allude to technical education, as in the Massachusetts Institute of Technology</p>
						</section>
	
					</div>
				</section>
			</div>

		<!-- Main -->
			<div id="main" class="wrapper style1">
				<section class="container">
					<header class="major">
						<h2>Valuable Users</h2>
						<span class="byline">These are the users with maximum and most liked opinions.</span>
					</header>
					<div class="row">
					
						<!-- Content -->
							<div class="6u">
								<section>
									<ul class="style">
										<li>
											<span class="fa fa-wrench"></span>
											<h3>Abhinesh Singh</h3>
											<span>Total Post: 39<br>Active Since : Jan 2017</span>
										</li>
										<li>
											<span class="fa fa-cloud"></span>
											<h3>Aman Mehra</h3>
											<span>Total Post: 39<br>Active Since : Jan 2017</span>
										</li>
									</ul>
								</section>
							</div>
							<div class="6u">
								<section>
									<ul class="style">
										<li>
											<span class="fa fa-cogs"></span>
											<h3>Rohit Sharma</h3>
											<span>Total Post: 39<br>Active Since : Jan 2017</span>
										</li>
										<li>
											<span class="fa fa-leaf"></span>
											<h3>Aditi Verma</h3>
											<span>Total Post: 39<br>Active Since : Jan 2017.</span>
										</li>
									</ul>
								</section>
							</div>

					</div>
				</section>
			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container">

					<!-- Lists -->
						<div class="row">
							<div class="8u">
								<section>
									<header class="major">
										<h2>Recent Posts</h2>
										<span class="byline">These are the most recent posts</span>
									</header>
									<div class="row">
										<section class="6u">
											<ul class="default">
												<li><b>Recent Post</b></li>

										<!-- ################ PHP CODE FOR WRITING THE RECENT POST ##############-->

												<?php
													//*********** START
													$rp_query = $conn->query('select postid,title from post order by pdate');  //rp = recent post
													$rp_num = mysqli_num_rows($rp_query);
													if($rp_num==0)
													 {
														echo "<li> No Post</li>";
													 }
													else
													{
														$pcount=0;
														while($rp_res = $rp_query->fetch_array(MYSQLI_BOTH))
														{
														echo '<li><a href="post.php?postid='.$rp_res["postid"].'">'.$rp_res['title'].'</a></li>';
														$pcount++;
														if($pcount==2)
														break;
														}
													}
												//*********** END
												?>
											</ul>
										</section>
										<section class="6u">
											<ul class="default">
												<li><b>Recent Post</b></li>
												<!-- ################ PHP CODE FOR WRITING THE RECENT POST ##############-->

												<?php
													//*********** START
													$rp_query = $conn->query('select postid,title from post order by pdate');  //rp = recent post
													$rp_num = mysqli_num_rows($rp_query);
													if($rp_num==0)
													 {
														echo "<li> No Post</li>";
													 }
													else
													{
														$pcount=0;
														while($rp_res = $rp_query->fetch_array(MYSQLI_BOTH))
														{
														echo '<li><a href="post.php?postid='.$rp_res["postid"].'">'.$rp_res['title'].'</a></li>';
														$pcount++;
														if($pcount==2)
														break;
														}
													}
												//*********** END
												?>
											</ul>
										</section>
									</div>
								</section>
							</div>
							<div class="4u">
								<section>
									<header class="major">
										<h2>Team - OS</h2>
										<span class="byline">You can find us here..</span>
									</header>
									<ul class="contact">
										<li>
											<span class="address">Address</span>
											<span>National Institute of Technology <br />Calicut, Kerala, India</span>
										</li>
										<li>
											<span class="mail">Mail</span>
											<span><a href="#">teamos@gmail.com</a></span>
										</li>
										<li>
											<span class="phone">Phone</span>
											<span>+91-9876453210</span>
										</li>
									</ul>	
								</section>
							</div>
						</div>
				</div>
			</div>

	</body>
</html>
