<?php
session_start();
include 'database.php';

if (!isset($_SESSION['ID'])) {
    header("Location: Admin_login.php");
    exit();
}

// SIMPLE OOP CLASS 
class TransferList {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAll() {
        $q = "SELECT t.Transfer_ID, fb.Name AS From_Bank, tb.Name AS To_Bank,
                     t.Blood_Group, t.Units, t.Transferred_At
              FROM transfer t
              JOIN blood_bank fb ON t.From_Bank = fb.Bank_ID
              JOIN blood_bank tb ON t.To_Bank = tb.Bank_ID
              WHERE fb.verify = 1 AND tb.verify = 1
              ORDER BY t.Transfer_ID";
        return mysqli_query($this->con, $q);
    }
}

$tr = new TransferList($con);
$result = $tr->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - View Transfers</title>
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

<div class="nav" style="margin-bottom: 20px;">
    <div class="logo"><p><a href="admin.php">Admin Dashboard</a></p></div>
    <div class="right-links">
        <form action="logout.php" method="post">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>

<div class="container-box">
<header>All Transfers</header>

<table class="styled-table">
<thead>
    <tr>
        <th>Transfer ID</th>
        <th>From Bank</th>
        <th>To Bank</th>
        <th>Blood Group</th>
        <th>Units</th>
        <th>Transferred At</th>
    </tr>
</thead>

<tbody>
<?php
if (!$result) {
    echo "<tr><td colspan='6' style='color:red;'>Error loading transfers</td></tr>";
}
elseif (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='6'>No transfer records found.</td></tr>";
}
else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Transfer_ID'] . "</td>";
        echo "<td>" . $row['From_Bank'] . "</td>";
        echo "<td>" . $row['To_Bank'] . "</td>";
        echo "<td>" . $row['Blood_Group'] . "</td>";
        echo "<td>" . $row['Units'] . "</td>";
        echo "<td>" . ($row['Transferred_At'] ? $row['Transferred_At'] : "N/A") . "</td>";
        echo "</tr>";
    }
}
?>
</tbody>
</table>

</div>

</body>
</html>