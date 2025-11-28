<?php
session_start();
include "database.php";

if(!isset($_SESSION['ID'])){
    header("Location: BloodBank_login.php");
    exit();
}

$bank = $_SESSION['ID'];
$message = "";

//  HANDLE NEW REQUEST 
if(isset($_POST['send_request'])){
    $provider = $_POST['provider'];
    $group = $_POST['group'];
    $qty = $_POST['qty'];

    if($provider == $bank){
        $_SESSION['msg'] = "<div class='meassage error'>Cannot request from yourself.</div>";
    } else {
        mysqli_query($con, "INSERT INTO blood_transfer_requests (requester_bank_id, provider_bank_id, blood_group, quantity) 
                            VALUES ('$bank','$provider','$group','$qty')");
        $_SESSION['msg'] = "<div class='meassage success'>Request sent successfully!</div>";
    }
    header("Location: transfers.php");
    exit();
}

//  HANDLE ACCEPT / REJECT 
if(isset($_POST['action'])){
    $id = $_POST['id'];
    $req = $_POST['req'] ?? '';
    $group = $_POST['group'] ?? '';
    $qty = $_POST['qty'] ?? 0;

    if($_POST['action'] == "accept"){
        $row = mysqli_fetch_assoc(mysqli_query($con, "SELECT Quantity FROM blood_stock WHERE Bank_ID='$bank' AND Blood_Group='$group'"));
        $stock = $row ? $row['Quantity'] : 0;

        if($stock >= $qty){
            mysqli_query($con, "UPDATE blood_transfer_requests SET request_status='accepted' WHERE request_id='$id'");
            $tid = "T".time();
            mysqli_query($con, "INSERT INTO transfer (Transfer_ID, From_Bank, To_Bank, Blood_Group, Units)
                                VALUES('$tid','$bank','$req','$group','$qty')");
            $_SESSION['msg'] = "<div class='meassage success'>Request accepted!</div>";
        } else {
            $_SESSION['msg'] = "<div class='meassage error'>Not enough stock. You have $stock units.</div>";
        }
    } else if($_POST['action'] == "reject"){
        mysqli_query($con, "UPDATE blood_transfer_requests SET request_status='rejected' WHERE request_id='$id'");
        $_SESSION['msg'] = "<div class='meassage success'>Request rejected.</div>";
    }

    header("Location: transfers.php");
    exit();
}

// MESSAGE 
if(isset($_SESSION['msg'])){
    $message = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

// FETCH DATA
$banks = mysqli_query($con, "SELECT Bank_ID, Name FROM blood_bank WHERE verify=1 AND Bank_ID!='$bank'");
$incoming = mysqli_query($con, "SELECT * FROM blood_transfer_requests WHERE provider_bank_id='$bank' AND request_status='pending'");
$outgoing = mysqli_query($con, "SELECT * FROM blood_transfer_requests WHERE requester_bank_id='$bank'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="transfer.css">
<title>Blood Bank Transfers</title>

</head>
<body>

<div class="nav">
  <a href="Blood Bank.php">Dashboard</a>
  <form action="logout.php"><button class="btn">Logout</button></form>
</div>

<div class="container-box">
<header>Blood Transfers</header>

<?php if($message) echo $message; ?>

<div class="form-section">
<h3>Create Transfer Request</h3>
<form method="post">
<div class="form-group">
<label>Provider Bank</label>
<select name="provider" required>
<option value="">Select a bank</option>
<?php while($b=mysqli_fetch_assoc($banks)) {
    echo "<option value='".$b['Bank_ID']."'>".$b['Name']." (".$b['Bank_ID'].")</option>";
} ?>
</select>
</div>
<div class="form-group">
<label>Blood Group</label>
<select name="group" required>
<option value="">Select Group</option>
    <option>A+</option>
    <option>A-</option>
    <option>B+</option>
    <option>B-</option>
    <option>AB+</option>
    <option>AB-</option>
    <option>O+</option>
    <option>O-</option>
</select>
</div>
<div class="form-group">
<label>Quantity (Units)</label>
<input type="number" name="qty" min="1" required>
</div>
<button type="submit" name="send_request" class="btn">Send Request</button>
</form>
</div>

<div class="form-section">
<h3>Incoming Requests</h3>
<table>
<tr><th>Requester Bank</th><th>Blood Group</th><th>Qty</th><th>Action</th></tr>
<?php if(mysqli_num_rows($incoming)>0){
while($r=mysqli_fetch_assoc($incoming)){
    echo "<tr>
    <td>".$r['requester_bank_id']."</td>
    <td>".$r['blood_group']."</td>
    <td>".$r['quantity']."</td>
    <td>
        <form method='post' style='display:inline-block;'>
        <input type='hidden' name='id' value='".$r['request_id']."'>
        <input type='hidden' name='req' value='".$r['requester_bank_id']."'>
        <input type='hidden' name='group' value='".$r['blood_group']."'>
        <input type='hidden' name='qty' value='".$r['quantity']."'>
        <button type='submit' name='action' value='accept' class='btn-action btn-accept'>Accept</button>
        </form>
        <form method='post' style='display:inline-block;'>
        <input type='hidden' name='id' value='".$r['request_id']."'>
        <button type='submit' name='action' value='reject' class='btn-action btn-reject'>Reject</button>
        </form>
    </td>
    </tr>";
}} else { echo "<tr><td colspan='4'>No incoming requests.</td></tr>"; } ?>
</table>
</div>

<div class="form-section">
<h3>Outgoing Requests</h3>
<table>
<tr><th>Provider Bank</th><th>Blood Group</th><th>Qty</th><th>Status</th></tr>
<?php if(mysqli_num_rows($outgoing)>0){
while($r=mysqli_fetch_assoc($outgoing)){
    echo "<tr>
    <td>".$r['provider_bank_id']."</td>
    <td>".$r['blood_group']."</td>
    <td>".$r['quantity']."</td>
    <td>".ucfirst($r['request_status'])."</td>
    </tr>";
}} else { echo "<tr><td colspan='4'>No outgoing requests.</td></tr>"; } ?>
</table>
</div>

</div>
</body>
</html>