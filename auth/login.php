<?php
session_start();
include("../includes/config.php");

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn,$sql);

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