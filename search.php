<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Care</title>
<style>
    body {
    min-height: 100vh;
    margin: 0;
    padding: 30px;
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, rgba(230, 57, 70, 0.85), rgba(244, 180, 180, 0.85));
}

/* Navbar */
.nav {
    max-width: 1300px;
    margin: 0 auto 25px auto;
    padding: 15px 20px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
}

.nav a {
    text-decoration: none;
    font-size: 22px;
    color: #fff;
    font-weight: 600;
}

.btn {
    padding: 10px 18px;
    background: #e63946;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 16px;
}

.btn:hover {
    background:#b71c1c;
    transform: translateY(-2px);
}

/* Main Box */
.container-box {
    max-width: 1300px;
    margin: auto;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(12px);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    color: #fff;
}

/* Header */
header {
    font-size: 2.3em;
    font-weight: 600;
    text-align: center;
    margin-bottom: 30px;
}

/* Search input */
.form-control {
    padding: 12px 15px;
    border-radius: 10px;
    border: none;
    background: rgba(255,255,255,0.3);
    width: 250px;
    color: #000;
}

.form-control:focus {
    background: rgba(255,255,255,0.5);
    outline: none;
    border-left: 3px solid #e63946;
}

/* Table */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
}

.styled-table thead tr {
    background: #e63946;
    color: #fff;
    font-size: 18px;
}

.styled-table th,
.styled-table td {
    padding: 14px 18px;
    font-size: 16px;
    text-align: center;
}

.styled-table tbody tr:nth-child(even) {
    background: rgba(255,255,255,0.12);
}

.styled-table tbody tr:hover {
    background: rgba(255,255,255,0.28);
    transition: 0.3s;
}

/* Message */
.meassage {
    background: rgba(255,0,0,0.25);
    padding: 12px;
    border-radius: 8px;
    color: #fff;
    text-align: center;
    margin-bottom: 15px;
    font-weight: 500;
}
</style>
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