<?php
session_start();
include("../includes/config.php");

// CHECK ADMIN
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit();
}
?>

<h1>Admin Dashboard 🧑‍💼</h1>

<hr>

<?php
// TOTAL REQUESTS
$totalReq = mysqli_query($conn, "SELECT COUNT(*) as total FROM blood_requests");
$totalReq = mysqli_fetch_assoc($totalReq)['total'];

// PENDING REQUESTS
$pendingReq = mysqli_query($conn, "SELECT COUNT(*) as total FROM blood_requests WHERE status='pending'");
$pendingReq = mysqli_fetch_assoc($pendingReq)['total'];

// ACCEPTED REQUESTS
$acceptedReq = mysqli_query($conn, "SELECT COUNT(*) as total FROM blood_requests WHERE status='accepted'");
$acceptedReq = mysqli_fetch_assoc($acceptedReq)['total'];

// TOTAL DONATIONS
$totalDonations = mysqli_query($conn, "SELECT COUNT(*) as total FROM donations");
$totalDonations = mysqli_fetch_assoc($totalDonations)['total'];
?>

<h2>System Overview</h2>

<ul>
    <li>Total Requests: <?php echo $totalReq; ?></li>
    <li>Pending Requests: <?php echo $pendingReq; ?></li>
    <li>Accepted Requests: <?php echo $acceptedReq; ?></li>
    <li>Total Donations: <?php echo $totalDonations; ?></li>
</ul>

<hr>

<a href="../auth/logout.php">Logout</a>