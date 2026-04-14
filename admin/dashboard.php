<?php
include("../includes/sidebar.php");
include("../includes/config.php");

/* COUNTS */

$total_users =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM users")
)['total'];

$total_requests =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM requests")
)['total'];

$total_donations =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM donations")
)['total'];

$total_stock =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT SUM(units) AS total FROM blood_stock")
)['total'];
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