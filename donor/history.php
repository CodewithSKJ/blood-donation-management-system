<?php 
session_start();
include("../includes/auth_check.php");
include("../includes/sidebar.php");
// SECURITY CHECK
if($_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$donor_id = $_SESSION['user']['id'];

// GET DONATION HISTORY
$sql = "SELECT * FROM donations WHERE donor_id='$donor_id' ORDER BY donation_date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="donation-history-page">

<style>

/* ===== PAGE WRAPPER ===== */
.donation-history-page {
    font-family: Arial, sans-serif;

    /* ⭐ Modern Medical Background */
    background: linear-gradient(
        135deg,
        #fff5f5,
        #fdeaea,
        #fff0f0
    );

    min-height: 100vh;
}

/* ===== CONTENT AREA (Sidebar Safe) ===== */
.donation-history-page .content-wrapper {
    margin-left:240px;
    padding:30px;

    background:white;
    border-radius:12px;

    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* ===== TITLE ===== */
.donation-history-page h1{
    text-align:center;
    color:#c0392b;
    margin-bottom:25px;
    font-weight:600;
}

/* ===== TABLE WRAPPER ===== */
.donation-history-page .table-container{
    overflow-x:auto;
}

/* ===== TABLE ===== */
.donation-history-page table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;

    box-shadow:0 6px 18px rgba(192,57,43,0.15);
}

/* ===== TABLE HEADER ===== */
.donation-history-page th{
    background:#c0392b;
    color:white;
    padding:14px;
    text-transform:uppercase;
    font-size:14px;
}

/* ===== TABLE DATA ===== */
.donation-history-page td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* ===== ROW HOVER ===== */
.donation-history-page tr:hover{
    background:#fff3f3;
    transition:0.3s;
}

/* ===== EMPTY STATE ===== */
.donation-history-page .empty{
    text-align:center;
    padding:20px;
    color:#777;
}

/* ===== BACK BUTTON ===== */
.donation-history-page .back-btn{
    display:block;
    width:fit-content;
    margin:25px auto;
    padding:10px 18px;

    background:#2c3e50;
    color:white;

    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.donation-history-page .back-btn:hover{
    background:#1a252f;
    transform:scale(1.05);
}

/* ===== RESPONSIVE ===== */
@media (max-width:768px){
    .donation-history-page .content-wrapper{
        margin-left:0;
    }
}

</style>


<div class="content-wrapper">

<h1>My Donation History 📊</h1>

<div class="table-container">

<table>

<tr>
    <th>ID</th>
    <th>Units Donated</th>
    <th>Donation Date</th>
</tr>

<?php if(mysqli_num_rows($result) > 0) { ?>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['units']; ?></td>
        <td><?php echo $row['donation_date']; ?></td>
    </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="3" class="empty">No donation history found</td>
    </tr>
<?php } ?>

</table>

</div>

<a class="back-btn" href="dashboard.php">Back to Dashboard</a>

</div>
</div>