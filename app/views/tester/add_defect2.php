<?php
$_SESSION["errors"] = "";
$connection = mysqli_connect('localhost', 'root', '', 'microcaps');

   
    $DefectNo = $_POST['DefectNo'];
    $InspectionDate = $_POST['InspectionDate'];
    $ChassisNo = $_POST['ChassisNo'];
    $EmployeeID = $_POST['EmployeeID'];
    $ReCorrection = $_POST['ReCorrection'];
    // $DefectDescription = $_POST['DefectDescription'];

    
    $QR = mysqli_query($connection, "SELECT * FROM cardefect WHERE ChassisNo = '$ChassisNo' AND DefectNo = '$DefectNo'");
    $EMP_exists = mysqli_query($connection, "SELECT * FROM employee WHERE EmployeeID = '$EmployeeID'");
    // print_r($QR);
    
    if($QR->num_rows > 0){
        $_SESSION["errors"] = [
            "primary" => "*Defect Already Exists"
        ];
        redirect("testers/add_defect ? ChassisNo=$ChassisNo");
    }

    if($EMP_exists->num_rows == 0){
        $_SESSION["errors"] = [
            "exists" => "*Employee ID does not exists"
        ];
        redirect("testers/add_defect ? ChassisNo=$ChassisNo");
    }

    $sql= "INSERT INTO `cardefect` (`DefectNo`, `InspectionDate`, `ChassisNo`, `EmployeeID`, `ReCorrection`) VALUES ('$DefectNo','$InspectionDate','$ChassisNo','$EmployeeID','$ReCorrection')"; 


    $result = mysqli_query($connection, $sql);
    if ($result)
    {
        redirect("testers/defect_sheet ? ChassisNo=$ChassisNo");
    }
    else
    {
        echo "Query Unsuccessfully". $connection->error;
    }

?>