<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<h1>Welcome Donor 👋</h1>

<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>

<hr>

<h2>Available Actions</h2>

<ul>
    <li>View Blood Requests (Next Step)</li>
    <li>Donate Blood (Coming Next)</li>
    <li>Update Profile (Later)</li>
</ul>

<a href="../auth/logout.php">Logout</a>