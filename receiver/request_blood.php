<?php
session_start();
include("../includes/config.php");

if($_SESSION['user']['role']!="receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$receiver_id=$_SESSION['user']['id'];

if(isset($_POST['request'])){

$blood_group=$_POST['blood_group'];
$units=$_POST['units'];

$query="INSERT INTO blood_requests
(receiver_id,blood_group,units,status)
VALUES('$receiver_id','$blood_group','$units','pending')";

mysqli_query($conn,$query);

echo "Request Sent Successfully ✅";
}
?>

<h2>Request Blood</h2>

<form method="POST">

<select name="blood_group" required>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>O+</option>
<option>O-</option>
<option>AB+</option>
<option>AB-</option>
</select>

<input type="number" name="units" placeholder="Units Needed" required>

<button name="request">Send Request</button>

</form>