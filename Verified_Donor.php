<?php


class Donor {

    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Fetch all verified donors
    public function getVerifiedDonors() {

        $sql = "SELECT * FROM donner WHERE Verified = 1 ORDER BY ID";
        $query = mysqli_query($this->con, $sql);

        if (!$query) {
            die("Query Failed: " . mysqli_error($this->con));
        }

        return $query;
    }
}






session_start();
include 'database.php';


// Admin session check
if (!isset($_SESSION['ID'])) {
    header("Location: Admin_login.php");
    exit();
}

// Current date
$current_date = strtotime(date("Y-m-d"));

// Create class object
$donorObj = new Donor($con);

// Get verified donors
$result = $donorObj->getVerifiedDonors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verified Donor</title>

<link rel="stylesheet" href="table_style.css">

<style>
.avail { color: #03ff03; font-weight:700; }
.not-avail { color: #ff1e1e; font-weight:700; }
</style>
</head>

<body>

<!-- Navbar -->
<div class="nav" style="margin-bottom:20px;">
    <a href="admin.php">Admin Dashboard</a>
    <form action="logout.php">
        <button type="submit" class="btn">Logout</button>
    </form>
</div>

<div class="container-box">

<header>Verified Donor List</header>

<table class="styled-table">
<thead>
<tr>
    <th>Donor ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Blood Group</th>
    <th>Phone</th>
    <th>Age</th>
    <th>Weight</th>
    <th>Address</th>
    <th>Last Donation</th>
    <th>Availability</th>
</tr>
</thead>

<tbody>
<?php

$last_3_months = strtotime("-3 months", $current_date);

if (mysqli_num_rows($result) == 0) {

    echo "<tr><td colspan='10'>No verified donors found.</td></tr>";

} else {

    while ($row = mysqli_fetch_assoc($result)) {

        $id       = $row['ID'];
        $fname    = $row['First_Name'];
        $lname    = $row['Last_Name'];
        $blood    = $row['Blood_Group'];
        $phone    = $row['Phone'];
        $age      = $row['Age'];
        $weight   = $row['Weight'];
        $address  = $row['Address'];
        $lastd    = $row['Last_Donation'];

        $lastd_time = $lastd ? strtotime($lastd) : null;

        $is_available = ($lastd_time === null || $lastd_time < $last_3_months);

        $status = $is_available 
                ? "<span class='avail'>Available</span>" 
                : "<span class='not-avail'>Not Available</span>";

        echo "
        <tr>
            <td>$id</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$blood</td>
            <td>$phone</td>
            <td>$age</td>
            <td>$weight</td>
            <td>$address</td>
            <td>" . ($lastd ? $lastd : "Never") . "</td>
            <td>$status</td>
        </tr>";
    }
}
?>
</tbody>

</table>

</div>

</body>
</html>
