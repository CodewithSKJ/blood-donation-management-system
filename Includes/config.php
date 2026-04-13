<?php
$conn = mysqli_connect("localhost","root","","blood_bank");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
