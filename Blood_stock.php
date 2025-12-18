<?php
session_start();
include 'database.php'; // your DB connection

if (!isset($_SESSION['ID'])) {
    header("Location: banklogin.php");
    exit();
}

$bank = $_SESSION['ID'];

//  OOP Class 
class BloodStock {
    private $con;
    private $bank;
    private $groups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];

    public function __construct($con, $bank) {
        $this->con = $con;
        $this->bank = $bank;
    }

    public function getAllStock() {
        $data = [];
        foreach ($this->groups as $g) {
            $res = mysqli_query($this->con, "SELECT Quantity, Last_Updated FROM blood_stock WHERE Bank_ID='$this->bank' AND Blood_Group='$g'");
            $row = mysqli_fetch_assoc($res);
            $data[$g] = $row ? $row : ['Quantity'=>0, 'Last_Updated'=>'-'];
        }
        return $data;
    }
}

$stockObj = new BloodStock($con, $bank);
$stocks = $stockObj->getAllStock();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="table_style.css">
<title>Blood Stock</title>

</head>
<body>

<div class="nav" style="margin-bottom:20px">
    <div class="logo">
        <p><a href='BloodBank_Dashboard.php'>Blood Bank</a></p>
    </div>
    <div class="right-links">
        <form action="logout.php">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>

<div class="container-box">
<header>Blood Stock</header>

<table class="styled-table">
    <thead>
        <tr>
            <th>Blood Group</th>
            <th>Quantity (Units)</th>
            <th>Last Updated</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($stocks as $group => $s): ?>
            <tr>
                <td><?php echo $group; ?></td>
                <td><?php echo $s['Quantity']; ?></td>
                <td><?php echo $s['Last_Updated']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>
</html>
