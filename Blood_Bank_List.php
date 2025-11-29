<?php
session_start();
include 'database.php'; // DB connection

if (!isset($_SESSION['ID'])) {
    header("Location: Admin_login.php");
    exit();
}

// SIMPLE OOP CLASS 
class BankList {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getBanks() {
        $q = "SELECT Bank_ID, Name, contact, Address FROM blood_bank WHERE verify = 1 ORDER BY Bank_ID";
        $r = mysqli_query($this->con, $q);
        return $r;
    }
}

$banks = new BankList($con);
$result = $banks->getBanks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verified Blood Banks</title>
<link rel="stylesheet" href="table_style.css">
<style>
header {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}
</style>
</head>

<body>

<div class="nav" style="margin-bottom:20px;">
    <div class="logo"><p><a href="Admin_dashboard.php">Admin Dashboard</a></p></div>
    <div class="right-links">
        <form action="logout.php" method="post">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>

<div class="container-box">
<header>Verified Blood Banks</header>

<table class="styled-table">
<thead>
<tr>
    <th>Bank ID</th>
    <th>Name</th>
    <th>Contact</th>
    <th>Address</th>
</tr>
</thead>

<tbody>
<?php
if (!$result) {
    echo "<tr><td colspan='4' style='color:red;'>Error loading list</td></tr>";
} elseif (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='4'>No verified banks found</td></tr>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Bank_ID'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "</tr>";
    }
}
?>
</tbody>
</table>

</div>

</body>
</html>