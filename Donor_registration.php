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
.nav {
    max-width: 1300px;
    margin: 0 auto 25px auto;
    padding: 20px 30px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
}
.btn {
    width: 100%;
    padding: 14px;
    background: #e63946;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 17px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #b71c1c;
    transform: translateY(-2px);
}


.submit-btn {
    grid-column: span 2;
}
.nav a {
    text-decoration: none;
    font-size: 22px;
    color: #fff;
    padding:10px;
    font-weight: 600;
}
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
header {
    font-size: 2.3em;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 1px 2px 6px rgba(0,0,0,0.2);
    text-align: center;
    margin-bottom: 35px;
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(350px, 1fr));
    gap: 30px 40px; 
}
label {
    font-size: 15px;
    margin-bottom: 6px;
    display: block;
    font-weight: 500;
}
input.form-control
{
    width: 100%;
    padding: 14px 15px;
    border: none;
    border-radius: 10px;
    background: rgba(255,255,255,0.28);
    font-size: 15px;
    color: #000;
    transition: 0.2s;
}

select.form-control {
    width: 104.85%;
    padding: 14px 15px;
    border: none;
    border-radius: 10px;
    background: rgba(255,255,255,0.28);
    font-size: 15px;
    color: #000;
    transition: 0.2s;
    
}
input.form-control::placeholder {
    color: #333;
    opacity: 0.8;
}
input.form-control:focus,
select.form-control:focus {
    outline: none;
    
    background: rgba(255,255,255,0.35);
}
.submit-btn {
    grid-column: span 2;
}
.meassage {
    background: rgba(255, 0, 0, 0.25);
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    color: #fff;
    text-align: center;
    font-weight: 500;
}
@media(max-width: 900px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .submit-btn {
        grid-column: span 1;
    }
}


    </style>
</head>
<body>
    <div class="nav">
        <a href="javascript:self.history.back()">Blood Care</a>
        <form action=""><button class="btn" style="width:auto,padding:8px 15px;">Logout</button></form>
</div>
<div class="container-box">
  <header>Create Account</header>
  <form method="post">

<div class="form-grid">

    <div>
        <label>First Name</label>
        <input type="text" class="form-control" name="First_Name" placeholder="Enter first name" required>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" class="form-control" name="Last_Name" placeholder="Enter last name" required>
    </div>

    <div>
        <label>Blood Group</label>
        <select class="form-control" name="Group">
            <option>A+</option><option>B+</option><option>AB+</option>
            <option>B-</option><option>O+</option><option>O-</option>
        </select>
    </div>

    <div>
        <label>Age</label>
        <input type="number" class="form-control" name="Age" placeholder="Enter age" required>
    </div>

    <div>
        <label>Weight</label>
        <input type="number" class="form-control" name="Weight" placeholder="Enter weight" required>
    </div>

    <div>
        <label>Phone</label>
        <input type="text" class="form-control" name="Phone" placeholder="Enter number" required>
    </div>

    <div>
        <label>Address</label>
        <input type="text" class="form-control" name="Address" placeholder="Enter address" required>
    </div>

    <div>
        <label>Last Donation Date</label>
        <input type="date" class="form-control" name="Last">
    </div>

    <button class="btn submit-btn" type="submit" name="submit">Submit</button>

</div>
</form>
</div>
</body>
</html>