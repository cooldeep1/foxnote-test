<?php
//echo"in";
//session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$error1=''; 
$error2=''; 
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("sql105.lockernerd.co.uk", "lnw_17056803", "x1bzc5tq");
$db = mysql_select_db("lnw_17056803_gobana", $connection);
 
//echo 1;
if (isset($_POST['submit'])) {
    
    if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['password'])) {
        $error = "Email ,Name or Password is empty";
        }   
    else
        {
        // Define $username and $password
        $username=$_POST['email'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $name = stripslashes($name);
        $password = stripslashes($password);
        $name = mysql_real_escape_string($name);
        $password = mysql_real_escape_string($password);
        // Selecting Database
        //$db =mysql_select_db("a8202403_company", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("select * from user where email='$username'", $connection);
         
        
        $rows = mysql_num_rows($query);
        if ($rows == 0) {
            //echo "INSERT INTO user (id,name,email,password) VALUES ('3','$name','$username','$password')";
            $query = mysql_query("INSERT INTO user (user,email,password) VALUES ('$name','$username','$password')", $connection);
            $error="Registration Successful";
        } 
        else {
        $error = "Email already registered!";
        }
    }
        //mysql_close($connection); // Closing Connection
    }
    
//echo $error;
    

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
        Obaju : e-commerce template
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">



</head>

<body>
   <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top" style="height:50px">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="index.php" class="btn btn-success btn-sm" data-animate-hover="shake" style="height:35px; font-size:20px">GOBANA</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal" style="height:35px; font-size:20px">Login</a>
                    </li>
                    <li><a href="register.php" style="height:35px; font-size:20px">Register</a>
                    </li>
                    <li><a href="contact.php" style="height:35px; font-size:20px">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email" name="email-modal">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password" name="password-modal">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" name="submit"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->
    <br />

 
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of information and notes and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
                        <?php echo $error;?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                        <p class="text-muted">Sign in and start exploring.</p>

                        <hr>

                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email-modal"  name="email-modal">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password-modal" name="password-modal">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-sign-in"></i> Log in</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


         <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            
                            <li><a href="#">Terms and conditions</a>
                            </li>
                            <li><a href="#">FAQ</a>
                            </li>
                            <li><a href="contact.php">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.php">Register</a>
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
                        </ul>

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
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2016 Gobana pvt. ltd. All rights reserves</p>

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

    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>



</body>

</html>
