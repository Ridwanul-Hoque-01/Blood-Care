
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="table_style.css">
<title>History</title>



</head>

<body>

<div class="nav">
    <a href="userhome.php">Logo</a>
    <form action="logout.php">
        <button type="submit" class="btn" style="width:auto;">Logout</button>
    </form>
</div>

<div class="container-box">

<header>History</header>

<form method="post" style="text-align:center; margin-bottom:20px;">
    <input type="text" placeholder="YYYY/MM/DD" name="search" class="form-control">
    <button class="btn" name="submit" style="width:auto;">Search</button>
</form>

<table class="styled-table">
    <thead>
        <tr>
            <th>Bank ID</th>
            <th>Quantity</th>
            <th>Blood Group</th>
            <th>Date</th>
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
