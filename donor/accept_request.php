<?php
session_start();
include("../includes/config.php");

// SECURITY CHECK
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

// GET DATA
$donor_id = $_SESSION['user']['id'];
$request_id = $_GET['id'];

// CHECK IF REQUEST ALREADY ACCEPTED
$check = "SELECT status FROM blood_requests WHERE id='$request_id'";
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);

if($row['status'] == "accepted"){
    echo "Already accepted by someone!";
    exit();
}

// UPDATE REQUEST
$sql = "UPDATE blood_requests 
        SET status='accepted', donor_id='$donor_id' 
        WHERE id='$request_id'";

mysqli_query($conn, $sql);

// REDIRECT BACK
header("Location: view_requests.php");
exit();
?>