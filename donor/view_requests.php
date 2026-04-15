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
<div class="donor-requests-page">

<style>

/* ===== PAGE BACKGROUND ===== */
.donor-requests-page{
    font-family: Arial, sans-serif;

    /* ⭐ NEW SOFT MEDICAL BACKGROUND */
    background: linear-gradient(
        135deg,
        #fff6f6,
        #fdeaea,
        #fff1f1
    );

    min-height:100vh;
}

/* ===== CONTENT WRAPPER ===== */
.donor-requests-page .content-wrapper{
    margin-left:240px;
    padding:30px;

    background:white;
    border-radius:12px;

    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* ===== TITLE ===== */
.donor-requests-page h1{
    text-align:center;
    color:#c0392b;
    margin-bottom:25px;
}

/* ===== SEARCH BOX ===== */
.donor-requests-page form{
    text-align:center;
    margin-bottom:25px;
}

.donor-requests-page form input{
    padding:10px;
    width:260px;
    border:1px solid #ccc;
    border-radius:6px;
    outline:none;
}

.donor-requests-page form input:focus{
    border-color:#c0392b;
}

/* SEARCH BUTTON */
.donor-requests-page form button{
    padding:10px 18px;
    background:#c0392b;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.donor-requests-page form button:hover{
    background:#a93226;
    transform:scale(1.05);
}

/* ===== TABLE WRAPPER ===== */
.donor-requests-page .table-container{
    overflow-x:auto;
}

/* ===== TABLE ===== */
.donor-requests-page table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;

    box-shadow:0 6px 18px rgba(192,57,43,0.15);
}

/* ===== TABLE HEADER ===== */
.donor-requests-page th{
    background:#c0392b;
    color:white;
    padding:14px;
}

/* ===== TABLE DATA ===== */
.donor-requests-page td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* ROW HOVER */
.donor-requests-page tr:hover{
    background:#fff3f3;
    transition:0.3s;
}

/* ===== ACTION BUTTONS ===== */
.donor-requests-page a{
    text-decoration:none;
    padding:7px 12px;
    border-radius:6px;
    color:white;
    font-size:14px;
    font-weight:bold;
    transition:0.3s;
}

/* ACCEPT */
.donor-requests-page a[href*="accept"]{
    background:#27ae60;
}

.donor-requests-page a[href*="accept"]:hover{
    background:#1e8449;
    transform:scale(1.05);
}

/* REJECT */
.donor-requests-page a[href*="reject"]{
    background:#e74c3c;
}

.donor-requests-page a[href*="reject"]:hover{
    background:#c0392b;
    transform:scale(1.05);
}

/* ===== BACK BUTTON ===== */
.donor-requests-page .back-btn{
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

.donor-requests-page .back-btn:hover{
    background:#1a252f;
    transform:scale(1.05);
}

/* ===== MOBILE ===== */
@media(max-width:768px){
    .donor-requests-page .content-wrapper{
        margin-left:0;
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

<!-- TABLE -->
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
    <?php if($row['status']=="pending"){ ?>
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