<?php

session_start();

date_default_timezone_set('Asia/Dhaka');

include("connection/connect.php");

$lat = $_POST['one'];
$long = $_POST['two'];

$msg= 0;
$success= 0;

if ($lat == null or $long == null)
{
    echo "There is some problem to get your location. You can write your address manually above the address box.";
}

else
{
    foreach ($_SESSION["cart_item"] as $item)
    {

        $item_total= 0;
        $item_total += ($item["price"]*$item["quantity"]);

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

        if( strtotime($date) > strtotime('now') )
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

        if ($msg == 0)
        {
            if ($date == null)
            {
                echo "Please select a date to order.";
                $msg++;
            }

            elseif ($dif < 0)
            {
                echo "You can not order before today.";
                $msg++;
            }

            elseif ($dif > 7)
            {
                echo "You can order till maximum 7 days from today.";
                $msg++;
            }

            elseif ($state == 'am' and (($time >= 1 and $time < 9) or $time > 11))
            {
                echo "Please order from 9 AM to 8 PM.";
                $msg++;
            }

            elseif ($state == 'pm' and $time > 8 and $time < 12)
            {
                echo "Please order from 9 AM to 8 PM.";
                $msg++;
            }

            elseif ($dif == 0 and $time_chk == 0)
            {
                echo "Please order at least 1 hour later from now.";
                $msg++;
            }

            else
            {
                $SQL="insert into users_orders(u_id,title,quantity,price,lat,lng,date,time,state) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item_total."', '$lat', '$long', '$date', '$time', '$state')";

                mysqli_query($db,$SQL);

                if ($success == 0)
                {
                    $success++;

                    ?>

                    <script>
                        alert("Order completed successfully.");

                        document.getElementById("pos").reset();

                        window.location.replace("your_orders.php");
                    </script>

                    <?php
                }
            }
        }
    }
}


