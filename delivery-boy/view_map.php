<?php

include("../connection/connect.php");

$o_id= $_GET['o_id'];

$qry= "SELECT * FROM `users_orders` WHERE `o_id`= '$o_id'";
$run= mysqli_query($db, $qry);
$data= mysqli_fetch_assoc($run);

$lat= $data['lat'];
$long= $data['lng'];

?>

<script>
    var lat= <?php echo $lat; ?>;
    var long= <?php echo $long; ?>;

    window.location.replace("https://www.google.com/maps/search/?api=1&query="+lat+","+long);
</script>

