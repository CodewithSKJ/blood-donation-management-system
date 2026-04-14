<?php
include("../includes/db.php");
include("../includes/sidebar.php");
include("../includes/config.php");

/* GET ALL USERS */
$users = mysqli_query($conn,"SELECT * FROM users");
?>

<div class="admin-main">

<h1>👥 Manage Users</h1>

<div class="admin-content">

<div class="admin-card">

<table class="admin-table">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($users)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo ucfirst($row['role']); ?></td>

<td>
<a class="btn-delete"
href="delete_user.php?id=<?php echo $row['id']; ?>">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>
</div>