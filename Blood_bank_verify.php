<?php
session_start();
include 'database.php';

if (!isset($_SESSION['ID'])) {
    header("Location: admin login.php");
    exit();
}

/*OOP CLASS FOR VERIFICATION*/
class BloodBankVerification {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Fetch all unverified banks
    public function getUnverifiedBanks() {
        $sql = "SELECT * FROM blood_bank WHERE verify = 0 ORDER BY Bank_ID";
        return mysqli_query($this->con, $sql);
    }

    // Update status
    public function updateStatus($bank_id, $new_status) {
        $status_value = ($new_status === 'verified') ? 1 : -1;

        $stmt = $this->con->prepare("UPDATE blood_bank SET verify = ? WHERE Bank_ID = ?");
        $stmt->bind_param("ii", $status_value, $bank_id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}

$bankObj = new BloodBankVerification($con);

/* HANDLE STATUS UPDATE*/
if (isset($_POST['update_status'])) {

    $bank_id = $_POST['bank_id'];
    $new_status = $_POST['new_status'];

    $success = $bankObj->updateStatus($bank_id, $new_status);

    $message = $success
        ? "<div class='meassage'><p>Blood bank status updated successfully!</p></div>"
        : "<div class='meassage'><p>Failed to update blood bank status.</p></div>";
}

// Fetch banks
$result = $bankObj->getUnverifiedBanks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Blood Bank Verification</title>


<link rel="stylesheet" href="table_style.css">

<style>

.btn-verify { background-color: #28a745; }
.btn-reject { background-color: #dc3545; }
</style>

</head>
<body>


<div class="nav" style="margin-bottom: 20px;">
    <a href="Admin_dashboard.php">Admin Dashboard</a>

    <form action="logout.php" method="post">
        <button type="submit" class="btn">Logout</button>
    </form>
</div>

<div class="container-box">
<header>Blood Bank Verification</header>

<?php if (isset($message)) echo $message; ?>

<table class="styled-table">
    <thead>
        <tr>
            <th>Bank ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?= $row['Bank_ID']; ?></td>
            <td><?= $row['Name']; ?></td>

            <!-- AUTO FIX: CONTACT FIELD -->
            <td>
                <?= htmlspecialchars(
                    $row['contact']
                    ?? $row['Contact']
                    ?? $row['Phone']
                    ?? $row['contact_no']
                    ?? "N/A"
                ); ?>
            </td>

            <td><?= $row['Address']; ?></td>

            <td>
                <!-- VERIFY BUTTON -->
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="bank_id" value="<?= $row['Bank_ID']; ?>">
                    <input type="hidden" name="new_status" value="verified">
                    <button type="submit" name="update_status" class="btn btn-verify">Verify</button>
                </form>

                <!-- REJECT BUTTON -->
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="bank_id" value="<?= $row['Bank_ID']; ?>">
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
