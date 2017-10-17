<?php
include('connection.php');
session_start();
unset($_SESSION['email']);
unset($_SESSION['userid']);
//unset($_SESSION['userData']);
//Destroy entire session
session_destroy();
//Redirect to homepage
header("location:index.php");
?>
