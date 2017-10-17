<?php
    include('connection.php');
    session_start();

   ?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Single Post</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
	</head>
	<body class="right-sidebar">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						<h1><a href="#" id="logo">Opinion</a></h1>
					
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
								<li><a href="logout.php">Log Out</a></li>
							</ul>
						</nav>

				</div>
			</div>

<?php

/* ################PHP CODE FOR SELECTING THE DETAILS #######################  */
	
	$postid = $_GET['postid'];                  
	$pd_query = $conn->query("select * from post where postid = '$postid'");                // pd = post details
	$pd_res = $pd_query->fetch_array(MYSQLI_BOTH);

	$userid = $pd_res['userid'];
	$ud_query = $conn->query("select name from user where userid = '$userid'");                    //ud = user details
	$ud_res = $ud_query->fetch_array(MYSQLI_BOTH);

	$tl_query = $conn->query("select count(*) as total_likes from like_t where userid='$userid' and postid = '$postid'");
	$tl_res = $tl_query->fetch_array(MYSQLI_BOTH);             // tl = total likes

	$tc_query = $conn->query("select count(*) as total_comments from comment where postid = '$postid'");
	$tc_res = $tc_query->fetch_array(MYSQLI_BOTH);             // tl = total comments

?>


<!-- ############################### POST DISPLAY AND OTHER FUNCTIONALITIES ################ --> 
		<!-- Main -->
			<div id="main" class="wrapper style1">
				<div class="container">
					<div class="row">
					
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<p><font size="6px" color="black"><?php echo $pd_res['title']; ?></font>
									</p>
									<span class="byline"><?php echo "<font size='4px'>Written by"." "."</font><font size='3px' color='teal'>".$ud_res['name']."</font>";
									 echo "     "."<font size='4px'>on"."  "."</font><font size='3px' color='teal'>".$pd_res['pdate']." </font><font size='4px'>| ".$pd_res['category']."</font>";
									 ?>
										
									</span>
								</header>
								<p ">

									<?php   // MEDIA DISPLAY
										   $file_name = $pd_res['media_url'];
									       echo "<img src='images/post_media/".$file_name."' width='70%' , height='80%' >";	
									?>
										
								</p>
								<p >

									<?php  // CONTENT PRINTING
									  echo $pd_res['content']; 
									 ?>
									 	
								</p>
								<p><b><font size ="5px">

									Likes&nbsp;:<?php  // TOTAL LIKES
									               echo "  <font color='teal'>".$tl_res['total_likes']."</font>";?>
										
									</font></b>

								<b><font size ="5px">&nbsp;&nbsp;&nbsp;&nbsp;Comments&nbsp;:

									<?php echo "  <font color='teal'>".$tc_res['total_comments']."</font>";?></font>

								</b>
								<p>Comment writing option</p>
								<p>Comment edit and delete option also</p>
								<p>Comment Display...Image of commentor, Date, Name of Commentor(As link that direct to his/her profile</p>
							</section>
						</div>

						<!-- Sidebar -->
						<div id="sidebar" class="4u sidebar">
							<section>
								<header class="major">
									<h2>Recent Post</h2>
								</header>
								<div class="row half">
									<section class="6u">
										<ul class="default">
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
										</ul>
									</section>
									<section class="6u">
										<ul class="default">
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
											<li><a href="#">First Post title as link</a></li>
										</ul>
									</section>
								</div>
							</section>
							<section>
								<header class="major">
									<h2>Categorical Post</h2>
								</header>
								<p>Enter category and Submit </p>
								<ul class="default">
									<li><a href="#">Post of requested category</a></li>
									<li><a href="#">Post of requested category</a></li>
									<li><a href="#">Post of requested category</a></li>
									<li><a href="#">Post of requested category</a></li>
									<li><a href="#">Post of requested category</a></li>
									<li><a href="#">Post of requested category</a></li>
								</ul>
							</section>
						</div>
						
					</div>
				</div>
			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container">

					<!-- Lists -->
						<div class="row">
							<div class="8u">
								<section>
									<header class="major">
										<h2>Popular Posts</h2>
										<span class="byline">These are the most popular and recent posts</span>
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