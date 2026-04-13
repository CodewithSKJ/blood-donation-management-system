<?php
session_start();
if($_SESSION['user']['role'] != "receiver"){
    header("Location: ../auth/login.php");
}
?>

<h1>Receiver Dashboard</h1>
<a href="../auth/logout.php">Logout</a>