<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index

if (empty($_SESSION["user_id"]))
{
    ?>

    <script>
        location.replace("login.php");
    </script>

    <?php
}

include("connection/connect.php"); // connection
if(isset($_POST['submit'] )) //if submit btn is pressed
{
    if(empty($_POST['firstname']) ||
        empty($_POST['username']) ||
        empty($_POST['lastname'])||
        empty($_POST['email']) ||
        empty($_POST['phone'])||
        empty($_POST['password'])||
        empty($_POST['cpassword']) ||
        empty($_POST['address']))
    {
        $message = "All fields must be Required!";
    }
    else
    {
        //cheching username & email if already present
        $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' AND `u_id` != '".$_SESSION["user_id"]."' ");
        $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' AND `u_id` != '".$_SESSION["user_id"]."' ");



        if($_POST['password'] != $_POST['cpassword']){  //matching passwords
            $message = "Password not match";
        }
        elseif(strlen($_POST['password']) < 6)  //cal password length
        {
            $message = "Password Must be >=6";
        }
        elseif(strlen($_POST['phone']) < 10)  //cal phone length
        {
            $message = "invalid phone number!";
        }

        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $message = "Invalid email address please type a valid email!";
        }
        elseif(mysqli_num_rows($check_username) > 0)  //check username
        {
            $message = 'username Already exists!';
        }
        elseif(mysqli_num_rows($check_email) > 0) //check email
        {
            $message = 'Email Already exists!';
        }
        else{

            //inserting values into db
            $mql = "UPDATE `users` SET `username` = '".$_POST['username']."', `f_name` = '".$_POST['firstname']."', `l_name` = '".$_POST['lastname']."', `email` = '".$_POST['email']."', `phone` = '".$_POST['phone']."', `password` = '".md5($_POST['password'])."', `address` = '".$_POST['address']."' WHERE `users`.`u_id` = '".$_SESSION["user_id"]."';";
            mysqli_query($db, $mql);
            $success = "Account updated successfully!";
        }
    }

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Edit profile</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
<div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/retake.png" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                        <?php
                        if(empty($_SESSION["user_id"]))
                        {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                        }
                        else
                        {
                            echo  '<li class="nav-item"><a href="edit-profile.php" class="nav-link active">Edit profile</a> </li>';
                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
                                echo  '<li class="nav-item"><a href="pending-orders.php" class="nav-link active">Pending orders</a> </li>';
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
                        }

                        ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#" class="active">
                            <span style="color:red;"><?php echo $message; ?></span>
                            <span style="color:green;">
								<?php echo $success; ?>
										</span>

                        </a></li>

                </ul>
            </div>
        </div>

        <?php

        $qry= "SELECT * FROM `users` WHERE `u_id` = '".$_SESSION["user_id"]."'";
        $run= mysqli_query($db, $qry);
        $data= mysqli_fetch_assoc($run);

        ?>

        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <!-- REGISTER -->
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-body">

                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="exampleInputEmail1">User-Name</label>
                                            <input class="form-control" type="text" name="username" value="<?php echo $data['username']; ?>" id="example-text-input" placeholder="UserName">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input class="form-control" type="text" name="firstname" value="<?php echo $data['f_name']; ?>" id="example-text-input" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input class="form-control" type="text" name="lastname" value="<?php echo $data['l_name']; ?>" id="example-text-input-2" placeholder="Last Name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Phone number</label>
                                            <input class="form-control" type="text" name="phone" value="<?php echo $data['phone']; ?>" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted">We"ll never share your email with anyone else.</small>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Repeat password</label>
                                            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="exampleTextarea">Delivery Address</label>
                                            <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"><?php echo $data['address']; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p> <input type="submit" value="Update" name="submit" class="btn theme-btn"> </p>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                    </div>
                </div>
            </div>
        </section>

        <!-- start: FOOTER -->
        <?php
        include "footer.html";
        ?>
        <!-- end:Footer -->
    </div>
    <!-- end:page wrapper -->
</div>
<!--/end:Site wrapper -->
<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/foodpicky.min.js"></script>
</body>

</html>
