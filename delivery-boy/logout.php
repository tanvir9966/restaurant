<?php
session_start();
unset($_SESSION['boy-id']);
$url = 'index.php';
header('Location: ' . $url);

?>
