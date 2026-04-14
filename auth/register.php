<?php
include("../includes/db.php");
include("../includes/config.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

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

<div class="register-page">

<style>
.register-page {
    font-family: Arial;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    /* Modern gradient background */
    background: linear-gradient(-45deg, #c0392b, #8e44ad, #2980b9, #16a085);
    background-size: 400% 400%;
    animation: gradientBG 8s ease infinite;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.register-box {
    background: white;
    padding: 30px;
    width: 350px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.register-box h2 {
    text-align: center;
    color: #c0392b;
    margin-bottom: 20px;
}

.register-box input,
.register-box select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.register-box button {
    width: 100%;
    padding: 10px;
    background: #c0392b;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.register-box button:hover {
    background: #a93226;
}

.msg {
    text-align: center;
    margin-bottom: 10px;
    color: green;
    font-weight: bold;
}
</style>

<div class="register-box">

<h2>🩸 Register</h2>

<?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>

    <input type="email" name="email" placeholder="Email Address" required>

    <input type="password" name="password" placeholder="Password" required>

    <select name="role" required>
        <option value="">Select Role</option>
        <option value="donor">Donor</option>
        <option value="receiver">Receiver</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit" name="register">Create Account</button>
</form>

</div>
</div>