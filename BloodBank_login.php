<?php 
session_start();
include 'database.php'; // DB connection


class BankUser {
    private $con;

    public function __construct($db_connection) {
        $this->con = $db_connection;
    }

    public function authenticate($User_id, $password) {
        $User_id = mysqli_real_escape_string($this->con, $User_id);
        $password = mysqli_real_escape_string($this->con, $password);

        $query = "SELECT * FROM blood_bank WHERE Bank_ID='$User_id' AND Password='$password'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }
}


$message = ""; // For error display

if (isset($_POST['submit'])) {

    $User_id = $_POST['User_Id'];
    $password = $_POST['Password'];

    $bankUser = new BankUser($con);
    $row = $bankUser->authenticate($User_id, $password);

    if (is_array($row) && !empty($row) && ($row['verify'] != -1)) {

        if ($row['verify'] == 1) {
            $_SESSION['ID'] = $row['Bank_ID'];
            $_SESSION['Name'] = $row['Name'];
            header("Location: BloodBank_Dashboard.php");
            exit();
        } else {
            $message = "Under Verification, Try later";
        }

    } else {
        $message = "Wrong ID or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bank Login</title>
<link rel="stylesheet" href="login_style.css">


</head>

<body>

<div class="container">

<header>Login</header>

<?php if (!empty($message)) { ?>
    <div class="message"><p><?= $message ?></p></div>
<?php } ?>

<form method="post">

  <div class="form-group">
    <input type="text" class="form-control" placeholder="Enter Bank Id" name="User_Id" autocomplete="off" required>
  </div>

  <div class="form-group">
    <input type="password" class="form-control" placeholder="Enter Password" name="Password" autocomplete="off" required>
  </div>

  <div class="form-group">
    <button type="submit" class="btn" name="submit">Submit</button>
  </div>

  <div class="links">
    Don't have an account? <a href="Register_bank.php">Create Account</a>
  </div>

</form>

</div>

</body>
</html>
