<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT * FROM blood_requests WHERE status='pending'";
$result = mysqli_query($conn,$sql);
?>

<h1>Blood Requests (Pending)</h1>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Blood Group</th>
    <th>Units</th>
    <th>Hospital</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['receiver_name']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>
    <td><?php echo $row['units']; ?></td>
    <td><?php echo $row['hospital']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>