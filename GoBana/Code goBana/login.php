<?php
//echo"in";
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$error1=''; 
$error2=''; 
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("sql105.lockernerd.co.uk", "lnw_17056803", "x1bzc5tq");
$db = mysql_select_db("lnw_17056803_gobana", $connection);
 
 //echo 1;
if (isset($_POST['submit'])) {
	
	if (empty($_POST['email-modal']) || empty($_POST['password-modal'])) {
		$error = "Email or Password is empty";
		}	
	else
		{
		// Define $username and $password
		$username=$_POST['email-modal'];
		$password=$_POST['password-modal'];
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// Selecting Database
		//$db =mysql_select_db("a8202403_company", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from user where password='$password' AND email='$username'", $connection);
		 
		
		$rows = mysql_num_rows($query);
		if ($rows == 1) {

			$rowp=mysql_fetch_array($query);
			$_SESSION['login_user']=$username; // Initializing Session
			header("location: user/index.php"); // Redirecting To Other Page
		} 
		else {
		$error = "Username or Password is invalid";
		header("location: register.php");
		}
	}
		//mysql_close($connection); // Closing Connection
	}
	
echo $error;
	

?>
