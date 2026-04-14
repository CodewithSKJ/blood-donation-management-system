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
<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

<div class="login-box">

<div class="logo">🩸 Blood Bank</div>

<h2>Login</h2>

<?php if($error!=""){ ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>