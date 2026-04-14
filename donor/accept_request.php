<?php 
session_start();
include("../includes/db.php");
include("../includes/config.php");
include("../includes/auth_check.php");

/* ROLE CHECK */
if($_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$donor_id = $_SESSION['user']['id'];
$request_id = $_GET['id'];


/* ==============================
   STEP 1 — GET REQUEST DATA
================================*/
$getRequest = "SELECT * FROM requests 
WHERE id='$request_id' AND status='pending'";

$requestResult = mysqli_query($conn, $getRequest);
$request = mysqli_fetch_assoc($requestResult);

if(!$request){
    echo "Invalid or already accepted request.";
    exit();
}

$blood_group = $request['blood_group'];
$units = $request['units'];


/* ==============================
   STEP 2 — CHECK BLOOD STOCK
================================*/
$stockQuery = "SELECT * FROM blood_stock 
WHERE blood_group='$blood_group'";

$stockResult = mysqli_query($conn, $stockQuery);
$stock = mysqli_fetch_assoc($stockResult);

if(!$stock || $stock['units'] < $units){
    echo "Not enough blood stock!";
    exit();
}


/* ==============================
   STEP 3 — ACCEPT REQUEST
================================*/
$updateRequest = "UPDATE requests 
SET status='accepted', donor_id='$donor_id' 
WHERE id='$request_id'";

mysqli_query($conn, $updateRequest);


/* ==============================
   STEP 4 — AUTO DEDUCT STOCK 🔥
================================*/
$updateStock = "UPDATE blood_stock 
SET units = units - '$units' 
WHERE blood_group='$blood_group'";

mysqli_query($conn, $updateStock);


/* ==============================
   STEP 5 — SAVE DONATION RECORD
================================*/
$insertDonation = "INSERT INTO donations 
(donor_id, request_id, blood_group, units, donation_date)
VALUES 
('$donor_id', '$request_id', '$blood_group', '$units', NOW())";

mysqli_query($conn, $insertDonation);


/* ==============================
   STEP 6 — REDIRECT
================================*/
header("Location: view_requests.php");
exit();

?>