<?php
session_start();
include("../includes/config.php");

if(isset($_POST['login'])){

$email = $_POST['email'];
if(password_verify($password, $row['password']))

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = mysqli_fetch_assoc($result);

if($user){

    $_SESSION['user'] = $user;

    if($user['role'] == "admin"){
        header("Location: ../admin/dashboard.php");
    }
    elseif($user['role'] == "donor"){
        header("Location: ../donor/dashboard.php");
    }
    else{
        header("Location: ../receiver/dashboard.php");
    }

}else{
    echo "Invalid Login!";
}

}
?>

<h2>Login Page</h2>

<form method="POST">
Email: <input type="email" name="email"><br><br>
Password: <input type="password" name="password"><br><br>

<button type="submit" name="login">Login</button>
</form>