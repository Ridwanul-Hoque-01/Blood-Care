<?php 
session_start();
include 'database.php';  // DB connection

// Delete unverified (-1) entries
mysqli_query($con,"DELETE FROM blood_bank WHERE verify = -1");


class BloodBank {
    private $con;

    public function __construct($db_connection) {
        $this->con = $db_connection;
    }

    public function registerBank($Name, $User_Id, $Password, $Phone, $Address) {
        
        // Sanitize input
        $Name = mysqli_real_escape_string($this->con, $Name);
        $User_Id = mysqli_real_escape_string($this->con, $User_Id);
        $Password = mysqli_real_escape_string($this->con, $Password);
        $Phone = mysqli_real_escape_string($this->con, $Phone);
        $Address = mysqli_real_escape_string($this->con, $Address);

        // Check if ID exists
        $verify_query = mysqli_query($this->con, 
            "SELECT Bank_ID FROM blood_bank WHERE Bank_ID='$User_Id'"
        );

        if (mysqli_num_rows($verify_query) != 0) {
            return "This ID already exists, try another one!";
        }

        // Insert new bank (verify = 0 under verification)
        $sql = "INSERT INTO blood_bank (Name, Bank_ID, Password, contact, Address, verify)
                VALUES('$Name', '$User_Id', '$Password', '$Phone', '$Address', 0)";

        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            return "Database Error: " . mysqli_error($this->con);
        } else {
            return "Registration Successful";
        }
    }
}


$message = "";
$success = false;

if (isset($_POST['submit'])) {
    $Name = $_POST['Name'];
    $User_Id = $_POST['Bank_Id'];
    $Password = $_POST['Password'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];

    $bank = new BloodBank($con);
    $message = $bank->registerBank($Name, $User_Id, $Password, $Phone, $Address);

    if ($message == "Registration Successful") {
        $success = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Care</title>
<link rel="stylesheet" href="Create_account.css">


</head>

<body>

<div class="container">

<header>Create Account</header>

<?php if ($message): ?>
    <div class="<?= $success ? 'success' : 'message' ?>">
        <?= $message ?>
    </div>

    <?php if ($success): ?>
        <button class="btn" onclick="window.location.href='BloodBank_login.php'">Login Now</button>
        </div>
    </body>
    </html>
    <?php exit; ?>
    <?php endif; ?>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Enter Blood Bank Name" name="Name" required>
    </div>

    <div class="form-group">
        <label>Registration Id</label>
        <input type="text" class="form-control" placeholder="Enter Registration Id" name="Bank_Id" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" placeholder="Enter Password" name="Password" required>
    </div>

    <div class="form-group">
        <label>Contact</label>
        <input type="number" class="form-control" placeholder="Enter Number" name="Phone" required>
    </div>

    <div class="form-group">
        <label>Location</label>
        <input type="text" class="form-control" placeholder="Enter Location" name="Address" required>
    </div>

    <button type="submit" class="btn" name="submit">Submit</button>

    <div class="links">
        Already have an account?
        <a href="BloodBank_login.php">Login</a>
    </div>
</form>

</div>

</body>
</html>