<?php
session_start();
include("../includes/config.php");
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit();
}

// STATS
$totalReq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM blood_requests"))['total'];
$pendingReq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM blood_requests WHERE status='pending'"))['total'];
$acceptedReq = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM blood_requests WHERE status='accepted'"))['total'];
$totalDonations = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM donations"))['total'];
?>

<div class="container mt-4">

<h2 class="text-center mb-4">🧑‍💼 Admin Dashboard</h2>

<div class="row">

<div class="col-md-3">
<div class="card text-bg-primary mb-3">
<div class="card-body">
<h5>Total Requests</h5>
<h3><?php echo $totalReq; ?></h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-bg-warning mb-3">
<div class="card-body">
<h5>Pending</h5>
<h3><?php echo $pendingReq; ?></h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-bg-success mb-3">
<div class="card-body">
<h5>Accepted</h5>
<h3><?php echo $acceptedReq; ?></h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-bg-danger mb-3">
<div class="card-body">
<h5>Donations</h5>
<h3><?php echo $totalDonations; ?></h3>
</div>
</div>
</div>

</div>

</div>