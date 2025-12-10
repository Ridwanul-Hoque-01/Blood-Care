<?php
session_start();
include 'database.php';

class DonorHandler {

    private $con;
    private $id;

    public function __construct($con, $id) {
        $this->con = $con;
        $this->id = $id;
    }

    public function getDonor() {
        $query = mysqli_query($this->con, "SELECT * FROM donner WHERE ID=$this->id");
        return mysqli_fetch_assoc($query);
    }

    public function phoneExists($phone) {
        $verify_query = mysqli_query($this->con, "SELECT Phone FROM Donner WHERE Phone='$phone'");
        return mysqli_num_rows($verify_query) != 0;
    }

    public function registerDonor($First_Name, $Last_Name, $Blood, $Age, $Weight, $phone, $Address, $Last) {

        $sql = "INSERT INTO `Donner` 
                (First_Name,Last_Name,Blood_Group,Age,Weight,Phone,Address,Last_Donation,ID)
                VALUES('$First_Name','$Last_Name','$Blood','$Age','$Weight','$phone','$Address','$Last','$this->id')";

        return mysqli_query($this->con, $sql);
    }
}

$id = $_SESSION['ID'];
$donor = new DonorHandler($con, $id);
$result = $donor->getDonor();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_style.css">
    <title>Blood Care</title>


</head>
<body>
    <div class="nav">
        <a href="javascript:self.history.back()">Dashboard</a>
        <form action="logout.php"><button class="btn" style="width:auto,padding:8px 15px;">Logout</button></form>
</div>
<div class="container-box">



<?php

// Already registered
if (isset($result['Phone']) AND ($result['Verified'] == 1)) {
    echo "<div class='meassage'><p>You are already registerd!</p></div>";
    echo "<a href='Edit_info.php'><button class='btn'>Edit</button></a>";
}

// Under verification
else if (isset($result['Phone']) AND ($result['Verified'] != 1)) {
    echo "<div class='meassage'><p>You are under Verification Process</p></div>";
    echo "<a href='Edit_info.php'><button class='btn'>Edit</button></a>";
}

// Show form
else {

    if (isset($_POST['submit'])) {

        $First_Name = $_POST['First_Name'];
        $Last_Name  = $_POST['Last_Name'];
        $Blood      = $_POST['Group'];
        $Age        = $_POST['Age'];
        $Weight     = $_POST['Weight'];
        $Last       = $_POST['Last'];
        $phone      = $_POST['Phone'];
        $Address    = $_POST['Address'];

        // Phone exists?
        if ($donor->phoneExists($phone)) {
            echo "<div class='meassage'><p>This Number already exist,Try another one Please!</p></div>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        } else {

            // Insert new donor
            $insert = $donor->registerDonor($First_Name, $Last_Name, $Blood, $Age, $Weight, $phone, $Address, $Last);

            if (!$insert) {
                die(mysqli_error($con));
            } else {
                echo "<div class='meassage'><p>Registration Successfull</p></div>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Back</button>";
            }
        }

    } else {
?>




  <header>Create Account</header>
  <form method="post">

<div class="form-grid">

    <div>
        <label>First Name</label>
        <input type="text" class="form-control" name="First_Name" placeholder="Enter first name" required>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" class="form-control" name="Last_Name" placeholder="Enter last name" required>
    </div>

    <div>
        <label>Blood Group</label>
        <select class="form-control" name="Group">
            <option>A+</option><option>B+</option><option>AB+</option>
            <option>B-</option><option>O+</option><option>O-</option>
        </select>
    </div>

    <div>
        <label>Age</label>
        <input type="number" class="form-control" name="Age" placeholder="Enter age" required>
    </div>

    <div>
        <label>Weight</label>
        <input type="number" class="form-control" name="Weight" placeholder="Enter weight" required>
    </div>

    <div>
        <label>Phone</label>
        <input type="text" class="form-control" name="Phone" placeholder="Enter number" required>
    </div>

    <div>
        <label>Address</label>
        <input type="text" class="form-control" name="Address" placeholder="Enter address" required>
    </div>

    <div>
        <label>Last Donation Date</label>
        <input type="date" class="form-control" name="Last">
    </div>

    <button class="btn submit-btn" type="submit" name="submit">Submit</button>

</div>
</form>
<?php } } ?>
</div>
</body>
</html>