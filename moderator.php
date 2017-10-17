<?php
    include('connection.php');
    session_start();
?>


<!DOCTYPE html>
 <html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/login.css" />
    </head>
    <body background="images/bg.jpg">
        <div class="container">				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
                        	<div class="change_link"><a href="index.php">
                        		<img src="images/logo.png" width="150px" height="50px" ></a>
                        	</div>

<!-- #################### FORM FOR DUAL VERIFICATION #################### -->

                            <form action="moderator.php" method="post" > 
                                <h1>Security Check</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="" > Security Key </label>
                                    <input id="username" name="passkey" required="required" type="password" placeholder="Your secret Passkey"/>
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Continue" name ='sec_check' /> 
								</p>
                                <p class="change_link">
									<a href="login.php">Back</a>
								</p>
                            </form>

  <!-- #################### FORM CLOSED #################### -->
                        </div>
						
                    </div>
                </div>  
            </div>
    </body>
</html>

<!-- #################### PHP CODE FOR ADMIN VERIFICATION ############################## -->
<?php
	if(isset($_POST['sec_check']))
	{
		$email = $_SESSION['email'];
		$passkey = $_POST['passkey'];
		$mod_query = $conn->query("select secure_code from moderator where email = '$email'");
		$mod_res = $mod_query->fetch_array(MYSQLI_BOTH);
		if($passkey == $mod_res['secure_code'])
		{
			header('location:moderator_portal.php');
		}
		else
		{
			echo "<center><font color='red'>Passkey is wrong...try again</font></center>";
		}
	}
?>

