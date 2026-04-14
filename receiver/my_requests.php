<?php
session_start();
include("../includes/db.php");
include("../includes/config.php");
include("../includes/sidebar.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$result = mysqli_query($conn,"
SELECT * FROM requests 
WHERE receiver_id='$user_id'
");
?>

<div class="main">

<h1>📋 My Blood Requests</h1>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Blood Group</th>
<th>Units</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>

</div>