<?php
include("../includes/db.php");
include("../includes/sidebar.php");
include("../includes/config.php");

/* GET ALL USERS */
$users = mysqli_query($conn,"SELECT * FROM users");
?>

<div class="admin-users-page">

<style>

/* ===== MODERN ADMIN BACKGROUND ===== */
.admin-users-page{
    font-family:'Segoe UI', Arial, sans-serif;
    min-height:100vh;
    background: linear-gradient(135deg,#f5f7fa,#c3cfe2);
}

/* ===== MAIN CONTENT ===== */
.admin-users-page .admin-main{
    margin-left:240px;
    padding:40px;
}

/* ===== TITLE ===== */
.admin-users-page h1{
    text-align:center;
    font-size:32px;
    color:#2c3e50;
    margin-bottom:35px;
}

/* ===== CENTER WRAPPER ===== */
.admin-users-page .admin-content{
    display:flex;
    justify-content:center;
}

/* ===== GLASS CARD ===== */
.admin-users-page .admin-card{
    width:100%;
    max-width:1150px;
    padding:30px;
    border-radius:16px;

    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(8px);

    box-shadow:0 15px 40px rgba(0,0,0,0.1);
}

/* ===== TABLE ===== */
.admin-users-page table{
    width:100%;
    border-collapse:collapse;
}

/* HEADER */
.admin-users-page th{
    background:#2c3e50;
    color:white;
    padding:15px;
    font-size:13px;
    letter-spacing:1px;
}

/* CELLS */
.admin-users-page td{
    padding:15px;
    text-align:center;
    color:#34495e;
    border-bottom:1px solid #eee;
}

/* ROW HOVER */
.admin-users-page tr:hover{
    background:#f4f8ff;
    transition:0.3s;
}

/* ===== ROLE BADGES ===== */
.role{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;
}

.role.admin{
    background:#ffeaa7;
    color:#d35400;
}

.role.donor{
    background:#d4f8e8;
    color:#27ae60;
}

.role.receiver{
    background:#d6eaff;
    color:#2980b9;
}

/* ===== DELETE BUTTON ===== */
.btn-delete{
    background:#e74c3c;
    color:white;
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
    transition:0.3s;
}

.btn-delete:hover{
    background:#c0392b;
    transform:scale(1.05);
}

/* ===== MOBILE ===== */
@media(max-width:768px){
    .admin-users-page .admin-main{
        margin-left:0;
        padding:20px;
    }
}

</style>

<div class="admin-main">

<h1>👥 Manage Users</h1>

<div class="admin-content">

<div class="admin-card">

<table>

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

<td>
<span class="role <?php echo strtolower($row['role']); ?>">
<?php echo ucfirst($row['role']); ?>
</span>
</td>

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
</div>