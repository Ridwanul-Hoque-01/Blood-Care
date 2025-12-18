<?php 
  session_start();
  include 'database.php';  // Include the database connection file

  // User class for handling user registration
  class User {
      private $con;

      // Constructor to initialize the database connection
      public function __construct($db_connection) {
          $this->con = $db_connection;
      }

      // Function to create a new user
      public function createAccount($name, $user_id, $password, $phone, $address) {
          // Sanitize input to prevent SQL injection
          $name = mysqli_real_escape_string($this->con, $name);
          $user_id = mysqli_real_escape_string($this->con, $user_id);
          $password = mysqli_real_escape_string($this->con, $password);
          $phone = mysqli_real_escape_string($this->con, $phone);
          $address = mysqli_real_escape_string($this->con, $address);

          // Check if the user ID already exists
          $verify_query = mysqli_query($this->con, "SELECT user_id FROM user WHERE user_id='$user_id'");
          if(mysqli_num_rows($verify_query) != 0) {
              return "This ID already exists, please try another one.";
          } else {
              // Insert the new user data into the database
              $sql = "INSERT INTO `user` (Name, user_id, Password, Phone, Address)
                      VALUES('$name', '$user_id', '$password', '$phone', '$address')";
              $result = mysqli_query($this->con, $sql);
              if(!$result) {
                  die(mysqli_error($this->con));
              } else {
                  header("Location: confirmation.php");
              }
          }
      }
  }

  // Process the form submission
  $message = '';
  if (isset($_POST['submit'])) {
      // Get the form data
      $name = $_POST['Name'];
      $user_id = $_POST['User_Id'];
      $password = $_POST['Password'];
      $phone = $_POST['Phone'];
      $address = $_POST['Address'];

      // Instantiate the User class
      $user = new User($con);

      // Call the createAccount method and capture the message
      $message = $user->createAccount($name, $user_id, $password, $phone, $address);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account - Blood Bank</title>
<link rel="stylesheet" href="Create_account.css">



<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
  

<div class="container">

  <header>Create Account</header>

  <!-- Show message if exists -->
  <?php if($message): ?>
      <div class="meassage">
          <p><?php echo $message; ?></p>
      </div>
  <?php endif; ?>

  <form method="post">
      <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" placeholder="Enter your Full Name" name="Name" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label>User Id</label>
          <input type="text" class="form-control" placeholder="Enter User Id" name="User_Id" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" name="Password" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label>Phone</label>
          <input type="number" class="form-control" placeholder="Enter Number" name="Phone" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" placeholder="Enter Address" name="Address" autocomplete="off" required>
      </div>

      <div class="form-group">
          <button type="submit" class="btn" name="submit">Submit</button>
      </div>
      <div class="links">
          Already have an account? <a href="User_login.php">Login</a>
      </div>
  </form>

</div>

</body>
</html>
