<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit();
}

include("../includes/config.php");
include("../includes/sidebar.php");
?>
<div class="main">

<h1>Blood Stock Management 🩸</h1>

<form method="POST">

<select name="blood_group" required>
<option value="">Select Blood Group</option>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>O+</option>
<option>O-</option>
<option>AB+</option>
<option>AB-</option>
</select>

<input type="number" name="units" placeholder="Units" required>

<button name="add_stock">Add Stock</button>

</form>
<?php

if(isset($_POST['add_stock'])){

$blood_group = $_POST['blood_group'];
$units = $_POST['units'];

// check if blood already exists
$check = mysqli_query($conn,"SELECT * FROM bloodstock WHERE blood_group='$blood_group'");

if(mysqli_num_rows($check)>0){

mysqli_query($conn,"
UPDATE bloodstock
SET units = units + '$units'
WHERE blood_group='$blood_group'
");

}else{

mysqli_query($conn,"
INSERT INTO bloodstock(blood_group,units)
VALUES('$blood_group','$units')
");

}

echo "<p>Stock Updated Successfully ✅</p>";
}
?>
<?php
$stocks = mysqli_query($conn,"SELECT * FROM bloodstock");
?>

<h2>Available Blood Stock</h2>

<table border="1" cellpadding="10">
<tr>
<th>Blood Group</th>
<th>Units</th>
</tr>

<?php while($row=mysqli_fetch_assoc($stocks)){ ?>

<tr>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
</tr>

<?php } ?>

</table>

</div>
