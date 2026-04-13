<?php
session_start();
include("../includes/config.php");

// SECURITY CHECK
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

// FETCH PENDING REQUESTS
$sql = "SELECT * FROM blood_requests WHERE status='pending'";
$result = mysqli_query($conn, $sql);
?>

<h1>Blood Requests (Pending)</h1>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Receiver Name</th>
    <th>Blood Group</th>
    <th>Units</th>
    <th>Hospital</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['receiver_name']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>
    <td><?php echo $row['units']; ?></td>
    <td><?php echo $row['hospital']; ?></td>
    <td><?php echo $row['status']; ?></td>

    <td>
        <?php if($row['status'] == "pending") { ?>
            <a href="accept_request.php?id=<?php echo $row['id']; ?>">
                Accept
            </a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>