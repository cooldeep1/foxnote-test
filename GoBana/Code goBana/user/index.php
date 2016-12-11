<?php
$error='';
error_reporting(0);
include('session.php');
if(isset($_POST['submit']))
    {
        if(empty($_POST['b_name'])) {
        $error = "unfilled fields"; 
        }
        else
        {   
            //echo "else";      
            $name=$_POST['b_name'];
            $note=$_POST['b_data'];
            if(isset($_POST['share']))
            $share=1;
            else $share=0;
            $name = stripslashes($name);
            $name = mysql_real_escape_string($name);
            $note = stripslashes($note);
            $note = mysql_real_escape_string($note);
            $note=filter_var($note,FILTER_SANITIZE_STRING);
            $query3=mysql_query("SELECT id FROM book ORDER BY id DESC LIMIT 1", $connection);
            $row3 = mysql_fetch_array($query3);
            $q_id=$row3['id'];
            $query = mysql_query("SELECT id FROM book where name='$name'", $connection);
            $rows = mysql_num_rows($query);
            $owner=$login_id;
            if($rows==0){
                
                //echo "INSERT INTO book (name,pdf) VALUES ('$name','$imageName')";
                if(empty($_POST['file']))
                {

                    $targetfolder = "uploads/";
                    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
                    //echo $targetfolder;
                     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                     {
                        $display="BOOK ADDED SUCCESSFULLY";
                        //echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
                        $imageName=basename( $_FILES['file']['name']);
                        $imageName="uploads/".$imageName;
                        mysql_query("INSERT INTO book (name,pdf,owner,sharing,data) VALUES ('$name','$imageName','$owner','$share','$note') ", $connection);
                     }
                     else {
                         $imageName=0;
                    mysql_query("INSERT INTO book (name,pdf,owner,sharing,data) VALUES ('$name','$imageName','$owner','$share','$note') ", $connection);
                     }
                }

               
            }
            else {
                $error="BOOK ALREADY EXISTS";
            }
            

            }   
        
        
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Gobana
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/owl.carousel.css" rel="stylesheet">
    <link href="../css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="../css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="../css/custom.css" rel="stylesheet">

    <script src="../js/respond.min.js"></script>
    <script src="ckeditor.js"></script>
 
    <link rel="shortcut icon" href="../favicon.png">



</head>

<body>
    <!-- *** TOPBAR ***-->
    <div id="top" style="height:50px">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="index.php" class="btn btn-success btn-sm" data-animate-hover="shake" style="height:35px; font-size:20px">GOBANA</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="profile.php" style="height:35px; font-size:20px; text-transform:capitalize"><?php echo $login_session;?></a>
                    </li>
                    <li><a href="contact.php" style="height:35px; font-size:20px">Contact</a>
                    </li>
                    <li><a href="logout.php" style="height:35px; font-size:20px">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        

    </div>

    <!-- *** TOP BAR END *** <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
         -->
<br />
<div id="content">
            <div class="container">

                

                <!-- *** LEFT COLUMN ***
             _________________________________________________________ -->

                <div class="col-sm-9" id="blog-listing">
                    <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="comment">Name your note<span class="required">*</span>
                                            </label>
                                            <textarea class="form-control" id="comment" rows="1"  name="b_name"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="comment">Create your note <span class="required">*</span>
                                            </label>
                                            <textarea class="form-control" id="comment" rows="4"  name="b_data"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="comment">Add an image </span>
                                            </label>
                                            <input type="file" name="file" id="file" accept="image/*">
                                            <input type="checkbox" name="share" value="1" checked> Make it a public Note.<br>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary" name="submit" type="submit" value="submit"><i class="fa fa-comment-o"></i> Post</button>
                                    </div>
                                </div>


                        </form>
                        <br /><br />
                    <ul class="breadcrumb">

                        <li><a href="#">Home</a>
                        </li>
                    </ul>


                    <div class="box">

                        <h1>Notes and Diary Feed</h1>
                        
                    </div>

                    <?php
                        
                        //echo "SELECT id,name,pdf FROM book ORDER BY id where owner=$id";
                        $name="";
                        $share=1;
                        $query=mysql_query("SELECT id,name,pdf,owner,data,noc,date FROM book where owner=$login_id OR sharing=$share ORDER BY id DESC", $connection);
                        $row = mysql_num_rows($query);
                        //echo $row;
                        if($row>0){
                        while($data=mysql_fetch_array($query))
                        {
                            $user_id=$data['owner'];
                            $query_user=mysql_query("SELECT user FROM user where id=$user_id", $connection);
                            $user_name = mysql_fetch_array($query_user);
                            $name=$user_name['user'];
                            $book_id=$data['id'];   
                            $timestamp = $data['date'];
                            $datetime = explode(" ",$timestamp);
                            $date = $datetime[0];
                            $comments=$data['noc'];
                            $content=htmlspecialchars_decode($data['data']);
                            $content=substr($content, 0, 100);                           
                            echo "<div class='post'>
                        <h2><a href='post.php?b_name=$book_id'>".$data['name']."</a></h2>
                        <p class='author-category'>By <a href='profile.php?b_name=$user_id'>".$name."</a> 
                        </p>
                        <hr>
                        <p class='date-comments'>
                            <a href='post.php?b_name=$book_id'><i class='fa fa-calendar-o'></i> ".$date."</a>
                            <a href='post.php?b_name=$book_id'><i class='fa fa-comment-o'></i>".$comments." Comments</a>
                        </p>";
                        if($data['pdf']!='0'){
                            echo "<p>
                                <img src=".$data['pdf']."  alt='image not loaded properly' height='400'>
                            </p>";
                        }
                        echo "
                        <p class='intro'>".$content."...</p>
                        <p class='read-more'><a href='post.php?b_name=$book_id' class='btn btn-primary'>Continue reading</a>
                        </p>
                    </div>";

                        }}
                        else{
                            echo"<div class='post'>
                        <h2><a href='index.php'>"."Nothing to show here"."</a></h2>
                        </div>";

                        }

                    ?>


                    


                </div>
                <!-- /.col-md-9 -->

                <!-- *** LEFT COLUMN END *** -->


                <div class="col-md-3">
                    <!-- *** BLOG MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Category</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="diary.php">Create a Diary</a>
                                </li>
                                <li class="active">
                                    <a href="index.php">Create a Note</a>
                                </li>
                                
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** BLOG MENU END *** -->

                    
                </div>


            </div>
            <!-- /.container -->
        </div>
 



        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            
                            <li><a href="profile.php">Profile</a>
                            </li>
                            <li><a href="index.php">Home</a>
                            </li>
                            <li><a href="contact.php">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="index.php">Create a Note</a>
                            </li>
                            <li><a href="diary.php">Create a Diary</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Trending</h4>

                        <h5>Diary</h5>

                         <ul>
                            <?php
                                $query=mysql_query("SELECT id,name,pdf,owner,data,noc,date,sharing FROM book where name='Diary' order by noc desc ", $connection);
                                $i=0;
                                while($i<2)
                                {
                                    $i=$i+1;
                                    if($row=mysql_fetch_array($query))
                                    
                                    echo "<li><a href='post.php?b_name=".$row['id']."' > Get surprised </a>
                                        </li>"; 
                                }
                                

                            ?>
                                                        
                        </ul>

                        <h5>Notes</h5>
                        <ul>
                            <?php
                                $query=mysql_query("SELECT id,name,pdf,owner,data,noc,date,sharing FROM book order by noc desc ", $connection);
                                $i=0;
                                while($i<2)
                                {
                                    $i=$i+1;
                                    if($row=mysql_fetch_array($query))
                                    
                                    echo "<li><a href='post.php?b_name=".$row['id']."' > Get surprised </a>
                                        </li>"; 
                                }
                                

                            ?>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Gobana Pvt. Ltd.</strong>
                            <br>13/25 New Avenue
                            <br>New Heaven
                            <br>45Y 73J
                            <br>Trebuchene
                            <br>
                            <strong>Ireland</strong>
                        </p>

                        <a href="contact.php">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Get the news</h4>

                        <p class="text-muted">Subscribe to our newsletter.</p>

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

                <button class="btn btn-default" type="button">Subscribe!</button>

            </span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2016 Gobana Pvt. Ltd. All rights reserves</p>

                </div>
                
                <div class="hidden">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious.com</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script> ***
 _________________________________________________________ -->
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/bootstrap-hover-dropdown.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/front.js"></script>
    



</body>

</html>