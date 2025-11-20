
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



</div>

</body>
</html>
