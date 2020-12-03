<?php
session_start(); //start session
//session_destroy(); // distroy all the current sessions
unset($_SESSION["user_id"]);
$url = 'login.php';
header('Location: ' . $url); // redireted to login page

?>
