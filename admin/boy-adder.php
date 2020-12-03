<?php


error_reporting(0);
include("../connection/connect.php");

if(empty($_POST['uname']) ||
    empty($_POST['name'])||
    empty($_POST['email'])||
    empty($_POST['pass'])||
    empty($_POST['phone']) ||
    empty($_POST['address']))
{
    echo "All fields are required.";
}
else
{

    $check_username= mysqli_query($db, "SELECT username FROM `del-boy` where username = '".$_POST['uname']."' ");
    $check_email = mysqli_query($db, "SELECT email FROM `del-boy` where email = '".$_POST['email']."' ");




    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        echo "Please enter a valid email address.";
    }
    elseif(strlen($_POST['pass']) < 6)
    {
        echo "Password must be at least 6 digit.";
    }

    elseif(strlen($_POST['phone']) < 10)
    {
        echo "Invalid phone.";
    }
    elseif(mysqli_num_rows($check_username) > 0)
    {
        echo "Username already exist.";
    }
    elseif(mysqli_num_rows($check_email) > 0)
    {
        echo "Email already exist.";
    }
    else{


        $mql = "INSERT INTO `del-boy` (`id`, `username`, `name`, `phone`, `pass`, `address`, `email`) VALUES (NULL, '".$_POST['uname']."', '".$_POST['name']."', '".$_POST['phone']."', '".$_POST['pass']."', '".$_POST['address']."', '".$_POST['email']."');";
        mysqli_query($db, $mql);
        echo "New delivery boy has been added.";

        ?>

        <script>
            document.getElementById("myForm").reset();
        </script>

        <?php

    }
}

?>
