<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "receiver"){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user'];
include("../includes/db.php");
include("../includes/sidebar.php");
?>

<div class="receiver-dashboard">

<style>
/* ===== FULL PAGE BACKGROUND ===== */
.receiver-dashboard {
    font-family: 'Segoe UI', Arial, sans-serif;
    min-height: 100vh;
    padding: 30px;

    /* Modern animated gradient */
    background: linear-gradient(-45deg, #c0392b, #8e44ad, #3498db, #16a085);
    background-size: 400% 400%;
    animation: gradientMove 10s ease infinite;
}

/* Background animation */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== TITLE ===== */
.receiver-dashboard .page-title {
    text-align: center;
    font-size: 38px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #1f2d3d; /* dark professional color */
}

/* ===== WELCOME TEXT ===== */
.receiver-dashboard .welcome {
    text-align: center;
    font-size: 18px;
    color: #2c3e50; /* readable dark gray */
    margin-bottom: 25px;
}
/* ===== CARDS WRAPPER ===== */
.receiver-dashboard .cards {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}

/* ===== GLASS CARD STYLE ===== */
.receiver-dashboard .card {
    width: 270px;
    padding: 25px;
    border-radius: 15px;

    /* glass effect */
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    border: 1px solid rgba(255,255,255,0.3);
    text-align: center;

    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* hover effect */
.receiver-dashboard .card:hover {
    transform: translateY(-10px) scale(1.03);
    background: rgba(255,255,255,0.25);
}

/* CARD TITLE */
.receiver-dashboard .card h3 {
    color: #2c3e50;
    font-size: 20px;
    margin-bottom: 10px;
}

/* TEXT */
.receiver-dashboard .card p {
     color: #5d6d7e; 
    margin-bottom: 15px;
}

/* BUTTON */
.receiver-dashboard .card a {
    display: inline-block;
    padding: 10px 18px;
     background: #ffffff;
    color: #c0392b;
    font-weight: bold;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

.receiver-dashboard .card a:hover {
    background: #c0392b;
    color: white;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .receiver-dashboard .cards {
        flex-direction: column;
        align-items: center;
    }

    .receiver-dashboard .page-title {
        font-size: 28px;
    }
}
</style>

<div class="main">

<h1 class="page-title">🩸 Receiver Dashboard</h1>

<p class="welcome">
Welcome, <?php echo $user['name']; ?> 👋
</p>

<div class="cards">

<div class="card">
<h3>Request Blood</h3>
<p>Create new blood request instantly</p>
<a href="request_blood.php">Open</a>
</div>

<div class="card">
<h3>My Requests</h3>
<p>Track your blood request status</p>
<a href="my_requests.php">Open</a>
</div>

<div class="card">
<h3>Profile</h3>
<p>Manage your account details</p>
<a href="#">Coming Soon</a>
</div>

</div>

</div>
</div>