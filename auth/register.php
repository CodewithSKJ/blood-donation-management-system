<?php
include("../includes/db.php");
include("../includes/config.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // SECURE PASSWORD
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // CHECK IF USER EXISTS
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){
        echo "User already exists!";
    } else {

        // INSERT USER
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        $stmt->execute();

        echo "Registration successful!";
    }
}
?>

<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    Role:
    <select name="role">
        <option value="donor">Donor</option>
        <option value="receiver">Receiver</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit" name="register">Register</button>
</form>