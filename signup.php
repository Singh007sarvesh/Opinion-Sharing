<?php
    include('connection.php');
?>



<!DOCTYPE html>
 <html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title>Signup</title>
        <link rel="stylesheet" type="text/css" href="css/login.css" />
    </head>
    <body background="images/bg.jpg">
        <div class="container">				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form"><div class="change_link"><a href="index.php">Home</a></div>
                            <form  action = "signup.php", method="post"> 
                                <h1>Join Us</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="" > Name </label>
                                    <input id="username" name="name" required="required" type="text" placeholder="Your Name"/>
                                </p>
                                <p> 
                                    <label for="username" class="uname" data-icon="" >Email </label>
                                    <input id="username" name="username" required="required" type="email" placeholder="mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon=""> Password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Continue" name = "submit" /> 
								</p>
                                <p class="change_link">
									Already registered?
									<a href="login.php">Click to login</a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </div>
    </body>
</html>


<!-- ####################### PHP CODE ################################ -->

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['username'];
        $password = $_POST['password'];
        $date = date("Y-m-d");

/* ############## CHECKING FOR ALREADY REGISTRATION ########### */

        $reg_user_query = $conn->query("select * from register where email = '$email' ");
        $rowcount=mysqli_num_rows($reg_user_query);
        if($rowcount>0)
        {
            echo "<div style='float:right'><center>You are already registered...";
            echo "<a href='login.php'>Click to login </a></center><div><br><br>";
        }
        else
        {
            /* ################# user id generation ############### */

            $uid_count_query = $conn->query("select count(*) as user_count from register ");
            $uid_count_res = $uid_count_query->fetch_array(MYSQLI_BOTH); 
            $cnt = $uid_count_res['user_count']+1;
            $userid = "OS10".$cnt."UR";

            /* ########### USER DATA INSERTION ############### */

            $registration_query = $conn->query("insert into register(userid,email,password,date)values('$userid','$email', '$password','$date')");
            $user_query = $conn->query("insert into user(userid,name)values('$userid','$name')");
            if($registration_query && $user_query )
            {
                echo "<div style='float:right'><center>Registration successful...";
                echo "<a href='login.php'>Click to login </a></center></div><br><br>";
            }
        }
    }

?>