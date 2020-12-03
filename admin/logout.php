<?php
session_start();
//session_destroy();
unset($_SESSION['adm_id']);
$url = 'index.php';
header('Location: ' . $url);

?>
