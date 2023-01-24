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

$sql1 = "SELECT EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo FROM employee WHERE Position = 'Manager'";
$sql2 = "SELECT EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo FROM employee WHERE Position = 'Supervisor'";
$sql3 = "SELECT EmployeeId, Firstname, Lastname, TelephoneNo, Email, Position, StageNo FROM employee WHERE Position= 'Tester'";

$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);

 ?>
