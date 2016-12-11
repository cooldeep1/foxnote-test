<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("sql105.lockernerd.co.uk", "lnw_17056803", "x1bzc5tq");
$db = mysql_select_db("lnw_17056803_gobana", $connection);
 
 		session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select user,id from user where email='$user_check'", $connection);

$row = mysql_fetch_assoc($ses_sql);

$login_session =$row['user'];
$login_id=$row['id'];
$till=$row['till'];
//echo $login_session."fuclk";
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: ../index.html'); // Redirecting To Home Page
}
?>