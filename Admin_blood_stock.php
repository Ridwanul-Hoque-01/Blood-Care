<?php
session_start();
include 'database.php'; // Database connection

// Ensure admin is logged in
if (!isset($_SESSION['ID'])) {
    header("Location: admin login.php");
    exit();
}

// OOP Class to get blood stock
class BloodStock {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getStock() {
        $sql = "SELECT b.Bank_ID, b.Name AS Bank_Name, s.Blood_Group, s.Quantity, s.Last_Updated
                FROM blood_bank b
                JOIN blood_stock s ON b.Bank_ID = s.Bank_ID
                WHERE b.verify = 1
                ORDER BY s.Blood_Group, b.Bank_ID";
        $result = mysqli_query($this->con, $sql);

        $stock_by_group = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $stock_by_group[$row['Blood_Group']][] = $row;
            }
        }

        return $stock_by_group;
    }
}

$bloodStock = new BloodStock($con);
$stock_by_group = $bloodStock->getStock();
$blood_groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

// Calculate totals per group
$total_by_group = [];
foreach ($stock_by_group as $group => $stocks) {
    $total_units = 0;
    foreach ($stocks as $row) {
        $total_units += (int)$row['Quantity'];
    }
    $total_by_group[$group] = $total_units;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Blood Stock</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
    min-height: 100vh;
    margin: 0;
    padding: 30px;
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, rgba(230, 57, 70, 0.85), rgba(244, 180, 180, 0.85));
}

/* Navigation */
.nav {
    max-width: 1300px;
    margin: 0 auto 25px auto;
    padding: 20px 30px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.nav a {
    text-decoration: none;
    font-size: 22px;
    color: #fff;
    font-weight: 600;
}
.btn {
    padding: 10px 20px;
    background: #e63946;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}
.btn:hover {
    background: #b71c1c;
    transform: translateY(-2px);
}

/* Container */
.container-box {
    max-width: 1300px;
    margin: auto;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(12px);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    color: #fff;
}
header {
    font-size: 2em;
    font-weight: 600;
    letter-spacing: 1px;
    text-align: center;
    margin-bottom: 30px;
    text-shadow: 1px 2px 6px rgba(0,0,0,0.2);
}

/* Grid layout */
.stock-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}
.stock-group {
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(12px);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}
.stock-group h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #fff;
    font-size: 1.2em;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

/* Tables */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    table-layout: fixed; /* Fix column widths */
}
.styled-table th, .styled-table td {
    padding: 10px;
    text-align: left;
    word-wrap: break-word; /* Wrap long text */
}
.styled-table thead th {
    background: rgba(221, 39, 39, 0.9);
    color: #fff;
}
/* Column widths */
.styled-table th:nth-child(1),
.styled-table td:nth-child(1) { width: 15%; } /* Bank ID */
.styled-table th:nth-child(2),
.styled-table td:nth-child(2) { width: 40%; } /* Bank Name */
.styled-table th:nth-child(3),
.styled-table td:nth-child(3) { width: 15%; } /* Quantity */
.styled-table th:nth-child(4),
.styled-table td:nth-child(4) { width: 30%; } /* Last Updated */

.styled-table tbody tr {
    background: rgba(255,255,255,0.2);
}
.styled-table tbody tr:nth-child(even) {
    background: rgba(255,255,255,0.1);
}
.styled-table tbody tr:hover {
    background: rgba(255,255,255,0.3);
}
.styled-table tbody tr.total-row {
    font-weight: bold;
    background: rgba(255,255,255,0.3);
}

/* No stock message */
.no-stock {
    padding: 10px;
    background: rgba(255,0,0,0.2);
    color: #fff;
    border-radius: 8px;
    text-align: center;
}

/* Responsive */
@media(max-width: 900px) {
    .stock-grid {
        grid-template-columns: 1fr;
    }
}
</style>
</head>
<body>

<div class="nav">
    <div class="logo"><a href="Admin_dashboard.php">Admin Dashboard</a></div>
    <div>
        <form action="logout.php" method="post">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>

<div class="container-box">
<header>Blood Stock By Blood Group</header>

<div class="stock-grid">
    <?php foreach($blood_groups as $group): ?>
        <div class="stock-group">
            <h3>Blood Group: <?php echo $group; ?></h3>

            <?php if (!isset($stock_by_group[$group]) || empty($stock_by_group[$group])): ?>
                <div class="no-stock">No stock available for <?php echo $group; ?>.</div>
            <?php else: ?>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Bank ID</th>
                            <th>Bank Name</th>
                            <th>Quantity</th>
                            <th>Last-Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($stock_by_group[$group] as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Bank_ID']); ?></td>
                                <td><?php echo htmlspecialchars($row['Bank_Name']); ?></td>
                                <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                                <td><?php echo $row['Last_Updated'] ? htmlspecialchars($row['Last_Updated']) : 'N/A'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Total row -->
                        <tr class="total-row">
                            <td colspan="2">Total</td>
                            <td><?php echo $total_by_group[$group]; ?></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</div>
</body>
</html>