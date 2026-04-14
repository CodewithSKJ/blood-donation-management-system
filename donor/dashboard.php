<?php 
session_start();
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

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>

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

<a href="../auth/logout.php">Logout</a>

</div>