<?php 
session_start();
include("../includes/db.php");
include("../includes/sidebar.php");
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<?php include("../includes/sidebar.php"); ?>
<div class="donor-dashboard">

<style>

/* PAGE BACKGROUND */
.donor-dashboard{
    font-family: Arial, sans-serif;
    min-height:100vh;
    padding:40px;
    background: linear-gradient(135deg,#1f1c2c,#928dab);
}

/* MAIN CONTENT */
.donor-dashboard .main{
    margin-left:240px;
    text-align:center;
}

/* HEADER */
.donor-dashboard h1{
    color:#2c3e50;
    font-size:34px;
}

/* WELCOME TEXT */
.donor-dashboard .welcome{
    color:#34495e;
}

/* DIVIDER */
.donor-dashboard hr{
    border:none;
    height:1px;
    background:#ccc;
    margin:30px auto;
    width:70%;
}

/* CARDS WRAPPER */
.donor-dashboard .cards{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
}

/* ===== CARD DESIGN ===== */
.donor-dashboard .card{
    width:270px;
    padding:25px;
    border-radius:14px;

  background:#eaf2ff; !important;

    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.12);
    transition:0.3s;
}

/* HOVER */
.donor-dashboard .card:hover{
    transform:translateY(-8px);
    box-shadow:0 12px 30px rgba(0,0,0,0.18);
}

/* CARD TEXT */
.donor-dashboard .card h3{
     color:#2c2c2c; 
}

.donor-dashboard .card p{
    color:#555;
}

/* BUTTON */
.donor-dashboard .card a{
    display:inline-block;
    margin-top:15px;
    padding:10px 20px;
    background:#6c5ce7;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

/* BUTTON HOVER */
.donor-dashboard .card a:hover{
    background:#00b894;
    transform:scale(1.05);
}

/* MOBILE */
@media(max-width:768px){
    .donor-dashboard .main{
        margin-left:0;
    }

    .donor-dashboard .cards{
        flex-direction:column;
        align-items:center;
    }
}

</style>


<div class="main">

<h1>Welcome Donor 👋</h1>

<p class="welcome">
Welcome, <?php echo $user['name']; ?> 👋
</p>

<hr>

<div class="cards">

<div class="card">
<h3>Available Requests</h3>
<p>View blood requests</p>
<a href="view_requests.php">Open</a>
</div>

<div class="card">
<h3>Donation History</h3>
<p>Check past donations</p>
<a href="history.php">Open</a>
</div>

<div class="card">
<h3>Profile</h3>
<p>Update details</p>
<a href="#">Coming Soon</a>
</div>

</div>

</div>

</div>