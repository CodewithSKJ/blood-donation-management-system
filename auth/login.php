<?php
session_start();
include("../includes/db.php");
include("../includes/config.php");

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if($user && password_verify($password,$user['password'])){

        $_SESSION['user']=$user;

        if($user['role']=="admin"){
            header("Location: ../admin/dashboard.php");
        }
        elseif($user['role']=="donor"){
            header("Location: ../donor/dashboard.php");
        }
        else{
            header("Location: ../receiver/dashboard.php");
        }
        exit();

    }else{
        $error="Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

   <link rel="stylesheet" href="/blood-donation-management-system/assets/css/login.css">
</head>

<body>

<div class="page-container">

<div class="info-section">

    <div class="brand">
        <h1>🩸 Blood Donation Network</h1>
        <p>
            A secure, real-time platform connecting blood donors, hospitals,
            and patients to save lives faster than ever before.
        </p>
    </div>

    <!-- STATS -->
    <div class="stats">
        <div class="stat-box">
            <h2>10K+</h2>
            <p>Registered Donors</p>
        </div>

        <div class="stat-box">
            <h2>5K+</h2>
            <p>Lives Saved</p>
        </div>

        <div class="stat-box">
            <h2>200+</h2>
            <p>Hospitals Connected</p>
        </div>
    </div>

    <!-- FEATURES -->
    <div class="features">
        <div class="feature">⚡ Real-time Blood Availability</div>
        <div class="feature">✔ Verified Donors Only</div>
        <div class="feature">🚨 Emergency Request System</div>
        <div class="feature">🔒 Secure & Trusted Network</div>
    </div>

    <!-- TRUST BADGES -->
    <div class="trust">
        <span>✔ Verified Platform</span>
        <span>✔ Secure Data</span>
        <span>✔ Hospital Approved</span>
    </div>

</div>
<div class="login-section">

<div class="login-box">

<div class="logo">🩸 Blood Bank</div>
<h2>Login</h2>

<form method="POST">
<input type="email" name="email" placeholder="Email Address" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>
</form>

<div class="auth-switch">
Don't have an account?
<a href="register.php">Register Now</a>
</div>

</div>
</div>

</div>

</body>
</html>