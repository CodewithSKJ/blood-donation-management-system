<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit();
}

include("../includes/config.php");
include("../includes/sidebar.php");

/* Total Users */
$user_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM users");
$total_users = mysqli_fetch_assoc($user_query)['total'];

/* Total Requests */
$request_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM requests");
$total_requests = mysqli_fetch_assoc($request_query)['total'];

/* Total Donations */
$donation_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM donations");
$total_donations = mysqli_fetch_assoc($donation_query)['total'];

/* Blood Stock */
$stock_query = mysqli_query($conn,"SELECT SUM(units) AS total FROM blood_stock");
$total_stock = mysqli_fetch_assoc($stock_query)['total'];
?>

<div class="main">

<h1>🧑‍💼 Admin Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Total Users</h3>
<p><?php echo $total_users; ?></p>
</div>

<div class="card">
<h3>Total Requests</h3>
<p><?php echo $total_requests; ?></p>
</div>

<div class="card">
<h3>Total Donations</h3>
<p><?php echo $total_donations; ?></p>
</div>

<div class="card">
<h3>Blood Stock</h3>
<p><?php echo $total_stock ?? 0; ?></p>
</div>

</div>

</div>