<?php
session_start();
include("../includes/sidebar.php");
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!="receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$user=$_SESSION['user'];
?>

<div class="main">

<h1>Welcome Receiver 👋</h1>

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>

<hr>

<a href="request_blood.php">Request Blood</a><br><br>
<a href="my_requests.php">My Requests</a><br><br>
<a href="../auth/logout.php">Logout</a>

</div>