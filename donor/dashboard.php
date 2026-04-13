<?php 
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<?php include("../includes/sidebar.php"); ?>

<div style="margin-left:220px; padding:20px;">

<h1>Welcome Donor 👋</h1>

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>

<hr>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

<!-- CARD 1 -->
<div style="background:#3498db; color:white; padding:20px; width:200px; border-radius:10px; transition:0.3s;">
    <h3>Requests</h3>
    <p>View Blood Requests</p>
</div>

<!-- CARD 2 -->
<div style="background:#2ecc71; color:white; padding:20px; width:200px; border-radius:10px;">
    <h3>Donate</h3>
    <p>Accept Requests</p>
</div>

<!-- CARD 3 -->
<div style="background:#9b59b6; color:white; padding:20px; width:200px; border-radius:10px;">
    <h3>History</h3>
    <p>Your Donations</p>
</div>

</div>

</div>

<a href="../auth/logout.php">Logout</a>