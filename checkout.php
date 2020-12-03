<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
date_default_timezone_set('Asia/Dhaka');
include_once 'product-action.php';
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

										        $total=0;

												foreach ($_SESSION["cart_item"] as $item)
												{
                                                    $item_total= 0;
												    $item_total += ($item["price"]*$item["quantity"]);
                                                    $total= $total+ $item_total;

                                                    if($_POST['submit'])
													{
													    $address= $_POST['address'];
													    $date= $_POST['date'];
													    $time= $_POST['time'];
													    $state= $_POST['state'];

													    if ($state == 'pm')
                                                        {
                                                            if ($time < 12)
                                                                $tmp_time= $time + 12;
                                                            else
                                                                $tmp_time= $time;
                                                        }
													    if($state == 'am')
                                                        {
                                                            if ($time == 12)
                                                                $tmp_time= 0;
                                                            else
                                                                $tmp_time= $time;
                                                        }

													    $time_chk= 1;
                                                        $to_time = strtotime($tmp_time .":00");
                                                        $from_time= strtotime(date("H:i"));

                                                        if( $to_time > $from_time )
                                                        {
                                                            $time_dif= round(abs($to_time - $from_time) / 60,2);

                                                            if ($time_dif < 60)
                                                                $time_chk= 0;
                                                        }

                                                        else
                                                            $time_chk= 0;

                                                        if( strtotime($date) > strtotime('now'))
                                                            $checker= 1;
                                                        else
                                                            $checker= -1;

                                                        $month= date("m",strtotime($date));
                                                        $year= date("Y",strtotime($date));
                                                        $day= date("d",strtotime($date));

                                                        $date1= $day . "-" . $month . "-" . $year;

                                                        $date1= date_create($date1);
                                                        $date2= date("Y-m-d");
                                                        $date2= date_create($date2);

                                                        $diff = date_diff($date1, $date2);
                                                        $dif= $diff->format("%a") + 0;
                                                        $dif= $dif * $checker;

													    if ($address == null)
                                                            $success = "Please enter your address";

													    elseif ($date == null)
                                                        {
                                                            $success = "Please select a date to order.";
                                                        }

                                                        elseif ($dif < 0)
                                                        {
                                                            $success = "You can not order before today.";
                                                        }

                                                        elseif ($dif > 7)
                                                        {
                                                            $success = "You can order till maximum 7 days from today.";
                                                        }

                                                        elseif ($state == 'am' and (($time >= 1 and $time < 9) or $time > 11))
                                                        {
                                                            $success = "Please order from 9 AM to 8 PM.";
                                                        }

                                                        elseif ($state == 'pm' and $time > 8 and $time < 12)
                                                        {
                                                            $success = "Please order from 9 AM to 8 PM.";
                                                        }

                                                        elseif ($dif == 0 and $time_chk == 0)
                                                        {
                                                            $success = "Please order at least 1 hour later from now.";
                                                        }

													    else
                                                        {
                                                            $SQL="insert into users_orders(u_id,title,quantity,price,address,date,time,state) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item_total."', '$address', '$date', '$time', '$state')";

                                                            mysqli_query($db,$SQL);

                                                            $success = "Thankyou! Your Order Placed successfully!";
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
    <title>Checkout</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="site-wrapper">
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
            <div class="top-links" style="margin-top: 15px;">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                                    <tr>
                                                        <td>Shipping &amp; Handling</td>
                                                        <td>free shipping</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo "৳".$total; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Bkash/Rocket (Comming soon)<img src="images/bkash-rocket.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>

                                        <div class="form-group">
                                            <label for="date">Order date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Time: &nbsp;</label>
                                            <select name="time" class="custom-select" style="font-weight: bold">

                                                <?php

                                                for ($i= 1; $i<=12; $i++)
                                                {
                                                    ?>

                                                    <option value= <?php echo $i ?>><?php echo $i ?></option>

                                                    <?php
                                                }

                                                ?>

                                            </select>

                                            &nbsp; &nbsp; <select class="custom-select" name="state" style="font-weight: bold">
                                                <option value="am">AM</option>
                                                <option value="pm">PM</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="address">Delivery Address</label>
                                            <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                        </div>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
<!--                                        <p class="text-xs-center"> <input type="submit" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>-->
                                    </div>
									</form>

                        <form method="post" id="map-form" action="map.php">
                            <div class="row">

                                <div class="col-sm-12">
                                    <!--cart summary-->
                                    <h3 style="margin-top: 80px">You can also choose your location on google map</h3>
                                    <div class="payment-option">

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" id="open"> Open Map </button>
                                        </div>
<!--                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>-->
                                    </div>
                        </form>
                        <div id="open-map"></div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>

                        <script type="text/javascript">
                            $("#open").click( function() {
                                $.post( $("#map-form").attr("action"),
                                    $("#map-form :input").serializeArray(),
                                    function(info){ $("#open-map").html(info);
                                    });
                            });

                            $("#map-form").submit( function() {
                                return false;
                            });
                        </script>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>

            <!-- start: FOOTER -->
         <?php
         include "footer.html";
         ?>
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
         </div>
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

<?php
}
?>
