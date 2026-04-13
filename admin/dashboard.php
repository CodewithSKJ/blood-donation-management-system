<?php
session_start();
if($_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
}
?>

<h1>Admin Dashboard</h1>
<a href="../auth/logout.php">Logout</a>