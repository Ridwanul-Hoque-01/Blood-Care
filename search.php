
<?php
include 'database.php'; // same db include

/* ----------------- OOP CLASS ----------------- */
class DonorList {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function searchDonor($search) {
        if ($search != NULL) {
            $sql = "SELECT * FROM donner WHERE Blood_Group='$search' AND Verified=1";
        } else {
            $sql = "SELECT * FROM donner WHERE Verified=1";
        }
        return mysqli_query($this->con, $sql);
    }

    public function getAllDonors() {
        return mysqli_query($this->con, "SELECT * FROM donner WHERE Verified=1");
    }
}

/* ----------------- CREATE OBJECT ----------------- */
$donorObj = new DonorList($con);

/* ----------------- HANDLE SEARCH (NO HTML HERE) ----------------- */
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    $result = $donorObj->searchDonor($search);
} else {
    $result = $donorObj->getAllDonors();
}

if (!$result) {
    die("query failed " . mysqli_error($con));
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table_style.css">
    <title>Blood Care</title>

</head>
<body>
     <div class="nav" style="margin-bottom:20px">
        <div class="logo">
            <p><a href='userhome.php'>Logo</a></p>
        </div>

        <div class="right-links">
            <form action="logout.php">
                <button type="submit" class="btn">Logout</button>
            </form>
        </div>
  </div>

  <div class="container-box">

      <header>Donor List</header>

      <form method="post" style="text-align:center; margin-bottom:20px;">
          <input type="text" class="form-control" placeholder="Search by Blood Group (A+ , AB+ ...)" name="search">
          <button class="btn" name="submit">Search</button>
      </form>

      <table class="styled-table">
          <thead>
              <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Blood Group</th>
                  <th>Phone</th>
              </tr>
          </thead>

    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['First_Name']; ?></td>
                <td><?php echo $row['Last_Name']; ?></td>
                <td><?php echo $row['Blood_Group']; ?></td>
                <td><?php echo $row['Phone']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>