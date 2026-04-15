<?php
include("../includes/db.php");
include("../includes/config.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
// allow only these two roles
$allowed_roles = ["donor", "receiver"];

if (!in_array($role, $allowed_roles)) {
    die("Invalid role selected");
}
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){
        $msg = "User already exists!";
    } else {

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        $stmt->execute();

        header("Location: login.php");
exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

   <link rel="stylesheet" href="/blood-donation-management-system/assets/css/register.css">
</head>

<body>
    <div class="register-page">

    <div class="left-info">
        <h1>Blood Donation System</h1>
        <p>
            A secure platform connecting donors, hospitals, and patients
            for fast and reliable blood availability.
        </p>

        <div class="points">
            <div>✔ Verified Donors</div>
            <div>✔ Emergency Requests</div>
            <div>✔ Hospital Network</div>
            <div>✔ 24/7 Availability</div>
        </div>
    </div>

    <div class="register-card">

        <div class="header">
            <div class="logo">Create Account</div>
            <h2>Register</h2>
            <p>Join the healthcare network</p>
        </div>

        <form method="POST">

            <input type="text" name="name" placeholder="Full Name" required>

            <input type="email" name="email" placeholder="Email Address" required>

            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">Select Role</option>
                <option value="donor">Donor</option>
                <option value="receiver">Receiver</option>
            </select>

            <button type="submit">Create Account</button>

        </form>

        <div class="auth-switch">
            Already have an account?
            <a href="login.php">Login</a>
        </div>

    </div>

</div>
</body>
</html>