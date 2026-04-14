<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!="receiver"){
    header("Location: ../auth/login.php");
    exit();
}
include("../includes/db.php");
include("../includes/config.php");
include("../includes/sidebar.php");

$receiver_id = $_SESSION['user']['id'];

if(isset($_POST['request'])){

    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    $query = "INSERT INTO requests
    (receiver_id, blood_group, units, status)
    VALUES
    ('$receiver_id','$blood_group','$units','pending')";

    mysqli_query($conn,$query);

    echo "<script>alert('Blood Request Submitted');</script>";
}
?>

<div class="main1">

<h1>🩸 Request Blood</h1>

<div class="card1">

<form method="POST">

<label>Blood Group</label>
<select name="blood_group" required>
<option value="">Select Blood Group</option>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>O+</option>
<option>O-</option>
<option>AB+</option>
<option>AB-</option>
</select>

<br><br>

<label>Units Required</label>
<input type="number" name="units" placeholder="Enter Units" required>

<br><br>

<button name="request">Submit Request</button>

</form>

</div>

</div>