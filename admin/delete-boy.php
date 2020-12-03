<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
    header('location:index.php');
}


// sending query
mysqli_query($db,"DELETE FROM `del-boy` WHERE id = '".$_GET['boy_del']."'");
header("location:all-del-boy.php");

?>
