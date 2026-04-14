<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../includes/db.php");
include("../includes/auth_check.php");

/* ROLE CHECK */
if($_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

/* CHECK ID */
if(!isset($_GET['id'])){
    echo "Request ID missing";
    exit();
}

$donor_id = $_SESSION['user']['id'];
$request_id = $_GET['id'];

/* STEP 1 — GET REQUEST */
$getRequest = "SELECT * FROM requests 
WHERE id='$request_id' AND status='pending'";

$requestResult = mysqli_query($conn, $getRequest);

if(!$requestResult || mysqli_num_rows($requestResult) == 0){
    echo "Request not found or already processed";
    exit();
}

$request = mysqli_fetch_assoc($requestResult);

$blood_group = $request['blood_group'];
$units = $request['units'];

/* STEP 2 — CHECK STOCK */
$stockQuery = "SELECT * FROM blood_stock 
WHERE blood_group='$blood_group'";

$stockResult = mysqli_query($conn, $stockQuery);

if(!$stockResult || mysqli_num_rows($stockResult) == 0){
    echo "Stock not found";
    exit();
}

$stock = mysqli_fetch_assoc($stockResult);

if($stock['units'] < $units){
    echo "Not enough blood stock";
    exit();
}

/* STEP 3 — ACCEPT REQUEST */
mysqli_query($conn, "UPDATE requests 
SET status='approved', donor_id='$donor_id' 
WHERE id='$request_id'");

/* STEP 4 — UPDATE STOCK */
mysqli_query($conn, "UPDATE blood_stock 
SET units = units - $units 
WHERE blood_group='$blood_group'");

/* STEP 5 — INSERT DONATION */
mysqli_query($conn, "INSERT INTO donations 
(donor_id, request_id, blood_group, units, donation_date)
VALUES 
('$donor_id', '$request_id', '$blood_group', '$units', NOW())");

/* STEP 6 — REDIRECT */
header("Location: view_requests.php");
exit();
?>