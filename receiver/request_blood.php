<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "receiver"){
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['request'])){

$name = $_POST['name'];
$blood_group = $_POST['blood_group'];
$units = $_POST['units'];
$hospital = $_POST['hospital'];

$sql = "INSERT INTO blood_requests(receiver_name,blood_group,units,hospital,status)
VALUES('$name','$blood_group','$units','$hospital','pending')";

mysqli_query($conn,$sql);

echo "Blood Request Sent!";
}
?>

<h2>Request Blood</h2>

<form method="POST">
Name: <input type="text" name="name"><br><br>

Blood Group:
<select name="blood_group">
<option>A+</option>
<option>B+</option>
<option>O+</option>
<option>AB+</option>
</select><br><br>

Units: <input type="number" name="units"><br><br>

Hospital: <input type="text" name="hospital"><br><br>

<button type="submit" name="request">Send Request</button>
</form>