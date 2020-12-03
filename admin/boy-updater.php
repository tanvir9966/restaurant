<?php

session_start();

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

    $check_username= mysqli_query($db, "SELECT username FROM `del-boy` where username = '".$_POST['uname']."' AND `id` != '".$_SESSION['b-id']."' ");
    $check_email = mysqli_query($db, "SELECT email FROM `del-boy` where email = '".$_POST['email']."' AND `id` != '".$_SESSION['b-id']."' ");




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


        $mql = "UPDATE `del-boy` SET `username` = '".$_POST['uname']."', `name` = '".$_POST['name']."', `phone` = '".$_POST['phone']."', `pass` = '".$_POST['pass']."', `address` = '".$_POST['address']."', `email` = '".$_POST['email']."' WHERE `del-boy`.`id` = '".$_SESSION['b-id']."';";
        mysqli_query($db, $mql);
        echo "Delivery boy account updated successfully.";

        ?>

        <script>
            document.getElementById("myForm").reset();
        </script>

        <?php

    }
}

?>
