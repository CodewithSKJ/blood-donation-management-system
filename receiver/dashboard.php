<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
include("../includes/db.php");
include("../includes/sidebar.php");
?>

<div class="main">

<h1 class="page-title">🩸 Receiver Dashboard</h1>

<p class="welcome">
Welcome, <?php echo $user['name']; ?> 👋
</p>

<hr>

<div class="cards">

<div class="card">
<h3>Request Blood</h3>
<p>Create new blood request</p>
<a href="request_blood.php">Open</a>
</div>

<div class="card">
<h3>My Requests</h3>
<p>Check request status</p>
<a href="my_requests.php">Open</a>
</div>

<div class="card">
<h3>Profile</h3>
<p>Update later</p>
<a href="#">Coming Soon</a>
</div>

</div>

</div>