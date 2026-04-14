<?php
session_start();
include("../includes/config.php");

if($_SESSION['user']['role']!="receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$receiver_id=$_SESSION['user']['id'];

$requests=mysqli_query($conn,
"SELECT * FROM blood_requests WHERE receiver_id='$receiver_id'");
?>

<h2>My Requests</h2>

<table border="1" cellpadding="10">
<tr>
<th>Blood Group</th>
<th>Units</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($requests)){ ?>

<tr>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>