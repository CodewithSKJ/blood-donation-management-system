<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!="receiver"){
    header("Location: ../auth/login.php");
    exit();
}
include("../includes/db.php");
include("../includes/config.php");
include("../includes/sidebar.php");

$receiver_id = $_SESSION['user']['id'];

if(isset($_POST['request'])){

    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    $query = "INSERT INTO requests
    (receiver_id, blood_group, units, status)
    VALUES
    ('$receiver_id','$blood_group','$units','pending')";

    mysqli_query($conn,$query);

    echo "<script>alert('Blood Request Submitted');</script>";
}
?>

<div class="request-page">

<style>
/* ===== UNIQUE BACKGROUND (different from register) ===== */
.request-page {
    font-family: 'Segoe UI', Arial, sans-serif;
    min-height: 100vh;
    padding: 30px;

    background: linear-gradient(135deg, #1f4037, #99f2c8);

    display: flex;
    flex-direction: column;
    align-items: center;
}

/* TITLE */
.request-page h1 {
    color: #1f2d3d;  /* dark professional color */
    font-size: 34px;
    margin-bottom: 20px;
    text-shadow: none;
}
/* CARD */
.request-page .card1 {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    border-radius: 15px;
    padding: 30px;
    width: 350px;

    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* LABEL */
.request-page label {
    color: #2c3e50;  /* dark readable color */
    font-weight: bold;
    display: block;
    margin-top: 10px;
    margin-bottom: 5px;
}
/* INPUT + SELECT */
.request-page select,
.request-page input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    margin-bottom: 10px;
    font-size: 14px;
    color: #2c3e50;  /* important */
    background: #fff;
}

/* BUTTON */
.request-page button {
    width: 100%;
    padding: 12px;
    background: #2c3e50;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.request-page button:hover {
    background: #1a252f;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .request-page .card1 {
        width: 90%;
    }
}
</style>

<div class="main1">

<h1>🩸 Request Blood</h1>

<div class="card1">

<form method="POST">

<label>Blood Group</label>
<select name="blood_group" required>
    <option value="">Select Blood Group</option>
    <option>A+</option>
    <option>A-</option>
    <option>B+</option>
    <option>B-</option>
    <option>O+</option>
    <option>O-</option>
    <option>AB+</option>
    <option>AB-</option>
</select>

<label>Units Required</label>
<input type="number" name="units" placeholder="Enter Units" required>

<button name="request">Submit Request</button>

</form>

</div>

</div>
</div>