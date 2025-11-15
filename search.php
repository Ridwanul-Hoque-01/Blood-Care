<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
         <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
    </tbody>
</table>
</div>
</body>
</html>