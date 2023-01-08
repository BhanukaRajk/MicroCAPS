/*
 <?php 

$servername = "localhost";
$username = "root";
$database = "microcaps";
$password = "password";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

// $fname = $_POST['fname'];
// $lname = $_POST['lname'];
// $nic = $_POST['nic'];
// $empid = $_POST['empid'];
// $address = $_POST['address'];
// $email = $_POST['email'];
// $role = $_POST['role'];
// $stageno = $_POST['stageno'];
// $teleno = $_POST['teleno'];

$sql = "INSERT INTO employee (EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo) VALUES ('$empid', '$fname', '$lname', '$teleno', '$email', '$role', '$stageno')";
$sql = "INSERT INTO employee (EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo) VALUES ('$empid', '$fname', '$lname', '$teleno', '$email', '$role', '$stageno')";

$result = mysqli_query($conn, $sql);
    if ($result)
    {
        redirect("admins/add");
    }
    else
    {
        echo "Query Unsuccessfully". $connection->error;
    }


 ?>
