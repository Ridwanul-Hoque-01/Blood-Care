<?php
session_start();
include 'database.php';

if(!isset($_SESSION['ID'])){
    header("Location:BloodBank_login.php");
}

$id = $_SESSION['ID'];
$name = $_SESSION['Name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Bank Dashboard</title>

<style>
/* GLOBAL STYLE */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg, rgba(230,57,70,0.8), rgba(244,180,180,0.8));
    color:#fff;
}

/* HEADER */
.header{
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(8px);
    border-radius:12px;
    padding:20px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:20px auto;
    max-width:1200px;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
}

.header h2{
    font-size:2em;
    text-shadow:1px 2px 6px rgba(0,0,0,0.3);
}

.header p{
    font-size:0.9em;
    margin-top:4px;
}

/* BUTTON */
.btn{
    height:50px;
    width:220px;
    background:#e63946;
    border:0;
    border-radius:8px;
    color:#fff;
    font-size:16px;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:#b71c1c;
    transform:translateY(-2px);
}

.container{
    display:flex;
    max-width:1200px;
    margin:20px auto;
    gap:20px;
    flex-wrap:wrap;
}

/* SIDEBAR */
.sidebar{
    flex:1;
    min-width:220px;
    display:flex;
    flex-direction:column;
    gap:15px;
}

/* MAIN CONTENT */
.main-content{
    flex:3;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(8px);
    padding:30px;
    border-radius:16px;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
}

.main-content h1{
    margin-bottom:15px;
    font-size:2em;
    text-shadow:1px 2px 6px rgba(0,0,0,0.3);
}

/* BLOG SECTION */
.blog{
    margin-top:30px;
}

.blog h2{
    margin-bottom:15px;
    text-shadow:1px 2px 6px rgba(0,0,0,0.3);
}

.blog-card{
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(6px);
    border-radius:12px;
    overflow:hidden;
    margin-bottom:20px;
    box-shadow:0 6px 20px rgba(0,0,0,0.2);
    transition:0.3s;
}

.blog-card:hover{
    transform:translateY(-5px);
}

.blog-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

/* FOOTER */
footer{
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(8px);
    text-align:center;
    padding:20px;
    margin-top:40px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
}

@media(max-width:700px){
    .container{
        flex-direction:column;
    }
    .sidebar{
        flex-direction:row;
        justify-content:space-around;
    }
    .btn{
        width:150px;
    }
}
</style>
</head>
<body>


<div class="header">
    <div>
        <h2>Hello <b><?php echo $name ?></b></h2>
        <p>ID: <?php echo $id ?></p>
    </div>

    <form action="logout.php">
        <button type="submit" class="btn">Logout</button>
    </form>
</div>


<div class="container">

   
    <div class="sidebar">
        <form action="Blood_stock.php"><button type="submit" class="btn">Blood Stock</button></form>
        <form action="transfer.php"><button type="submit" class="btn">Transfer Blood</button></form>
        <form action="record_donation.php"><button type="submit" class="btn">Record Donation</button></form>
    </div>


    <div class="main-content">
        <h1>Welcome to the Blood Bank Portal</h1>
        <p>
            Manage blood stock, record donations, handle inter-bank transfers, and monitor availability with ease.
            This dashboard centralizes all operations required by blood banks to function efficiently.
        </p>

   
        <div class="blog">
            <h2>Blood Bank Insights</h2>

        
            <div class="blog-card">
                <img src="" alt="">
                <div class="blog-card-content">
                    <h3>How to Maintain Blood Stock Properly</h3>
                    <p>Learn how blood banks keep track of inventory, maintain proper storage conditions, and prevent shortages during emergencies.</p>
                </div>
            </div>

          
            <div class="blog-card">
                <img src="" alt="">
                <div class="blog-card-content">
                    <h3>Safe Blood Transfer Procedures</h3>
                    <p>Explore guidelines for transporting blood safely between hospitals and blood banks while maintaining quality.</p>
                </div>
            </div>

        
            <div class="blog-card">
                <img src="" alt="">
                <div class="blog-card-content">
                    <h3>Importance of Accurate Donor Records</h3>
                    <p>Accurate donor histories ensure safety, reliability, and compliance with medical regulations.</p>
                </div>
            </div>

        </div>
    </div>

</div>

<footer>
    <p>Contact us for support and assistance</p>
</footer>

</body>
</html>
