<?php 
session_start();
include("../includes/db.php");
include("../includes/sidebar.php");
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

<h1>Welcome Donor 👋</h1>

<p class="welcome">
Welcome, <?php echo $user['name']; ?> 👋
</p>

<hr>

<div class="cards">

    <div class="card">
        <h3>Available Requests</h3>
        <p>View</p>
        <a href="view_requests.php">Open</a>
    </div>

    <div class="card">
        <h3>Donation History</h3>
        <p>Check</p>
        <a href="history.php">Open</a>
    </div>

    <div class="card">
        <h3>Profile</h3>
        <p>Update</p>
        <a href="#">Coming Soon</a>
    </div>

</div>


</div>