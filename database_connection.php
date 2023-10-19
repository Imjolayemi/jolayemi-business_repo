<?php
$connect = mysqli_connect("localhost", "root", "", "footweardb") or die("Cannot connect to Database".mysqli_connect_error());

return $connect;
?>