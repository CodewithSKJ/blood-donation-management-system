<?php
session_start();
include("../includes/config.php");

// CHECK DONOR
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$request_id = $_GET['id'];

// UPDATE STATUS TO REJECTED
$sql = "UPDATE blood_requests SET status='rejected' WHERE id='$request_id'";
mysqli_query($conn, $sql);

header("Location: view_requests.php");
exit();
?>