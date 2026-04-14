<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user'])){
    header("Location: /blood-donation-management-system/auth/login.php");
    exit();
}

$user = $_SESSION['user'];
$role = $user['role'];
include("../includes/db.php");
?>
<link rel="stylesheet" href="/blood-donation-management-system/assets/css/style.css">

<div class="sidebar">

<h2 style="text-align:center;">🩸 Blood Bank</h2>

<a href="/blood-donation-management-system/<?php echo $role; ?>/dashboard.php">
Dashboard
</a>

<?php if($role == "admin"){ ?>

<a href="/blood-donation-management-system/admin/manage_users.php">Manage Users</a>

<a href="/blood-donation-management-system/admin/blood_stock.php">Blood Stock</a>

<a href="/blood-donation-management-system/admin/all_requests.php">All Requests</a>

<?php } ?>

<?php if($role == "donor"){ ?>



<a href="/blood-donation-management-system/donor/view_requests.php">Requests</a>

<a href="/blood-donation-management-system/donor/history.php">Donation History</a>

<?php } ?>

<?php if($role == "receiver"){ ?>


<a href="/blood-donation-management-system/receiver/request_blood.php">Request Blood</a>

<a href="/blood-donation-management-system/receiver/my_requests.php">My Requests</a>

<?php } ?>

<hr>

<a href="/blood-donation-management-system/auth/logout.php">Logout</a>

</div>