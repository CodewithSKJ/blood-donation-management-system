<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!="admin"){
    header("Location: ../auth/login.php");
    exit();
}
include("../includes/db.php");
include("../includes/config.php");
include("../includes/sidebar.php");

/* ADD / UPDATE STOCK */
if(isset($_POST['add_stock'])){

    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    // check if group exists
    $check = mysqli_query($conn,
        "SELECT * FROM blood_stock WHERE blood_group='$blood_group'"
    );

    if(mysqli_num_rows($check)>0){
        mysqli_query($conn,
            "UPDATE blood_stock 
             SET units = units + $units 
             WHERE blood_group='$blood_group'"
        );
    }else{
        mysqli_query($conn,
            "INSERT INTO blood_stock(blood_group,units)
             VALUES('$blood_group','$units')"
        );
    }
}

/* FETCH STOCK */
$stocks = mysqli_query($conn,"SELECT * FROM blood_stock");
?>

<div class="admin-main">

<h1>🩸 Blood Stock Management</h1>

<div class="admin-content">

<div class="admin-card">
<form method="POST">

<select name="blood_group" required>
<option value="">Select Blood Group</option>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>AB+</option>
<option>AB-</option>
<option>O+</option>
<option>O-</option>
</select>

<input type="number" name="units" placeholder="Units" required>

<button name="add_stock">Add / Update</button>

</form>
</div>

<div class="admin-card">

<table class="admin-table">
<tr>
<th>Blood Group</th>
<th>Units Available</th>
</tr>

<?php while($row=mysqli_fetch_assoc($stocks)){ ?>

<tr>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>
</div>