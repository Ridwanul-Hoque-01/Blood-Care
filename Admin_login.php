
<?php
session_start();
include 'database.php'; // keep same DB include

/* ----------------- OOP CLASS ----------------- */
class AdminLogin {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function validateLogin($User_id, $password) {
        $User_id = mysqli_real_escape_string($this->con, $User_id);
        $password = mysqli_real_escape_string($this->con, $password);

        $sql = "SELECT * FROM admin WHERE ID='$User_id' AND Password='$password'";
        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die("Query Failed: " . mysqli_error($this->con));
        }

        return mysqli_fetch_assoc($result);
    }
}

/* ----------------- OBJECT ----------------- */
$admin = new AdminLogin($con);

/* ----------------- HANDLE SUBMIT ----------------- */
$message = ""; // For error message

if (isset($_POST['submit'])) {
    $User_id  = $_POST['Admin_Id'];
    $password = $_POST['Password'];

    $row = $admin->validateLogin($User_id, $password);

    if (is_array($row) && !empty($row)) {
        $_SESSION['ID'] = $row['ID'];
        header("Location: admin.php");
        exit();
    } else {
        $message = "<div class='meassage'><p>Wrong ID or Password</p></div>
                    <a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="login_style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="container">

<?php
// Show error if login fails
echo $message;

/* Only display form if not failed or not submitted */
if (!isset($_POST['submit']) || $message == "") {
?>

<header>Login</header>

<form method="post">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Admin Id" name="Admin_Id" autocomplete="off" required>
  </div>

  <div class="form-group">
    <input type="password" class="form-control" placeholder="Password" name="Password" autocomplete="off" required>
  </div>

  <div class="form-group">
    <button type="submit" class="btn" name="submit">Submit</button>
  </div>

  <div class="links">
    <p>Back to home?<a href="home.php">Click here</a></p>
  </div>
</form>

<?php } ?>

</div>

</body>
</html>
