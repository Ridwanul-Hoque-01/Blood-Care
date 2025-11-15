<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_style.css">
    <title>Document</title>
</head>
<body>
    <div class="nav">
        <a href="">Logo</a>
        <form action="">
            <button type="submit" class="btn" style="width:auto;padding:8px 15px;">Logout</button>
        </form>
          
    </div>
    <div class="container-box">
        <header>Change Info</header>
        <form method="post">
            <div class="form-grid">
                 <div>
        <label>First Name</label>
        <input type="text" class="form-control" name="First_Name"
        value="" required>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" class="form-control" name="Last_Name"
        value="" required>
    </div>

    <div>
        <label>Blood Group</label>
        <select class="form-control" name="Group">
            <option selected></option>
            <option>A+</option>
            <option>B+</option>
            <option>AB+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
        </select>
    </div>

    <div>
        <label>Age</label>
        <input type="number" class="form-control" name="Age"
        value="" required>
    </div>

    <div>
        <label>Weight</label>
        <input type="number" class="form-control" name="Weight"
        value="" required>
    </div>

    <div>
        <label>Phone</label>
        <input type="text" class="form-control" name="Phone"
        value="" required>
    </div>

    <div>
        <label>Address</label>
        <input type="text" class="form-control" name="Address"
        value="" required>
    </div>

    <div>
        <label>Last Donation Date</label>
        <input type="date" class="form-control" name="Last"
        value="">
    </div>

    <button class="btn submit-btn" type="submit" name="submit">Re-Submit</button>
               
            </div>
        </form>
    </div>
    
</body>
</html>