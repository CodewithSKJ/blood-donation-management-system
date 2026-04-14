<?php
session_start();

if($_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit();
}

include("../includes/config.php");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location: manage_users.php");
exit();
?>