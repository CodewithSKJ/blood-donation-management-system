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

<div class="my-requests-page">

<style>
/* ===== PAGE WRAPPER ===== */
.my-requests-page {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    min-height: 100vh;
    padding: 20px;
}

/* ===== TITLE ===== */
.my-requests-page h1 {
    text-align: center;
    color: #c0392b;
    margin-bottom: 20px;
}

/* ===== TABLE WRAPPER ===== */
.my-requests-page .table-box {
    margin-left: 80px; /* sidebar space */
    overflow-x: auto;
}

/* ===== TABLE ===== */
.my-requests-page table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
}

/* HEADER */
.my-requests-page th {
    background: #c0392b;
    color: white;
    padding: 14px;
    text-transform: uppercase;
    font-size: 14px;
}

/* CELLS */
.my-requests-page td {
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

/* ROW HOVER */
.my-requests-page tr:hover {
    background: #fdf2f2;
}

/* ===== STATUS BADGES ===== */
.my-requests-page .status {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 13px;
    display: inline-block;
}

/* COLORS */
.my-requests-page .pending {
    background: #f39c12;
    color: white;
}

.my-requests-page .approved {
    background: #27ae60;
    color: white;
}

.my-requests-page .rejected {
    background: #e74c3c;
    color: white;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .my-requests-page .table-box {
        margin-left: 0;
    }
}
</style>

<div class="main">

<h1>📋 My Blood Requests</h1>

<div class="table-box">

<table>
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

<td>
<?php 
$status = strtolower($row['status']);

if($status == "pending"){
    echo "<span class='status pending'>Pending</span>";
}
elseif($status == "approved"){
    echo "<span class='status approved'>Approved</span>";
}
else{
    echo "<span class='status rejected'>Rejected</span>";
}
?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>