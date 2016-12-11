<?php 
$error='';
error_reporting(0);
include('session.php');
if(isset($_POST['submit']))
    {
        if(empty($_POST['b_data'])) {
        $error = "unfilled fields"; 
        }
        else
        {   
            //echo "else"; 
            $p_id=$_POST['post_id'];     
            $note=$_POST['b_data'];
            $note = stripslashes($note);
            $note = mysql_real_escape_string($note);
            $note=filter_var($note,FILTER_SANITIZE_STRING);
            $query3=mysql_query("INSERT INTO comments (data,post_id,owner) VALUES ('$note','$p_id','$login_id') ", $connection);
            $query3=mysql_query("UPDATE book set noc=noc+1 where id=$p_id ", $connection);
            $data="Location: post.php?b_name=";
            $data=$data.$p_id;
            
            header($data); 
        }   
        
        
    }

?>