<?php

// Database connection variables
$host = "localhost";
$username = "root";
$password = "";
$database = "blood_bank";  
// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

?>