<?php
    include('connection.php');
    session_start();

   ?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>My Page</title>
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
	<body class="left-sidebar">

		<!-- Header -->
			<div id="header">
				<div class="container">


<?php
		// PHP code for displaying name and details.
		$userid = $_SESSION['userid'];
		$user_detail_query = $conn->query("select * from user where userid ='$userid'");
		$user_detail_res = $user_detail_query->fetch_array(MYSQLI_BOTH);
?>

						
					<!-- Logo -->
						<h1><a href="#" id="logo"> <?php echo $user_detail_res['name']; ?> </a></h1>
					
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

		<!-- Main -->
			<div id="main" class="wrapper style1">
				<div class="container">
					<div class="row">
					
						<!-- Sidebar -->
						<div id="sidebar" class="4u sidebar">
							<section>
								<header class="major">
									<h2>Activities</h2>
								</header>
								<div class="row half">
									<section class="6u">
										<ul class="default">
											<li><a href="user_portal.php">My Portal</a></li>
											<li><a href="mypost.php">My Post</a></li>
											<li><a href="view_profile.php">View Profile</a></li>
											<li><a href="change_password.php">Change Password</a></li>
											<li><a href="send_message.php">Send Message</a></li>
										</ul>
									</section>
								</div>
							</section>
							<section>
								<header class="major">
									<h2>Your Recent posts</h2>
								</header>
								<ul class="default">
									

									<?php 
										/* ################ PHP CODE FOR PRINTING THE SIDE POST ##################### */
		
										$userid = $_SESSION['userid'];
										$post_detail_query = $conn->query("select postid,title from post where userid ='$userid' order by pdate");
										$recent_post_num = mysqli_num_rows($post_detail_query);
										if($recent_post_num==0)
										{
											echo "<li> No Post Found..<a href='user_portal.php'>Click to write </a></li>";
										}
										else
										{
											$pcount=0;
											while($post_detail_res = $post_detail_query->fetch_array(MYSQLI_BOTH))
											{
												echo '<li><a href="post.php?postid='.$post_detail_res["postid"].'">
													'.$post_detail_res['title'].'</a></li>';
												$pcount++;
												if($pcount==5)
													break;
											}
										}
										//$post_detail_res = $post_detail_query->fetch_array(MYSQLI_BOTH);

	 									/* ################# END ################ */
									?>

								</ul>
							</section>
						</div>

						<style> /*a{text-decoration:none;} */a:hover{color:teal;}</style>

						<div >
							<section>
								<header class="major">
									<h2>Change Password</h2>
									Make your password more secure.
									<span class="byline"></span>
								</header>
<!-- #################### FORM FOR Password Changing #################### -->
							
                            <form action="change_password.php" method="post" > 
                                <p> 
                                    <label for="username" class="uname" data-icon="" > Old Password </label>
                                    <input id="username" name="old_password" required="required" type="password" placeholder="Old Password"/>
                                </p>
                                <p> 
                                    <label for="username" class="uname" data-icon="" > New Password </label>
                                    <input id="username" name="new_password" required="required" type="password" placeholder="New Password"/>
                                </p>
                                <input type = "submit" name="change_password" value="Submit">
                            </form>

                            <?php
                            	  // PHP CODE FOR CHANGING PASSWORD
                            	  if(isset($_POST['change_password']))
                            	  {
                            	  	$old_password = $_POST['old_password'];
                            	  	$new_password = $_POST['new_password'];
                            	  	$userid = $_SESSION['userid'];

                            	  	$check_password_query = $conn->query("select password from register where userid = '$userid'");
                            	  	$check_password_res = $check_password_query->fetch_array(MYSQLI_BOTH);

                            	  	if($check_password_res['password'] == $old_password)
                            	  	{
                            	  		$change_password_query = $conn->query("update register set password = '$new_password' where userid = '$userid'");
                            	  		if($change_password_query)
                            	  		{
                            	  			echo "<font color = 'green'> Password changed successfully </font>";
                            	  		}
                            	  		else
                            	  		{
                            	  			echo "<font color='red'> Erorr in updation ..! Try again></font>";
                            	  		}
                            	  	}
                            	  	else{
                            	  		echo "<font color='red'> Password is wrong! Try again.</font>";
                            	  	}

                            	  }
                            ?>

  <!-- #################### FORM CLOSED #################### -->

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
												<li><b>Popular post</b></li>

		<!-- ################ PHP CODE FOR WRITING THE Popular POST ##############-->

												<?php
													//*********** START
													$rp_query = $conn->query('select postid,title from post order by pdate');  //pp = popular post
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