<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!="admin"){
    header("Location: ../auth/login.php");
    exit();
}

include("../includes/config.php");
include("../includes/sidebar.php");

$requests = mysqli_query($conn,"
SELECT requests.*, users.name
FROM requests
JOIN users ON requests.receiver_id = users.id
ORDER BY requests.id DESC
");
?>

<div class="main">

<h1>📋 All Blood Requests</h1>

<div class="card">

<table class="table">

<tr>
<th>ID</th>
<th>Receiver</th>
<th>Blood Group</th>
<th>Units</th>
<th>Status</th>
<th>Donor</th>
</tr>

<?php while($row=mysqli_fetch_assoc($requests)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['donor_id'] ?? "Not Assigned"; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>