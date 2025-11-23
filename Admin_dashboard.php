<?php
session_start();
include 'database.php';

// Check if session ID is set
if (!isset($_SESSION['ID'])) {
    header("Location: admin login.php");
}
$id = $_SESSION['ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="Admin_dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


</head>

<body>

<div class="header">
    <h2>Hello Admin</h2>

    <form action="logout.php">
        <button type="submit" name="Logout">Logout</button>
    </form>
</div>

<!-- CENTERED MENU -->
<div class="center-box">
  <div class="menu">
    <form action="Donor_verification.php"><button type="submit" class="btn">Donor Verification</button></form>

    <form action="donor_list.php"><button type="submit" class="btn">Donor List</button></form>

    <form action="blood_bank_verification.php"><button type="submit" class="btn">Blood Bank Approval</button></form>

    <form action="blood_bank_list.php"><button type="submit" class="btn">Blood Bank List</button></form>

    <form action="adminblood stock.php"><button type="submit" class="btn">Blood Stock</button></form>

    <form action="admin_view_transfers.php"><button type="submit" class="btn">View Transfers</button></form>
  </div>
</div>

<footer>
  <p>Blood Bank Admin Panel</p>
</footer>

</body>
</html>
