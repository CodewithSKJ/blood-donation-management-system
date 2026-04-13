<?php
session_start();
include("../includes/config.php");

// SECURITY CHECK
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "donor"){
    header("Location: ../auth/login.php");
    exit();
}

$donor_id = $_SESSION['user']['id'];

// GET DONATION HISTORY
$sql = "SELECT * FROM donations WHERE donor_id='$donor_id' ORDER BY donation_date DESC";
$result = mysqli_query($conn, $sql);
?>

<h1>My Donation History 📊</h1>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Units Donated</th>
    <th>Donation Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['units']; ?></td>
    <td><?php echo $row['donation_date']; ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>