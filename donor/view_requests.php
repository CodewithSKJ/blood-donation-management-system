<?php 
session_start();
include("../includes/db.php");
include("../includes/auth_check.php");
include("../includes/sidebar.php");

// SECURITY CHECK
if($_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

// FETCH PENDING REQUESTS
$blood_group = "";

if(isset($_GET['blood_group'])){
    $blood_group = $_GET['blood_group'];
}

if($blood_group != ""){
    $sql = "SELECT * FROM requests 
            WHERE status='pending' 
            AND blood_group='$blood_group'";
} else {
    $sql = "SELECT * FROM requests 
            WHERE status='pending'";
}
$result = mysqli_query($conn, $sql);
?>
<form method="GET">
    <input type="text" name="blood_group" placeholder="Enter Blood Group (A+, O+, etc)">
    <button type="submit">Search</button>
</form>
<div class="donor-requests-page">

<style>
/* ===== PAGE WRAPPER ===== */
.donor-requests-page {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    min-height: 100vh;
}

/* ===== MAIN CONTENT (for sidebar space) ===== */
.donor-requests-page .content-wrapper {
    margin-left: 240px; /* adjust if your sidebar width is different */
    padding: 20px;
}

/* ===== TITLE ===== */
.donor-requests-page h1 {
    text-align: center;
    color: #c0392b;
    margin-bottom: 20px;
}

/* ===== SEARCH BOX ===== */
.donor-requests-page form {
    text-align: center;
    margin-bottom: 20px;
}

.donor-requests-page form input {
    padding: 10px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.donor-requests-page form button {
    padding: 10px 15px;
    background: #c0392b;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.donor-requests-page form button:hover {
    background: #a93226;
}

/* ===== TABLE ===== */
.donor-requests-page table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
}

/* FIX: prevent layout breaking */
.donor-requests-page .table-container {
    overflow-x: auto;
}

.donor-requests-page th {
    background: #c0392b;
    color: white;
    padding: 12px;
}

.donor-requests-page td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.donor-requests-page tr:hover {
    background: #f9eaea;
}

/* ===== ACTION BUTTONS ===== */
.donor-requests-page a {
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 5px;
    color: white;
    font-size: 14px;
}

.donor-requests-page a[href*="accept"] {
    background: #27ae60;
}

.donor-requests-page a[href*="reject"] {
    background: #e74c3c;
}

.donor-requests-page a:hover {
    opacity: 0.85;
}

/* ===== BACK BUTTON ===== */
.donor-requests-page .back-btn {
    display: block;
    width: fit-content;
    margin: 20px auto;
    padding: 10px 15px;
    background: #2c3e50;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

.donor-requests-page .back-btn:hover {
    background: #1a252f;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .donor-requests-page .content-wrapper {
        margin-left: 0;
    }
}
</style>

<div class="content-wrapper">

<h1>Blood Requests (Pending)</h1>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="blood_group" placeholder="Enter Blood Group (A+, O+, etc)">
    <button type="submit">Search</button>
</form>

<!-- TABLE WRAPPER -->
<div class="table-container">

<table>
<tr>
    <th>ID</th>
    <th>Receiver ID</th>
    <th>Blood Group</th>
    <th>Units</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['receiver_id']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>
    <td><?php echo $row['units']; ?></td>
    <td><?php echo $row['status']; ?></td>

    <td>
    <?php if($row['status'] == "pending"){ ?>
        <a href="accept_request.php?id=<?php echo $row['id']; ?>">Accept</a>
        |
        <a href="reject_request.php?id=<?php echo $row['id']; ?>">Reject</a>
    <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</div>

<a class="back-btn" href="dashboard.php">Back to Dashboard</a>

</div>

</div>