<?php
class DonorVerification {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Get all unverified donors
    public function getUnverifiedDonors() {
        $sql = "SELECT * FROM donner WHERE Verified = 'No' ORDER BY ID";
        $query = mysqli_query($this->con, $sql);
        if (!$query) {
            die("Query Failed: " . mysqli_error($this->con));
        }
        return $query;
    }

    // Update donor status
    public function updateStatus($donor_id, $new_status) {
        $status_value = ($new_status === 'verified') ? 1 : -1;
        $stmt = $this->con->prepare("UPDATE donner SET Verified = ? WHERE ID = ?");
        $stmt->bind_param("ii", $status_value, $donor_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}


session_start();
include 'database.php'; // Database connection


// Admin session check
if (!isset($_SESSION['ID'])) {
    header("Location: admin login.php");
    exit();
}

// Create object
$donorObj = new DonorVerification($con);

// Handle status update
if (isset($_POST['update_status'])) {
    $donor_id = $_POST['donor_id'];
    $new_status = $_POST['new_status']; // 'verified' or 'rejected'
    $success = $donorObj->updateStatus($donor_id, $new_status);

    $message = $success
        ? "<div class='meassage'><p>Donor status updated successfully!</p></div>"
        : "<div class='meassage'><p>Failed to update donor status.</p></div>";
}

// Fetch unverified donors
$result = $donorObj->getUnverifiedDonors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Blood Care</title>
<link rel="stylesheet" href="table_style.css">
<style>
.btn-verify { background-color: #28a745; }
.btn-reject { background-color: #dc3545; }
</style>
</head>
<body>

<!-- Navbar -->
<div class="nav" style="margin-bottom: 20px;">
    <a href="Admin_dashboard.php">Admin Dashboard</a>
    <form action="logout.php" method="post">
        <button type="submit" class="btn">Logout</button>
    </form>
</div>

<div class="container-box">
<header>Donor Verification</header>

<?php if (isset($message)) { echo $message; } ?>

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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $id      = $row['ID'];
            $fname   = $row['First_Name'];
            $lname   = $row['Last_Name'];
            $blood   = $row['Blood_Group'];
            $phone   = $row['Phone'];
            $age     = $row['Age'];
            $weight  = $row['Weight'];
            $address = $row['Address'];
            $lastd   = $row['Last_Donation'];
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $blood; ?></td>
            <td><?php echo $phone; ?></td>
            <td><?php echo $age; ?></td>
            <td><?php echo $weight; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $lastd ? $lastd : "N/A"; ?></td>
            <td>
                <form action="donor_verification.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="donor_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="new_status" value="verified">
                    <button type="submit" name="update_status" class="btn btn-verify">Verify</button>
                </form>
                <form action="donor_verification.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="donor_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="new_status" value="rejected">
                    <button type="submit" name="update_status" class="btn btn-reject">Reject</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>