<?php
session_start();

class Donner {
    private $con;
    private $id;

    public function __construct($con, $id) {
        $this->con = $con;
        $this->id  = $id;
    }

    public function getUser() {
        $sql = "SELECT * FROM donner WHERE ID={$this->id}";
        $query = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($query);
    }

    public function phoneExists($phone) {
        $sql = "SELECT Phone FROM Donner WHERE ID!={$this->id} AND Phone='$phone'";
        $query = mysqli_query($this->con, $sql);
        return mysqli_num_rows($query) > 0;
    }

    public function updateUser($data) {

        $First_Name = $data['First_Name'];
        $Last_Name  = $data['Last_Name'];
        $Blood      = $data['Group'];
        $Age        = $data['Age'];
        $Weight     = $data['Weight'];
        $Last       = $data['Last'];
        $phone      = $data['Phone'];
        $Address    = $data['Address'];
        $Verified   = "No";

        $sql = "
           UPDATE donner SET
             First_Name='$First_Name',
             Last_Name='$Last_Name',
             Blood_Group='$Blood',
             Age='$Age',
             Weight='$Weight',
             Phone='$phone',
             Address='$Address',
             Last_Donation='$Last',
             Verified='$Verified'
           WHERE ID='{$this->id}'
        ";

        return mysqli_query($this->con, $sql);
    }
}

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="form_style.css">
<title>Change Info</title>
</head>

<body>

<div class="nav">
    <a href="User_dashboard.php">Logo</a>
    <form action="logout.php">
        <button type="submit" class="btn" style="width:auto;padding:8px 15px;">Logout</button>
    </form>
</div>

<div class="container-box">

<?php




/* -------------------- DATABASE INCLUDED SAME -------------------- */

include 'database.php';  // KEEPING EXACTLY SAME AS YOU REQUESTED
$id = $_SESSION['ID'];

$donner = new Donner($con, $id);
$result = $donner->getUser();

$re_firstname = $result['First_Name'];
$re_lastname  = $result['Last_Name'];
$re_blood     = $result['Blood_Group'];
$re_age       = $result['Age'];
$re_weight    = $result['Weight'];
$re_last      = $result['Last_Donation'];
$re_phone     = $result['Phone'];
$re_address   = $result['Address'];


/* -------------------- FORM SUBMIT -------------------- */

if (isset($_POST['submit'])) {

    if ($donner->phoneExists($_POST['Phone'])) {

        echo "<div class='meassage'><p>This Number already exist, Try another one Please!</p></div>";
        echo "<a href='javascript:history.back()'><button class='btn'>Go Back</button>";

    } else {

        if ($donner->updateUser($_POST)) {

            echo "<div class='meassage'><p>Your Update is Under Verification</p></div>";
            echo "<a href='Donor_registration.php'><button class='btn'>Back</button>";

        } else {
            die(mysqli_error($con));
        }
    }

} else {
?>

<!-- -------------------- SAME HTML (UNCHANGED) -------------------- -->

<header>Change Info</header>

<form method="post">

<div class="form-grid">

    <div>
        <label>First Name</label>
        <input type="text" class="form-control" name="First_Name"
        value="<?php echo $re_firstname ?>" required>
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" class="form-control" name="Last_Name"
        value="<?php echo $re_lastname ?>" required>
    </div>

    <div>
        <label>Blood Group</label>
        <select class="form-control" name="Group">
            <option selected><?php echo $re_blood ?></option>
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
        value="<?php echo $re_age ?>" required>
    </div>

    <div>
        <label>Weight</label>
        <input type="number" class="form-control" name="Weight"
        value="<?php echo $re_weight ?>" required>
    </div>

    <div>
        <label>Phone</label>
        <input type="text" class="form-control" name="Phone"
        value="<?php echo $re_phone ?>" required>
    </div>

    <div>
        <label>Address</label>
        <input type="text" class="form-control" name="Address"
        value="<?php echo $re_address ?>" required>
    </div>

    <div>
        <label>Last Donation Date</label>
        <input type="date" class="form-control" name="Last"
        value="<?php echo $re_last ?>">
    </div>

    <button class="btn submit-btn" type="submit" name="submit">Re-Submit</button>

</div>

</form>

<?php } ?>

</div>

</body>
</html>
