/*
<?php

$servername = "localhost";
$username = "root";
$database = "microcaps";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully<br>";
// session_start();
$_SESSION['errors'] = '';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$nic = $_POST['nic'];

if (!(strlen($nic) == 12 || (strlen($nic) == 10 && strtoupper(substr($nic, 9)) == "V"))) {
    $_SESSION['errors'] = [
        "nic" => "*Invalid NIC number!"
    ];
    redirect("admins/add");
}

$empid = $_POST['empid'];
$address = $_POST['address'];
$email = $_POST['email'];
$role = $_POST['role'];

if (!((strtoupper($role) == "TESTER") ||
    (strtoupper($role) == "SUPERVISOR") ||
    (strtoupper($role) == "MANAGER") ||
    (strtoupper($role) == "ADMIN") ||
    (strtoupper($role) == "ASSEMBLER"))) {
    $_SESSION['errors'] = [
        "role" => "*Invalid user role!"
    ];
    redirect("admins/add");
}

$stageno = $_POST['stageNo'];

$teleno = $_POST['teleno'];

// var_dump("SELECT * FROM employee WHERE Firstname='Maxwell'");

$MAIL = mysqli_query($conn, "SELECT Email FROM employee WHERE Email = '$email'");
$ID = mysqli_query($conn, "SELECT EmployeeId FROM employee WHERE EmployeeId = $empid");
$MOBILE = mysqli_query($conn, "SELECT TelephoneNo FROM employee WHERE TelephoneNo = $teleno");
// echo "--";
// print_r($ID->num_rows);
// // print_r($ID);
// echo "--";

if ($MAIL->num_rows > 0) {
    $_SESSION['errors'] = [
        "mail" => "*Email address already exists!"
    ];
    redirect("admins/add");
}



if ($MOBILE->num_rows > 0) {
    $_SESSION['errors'] = [
        "mobile" => "*Mobile number already exists!"
    ];
    redirect("admins/add");
}


if ($ID->num_rows > 0) {
    $_SESSION['errors'] = [
        "id" => "*Employee id already exists!"
    ];
    redirect("admins/add");
}

$sql = "INSERT INTO employee (EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo) VALUES ('$empid', '$fname', '$lname', '$teleno', '$email', '$role', '$stageno')";
$result = mysqli_query($conn, $sql);
if ($result) {
    redirect("admins/add");
} else {
    echo "Query Unsuccessfully" . $connection->error;
}

// try {
//     $sql = "INSERT INTO employee (EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo) VALUES ('$empid', '$fname', '$lname', '$teleno', '$email', '$role', '$stageno')";
//     $result = mysqli_query($conn, $sql);
//     if ($result) {
//         //redirect("admins/add");
//     } else {
//         echo "Query Unsuccessfully" . $connection->error;
//     }
// } catch (\Exception $e) {
//     $_SESSION['errors'] = [
//         "stageNo" => "*Invalid stage number!"
//     ];
//     //redirect("admins/add");
//
//}

?>