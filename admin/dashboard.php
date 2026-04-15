<?php
include("../includes/sidebar.php");
include("../includes/config.php");

/* COUNTS */

$total_users =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM users")
)['total'];

$total_requests =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM requests")
)['total'];

$total_donations =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) AS total FROM donations")
)['total'];

$total_stock =
mysqli_fetch_assoc(
mysqli_query($conn,"SELECT SUM(units) AS total FROM blood_stock")
)['total'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

   <link rel="stylesheet" href="/blood-donation-management-system/assets/css/admin_dashboard.css">
</head>

<body>
<div class="admin-dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🩸 Blood Bank</h2>

        <a href="#">Dashboard</a>
        <a href="#">Users</a>
        <a href="#">Requests</a>
        <a href="#">Donations</a>
        <a href="#">Stock</a>
        <a href="#">Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <div class="header">
            <h1>Admin Dashboard</h1>
            <p>Welcome Admin 👋 Manage system efficiently</p>
        </div>

        <div class="cards">

            <div class="card">
                <div class="icon">👥</div>
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>

            <div class="card">
                <div class="icon">🩸</div>
                <h3>Total Requests</h3>
                <p><?php echo $total_requests; ?></p>
            </div>

            <div class="card">
                <div class="icon">❤️</div>
                <h3>Total Donations</h3>
                <p><?php echo $total_donations; ?></p>
            </div>

            <div class="card">
                <div class="icon">🏥</div>
                <h3>Blood Stock</h3>
                <p><?php echo $total_stock ?? 0; ?></p>
            </div>

        </div>

    </div>

</div>
</body>
</html>