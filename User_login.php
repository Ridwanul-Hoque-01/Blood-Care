<?php 
  session_start();
  include 'database.php';  // Include the database connection file

  // User class for handling authentication
  class User {
      private $con;

      // Constructor to initialize the database connection
      public function __construct($db_connection) {
          $this->con = $db_connection;
      }

      
      public function authenticate($user_id, $password) {
         
          $user_id = mysqli_real_escape_string($this->con, $user_id);
          $password = mysqli_real_escape_string($this->con, $password);

          // Query to check if the user exists in the database
          $query = "SELECT * FROM user WHERE user_id = '$user_id' AND Password = '$password'";
          $result = $this->con->query($query);

          // Check if the user exists and return true or false
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              // Set session variables for the logged-in user
              $_SESSION['ID'] = $row['ID'];
              $_SESSION['Name'] = $row['Name'];
              return true;
          } else {
              return false;
          }
      }
  }

  // Process the form submission
  if (isset($_POST['submit'])) {
      // Get the form data
      $User_id = $_POST['User_Id'];
      $password = $_POST['Password'];

      // Instantiate the User class
      $user = new User($con);

      // Call the authenticate method
      if ($user->authenticate($User_id, $password)) {
          // Redirect to user home if authentication is successful
          header("Location: User_dashboard.php");
          exit();
      } else {
         header("Location: Error.php");
      }
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Blood Bank</title>

<link rel="stylesheet" href="login_style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


</head>
<body>
  

<div class="container">


<header>Login</header>
<form method="post">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="User Id" name="User_Id" autocomplete="off" required>
  </div>
  <div class="form-group">
    <input type="password" class="form-control" placeholder="Password" name="Password" autocomplete="off" required>
  </div>


  
  <div class="form-group">
    <button type="submit" class="btn" name="submit">Submit</button>
  </div>
  <div class="links">
    Don't have an account? <a href="Create_account.php">Create Account</a>
  </div>
</form>

</div>

</body>
</html>
