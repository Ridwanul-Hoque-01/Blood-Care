<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Blood Care</title>

<link rel="stylesheet" href="table_style.css">

<style>
.avail { color: #03ff03; font-weight:700; }
.not-avail { color: #ff1e1e; font-weight:700; }
</style>
</head>

<body>


<div class="nav" style="margin-bottom:20px;">
    <a href="admin.php">Admin Dashboard</a>
    <form action="logout.php">
        <button type="submit" class="btn">Logout</button>
    </form>
</div>

<div class="container-box">

<header>Verified Donor List</header>

<table class="styled-table">
<thead>
<tr>
    <th>Donor ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Blood Group</th>
    <th>Phone</th>
    <th>Age</th>
    <th>Weight</th>
    <th>Address</th>
    <th>Last Donation</th>
    <th>Availability</th>
</tr>
</thead>

<tbody>

</tbody>

</table>

</div>

</body>
</html>
