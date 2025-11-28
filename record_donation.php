<?php
session_start();
include 'database.php';

if(!isset($_SESSION['ID'])){
    header("Location: banklogin.php");
    exit();
}

class Donation {

    private $con;
    private $bank_id;

    public function __construct($con, $bank_id){
        $this->con = $con;
        $this->bank_id = $bank_id;
    }

    public function getDonor($id){
        $q = mysqli_query($this->con, "SELECT * FROM donner WHERE ID='$id'");
        return mysqli_num_rows($q) ? mysqli_fetch_assoc($q) : false;
    }

    public function addDonor($name,$blood,$age,$weight,$phone,$address,$date){
        mysqli_query($this->con, "INSERT INTO crud (Name,Phone,Address) VALUES ('$name','$phone','$address')");
        $id = mysqli_insert_id($this->con);

        $p = explode(" ",$name,2);
        $f = $p[0];
        $l = $p[1] ?? "";

        mysqli_query($this->con,"INSERT INTO donner (ID,First_Name,Last_Name,Blood_Group,Age,Weight,Phone,Address,Last_Donation,Verified)
                                 VALUES('$id','$f','$l','$blood','$age','$weight','$phone','$address','$date','1')");
        return $id;
    }

    public function updateDonor($id,$name,$blood,$age,$weight,$phone,$address,$date){
        $p = explode(" ",$name,2);
        $f = $p[0];
        $l = $p[1] ?? "";

        mysqli_query($this->con,"UPDATE donner SET First_Name='$f',Last_Name='$l',Blood_Group='$blood',
                                 Age='$age',Weight='$weight',Phone='$phone',Address='$address',
                                 Last_Donation='$date' WHERE ID='$id'");
    }

    public function addDonation($did,$blood,$qty,$date){
        mysqli_query($this->con,"INSERT INTO donation (Donor_ID,Bank_ID,Blood_Group,Quantity,Donation_Date)
                                 VALUES('$did','$this->bank_id','$blood','$qty','$date')");
    }

    public function updateStock($blood,$qty){
        $q = mysqli_query($this->con,"SELECT * FROM blood_stock WHERE Bank_ID='$this->bank_id' AND Blood_Group='$blood'");
        if(mysqli_num_rows($q))
            mysqli_query($this->con,"UPDATE blood_stock SET Quantity=Quantity+$qty WHERE Bank_ID='$this->bank_id' AND Blood_Group='$blood'");
        else
            mysqli_query($this->con,"INSERT INTO blood_stock (Bank_ID,Blood_Group,Quantity) VALUES('$this->bank_id','$blood','$qty')");
    }
}

$obj = new Donation($con,$_SESSION['ID']);

$message = "";
$is_new = isset($_POST['is_new']);
$donor = ["name"=>"","blood"=>"","age"=>"","weight"=>"","phone"=>"","address"=>""];
$donor_id = "";
$quantity = "";


// FETCH DONOR
if(isset($_POST['fetch']) && !$is_new){
    $donor_id = $_POST['donor_id'];
    $data = $obj->getDonor($donor_id);

    if($data){
        $donor["name"] = $data["First_Name"]." ".$data["Last_Name"];
        $donor["blood"] = $data["Blood_Group"];
        $donor["age"] = $data["Age"];
        $donor["weight"] = $data["Weight"];
        $donor["phone"] = $data["Phone"];
        $donor["address"] = $data["Address"];
    } else {
        $message = "<div class='meassage error'>Donor not found</div>";
        $donor_id = "";
    }
}


// SUBMIT
if(isset($_POST['submit'])){
    $donor_id = $_POST['donor_id'];
    $donor["name"] = trim($_POST['name']);
    $donor["blood"] = $_POST['blood'];
    $donor["age"] = $_POST['age'];
    $donor["weight"] = $_POST['weight'];
    $donor["phone"] = $_POST['phone'];
    $donor["address"] = $_POST['address'];
    $quantity = $_POST['quantity'];
    $date = date("Y-m-d");

    if($quantity <= 0){
        $message = "<div class='meassage error'>Enter valid quantity</div>";
    }
    else{
        if($is_new){
            $donor_id = $obj->addDonor($donor["name"],$donor["blood"],$donor["age"],$donor["weight"],$donor["phone"],$donor["address"],$date);
        } else {
            $obj->updateDonor($donor_id,$donor["name"],$donor["blood"],$donor["age"],$donor["weight"],$donor["phone"],$donor["address"],$date);
        }

        $obj->addDonation($donor_id,$donor["blood"],$quantity,$date);
        $obj->updateStock($donor["blood"],$quantity);

        $message = "<div class='meassage success'>Donation Recorded! Donor ID: $donor_id</div>";
        if($is_new) $donor = ["name"=>"","blood"=>"","age"=>"","weight"=>"","phone"=>"","address"=>""];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Blood Care</title>
<link rel="stylesheet" href="form_style.css">
</head>

<body>

<div class="nav">
    <a href="#">Blood Bank</a>
    <form action="logout.php"><button class="btn">Logout</button></form>
</div>

<div class="container-box">
<header>Record Donation</header>

<?php if($message) echo $message; ?>

<form method="post">
<div class="form-grid">

<div class="full">
<label><input type="checkbox" name="is_new" onchange="this.form.submit();" <?php if($is_new) echo "checked"; ?>> New Donor</label>
</div>

<div>
<label>Donor ID</label>
<input type="text" class="form-control" name="donor_id" value="<?php echo !$is_new?$donor_id:''; ?>" <?php if($is_new) echo "readonly"; ?>>
</div>

<div>
<label>&nbsp;</label>
<button name="fetch" class="btn" <?php if($is_new) echo "disabled"; ?>>Fetch</button>
</div>

<div>
<label>Name</label>
<input class="form-control" name="name" value="<?php echo $donor["name"]; ?>">
</div>

<div>
<label>Blood Group</label>
<select class="form-control" name="blood">
<?php
$g = ["A+","A-","B+","B-","AB+","AB-","O+","O-"];
foreach($g as $b) echo "<option ".($donor["blood"]==$b?"selected":"").">$b</option>";
?>
</select>
</div>

<div>
<label>Age</label>
<input class="form-control" name="age" type="number" value="<?php echo $donor["age"]; ?>">
</div>

<div>
<label>Weight</label>
<input class="form-control" name="weight" type="number" value="<?php echo $donor["weight"]; ?>">
</div>

<div>
<label>Phone</label>
<input class="form-control" name="phone" value="<?php echo $donor["phone"]; ?>">
</div>

<div>
<label>Address</label>
<input class="form-control" name="address" value="<?php echo $donor["address"]; ?>">
</div>

<div>
<label>Quantity</label>
<input class="form-control" name="quantity" type="number">
</div>

<div>
<label>Date</label>
<input class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
</div>

<button class="btn submit-btn" name="submit">Submit</button>

</div>
</form>
</div>

</body>
</html>
