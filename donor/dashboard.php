<?php 
session_start();
include("../includes/auth_check.php");
include("../includes/sidebar.php");

$user = $_SESSION['user'];

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}
?>
<?php include("../includes/sidebar.php"); ?>

<div class="main">

<h1>Welcome Donor 👋</h1>

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>

<hr>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

<!-- REQUESTS CARD -->
<a href="view_requests.php" style="text-decoration:none;">
<div style="background:#3498db; color:white; padding:20px; width:200px; border-radius:10px; transition:0.3s;">
    <h3>Requests</h3>
    <p>View Blood Requests</p>
</div>
</a>

<!-- DONATE CARD -->
<a href="view_requests.php" style="text-decoration:none;">
<div style="background:#2ecc71; color:white; padding:20px; width:200px; border-radius:10px; transition:0.3s;">
    <h3>Donate</h3>
    <p>Accept Requests</p>
</div>
</a>

<!-- HISTORY CARD -->
<a href="history.php" style="text-decoration:none;">
<div style="background:#9b59b6; color:white; padding:20px; width:200px; border-radius:10px; transition:0.3s;">
    <h3>History</h3>
    <p>Your Donations</p>
</div>
</a>

</div>
<a href="../auth/logout.php">Logout</a>