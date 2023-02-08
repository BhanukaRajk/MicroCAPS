<?php
class Tester {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findUserByUsername($username) {

        $this->db->query('SELECT * FROM credentials  WHERE credentials.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function findUserByID($EmployeeID) {

        $this->db->query('SELECT * FROM `credentials`  WHERE `credentials`.`EmployeeID` = :EmployeeID');

        $this->db->bind(':EmployeeID', $EmployeeID);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function findDefectByID($DefectNo) {

        $this->db->query('SELECT * FROM `defects`  WHERE `defects`.`DefectNo` = :DefectNo');

        $this->db->bind(':DefectNo', $DefectNo);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function findDefectExists($DefectNo, $ChassisNo) {

        $this->db->query('SELECT * FROM `cardefect` WHERE `cardefect`.`DefectNo` = :DefectNo AND `cardefect`.`ChassisNo` = :ChassisNo');


        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function getDefect($ChassisNo, $DefectNo) {

        $this->db->query('SELECT * FROM `cardefect` WHERE `cardefect`.`DefectNo` = :DefectNo AND `cardefect`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;

    }

    public function getPDI($ChassisNo, $CheckId) {

        $this->db->query('SELECT * FROM `carpdi` WHERE `carpdi`.`CheckId` = :CheckId AND `carpdi`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $CheckId);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;
    }



    public function login($username,$password) {
        $this->db->query(
            'SELECT credentials.Username, credentials.Password, employee.EmployeeID, employee.Firstname, employee.Lastname, employee.Position
            FROM credentials
            INNER JOIN employee
            ON credentials.EmployeeID = employee.EmployeeId
            WHERE credentials.Username = :username'
        );

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ( $password == $row->Password ) {
            return $row;
        } else {
            return null;
        }
    }

    public function selectVehicle(){
        $this->db->query('SELECT ChassisNo FROM `car`');

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function viewDefectSheets($id) {
        $this->db->query(
            "SELECT cardefect.DefectNo, 
            defects.DefectDescription, 
            cardefect.InspectionDate, 
            cardefect.ChassisNo,
            cardefect.EmployeeID, 
            cardefect.ReCorrection 
            FROM `cardefect` INNER JOIN `defects` 
            ON cardefect.DefectNo = defects.DefectNo 
            WHERE cardefect.ChassisNo = :id"
        );

        $this->db->bind(':id', $id);

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function addDefect($data) {
        $this->db->query(
            "INSERT INTO `cardefect` (`DefectNo`, `InspectionDate`, `ChassisNo`, `EmployeeID`, `ReCorrection`) 
            VALUES (:DefectNo, :InspectionDate, :ChassisNo, :EmployeeID, :ReCorrection)"
        );

        $this->db->bind(':DefectNo', $data['DefectNo']);
        $this->db->bind(':InspectionDate', $data['InspectionDate']);
        $this->db->bind(':ChassisNo', $data['ChassisNo']);
        $this->db->bind(':EmployeeID', $data['EmployeeID']);
        $this->db->bind(':ReCorrection', $data['ReCorrection']);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function editDefect($data) {

        $this->db->query(
            "UPDATE `cardefect`
            SET `InspectionDate` = :InspectionDate,
            `EmployeeID` = :EmployeeID,
            `ReCorrection` = :ReCorrection
            WHERE `ChassisNo` = :ChassisNo AND `DefectNo` = :DefectNo"
        );

        $this->db->bind(':DefectNo', $data['DefectNo']);
        $this->db->bind(':InspectionDate', $data['InspectionDate']);
        $this->db->bind(':ChassisNo', $data['ChassisNo']);
        $this->db->bind(':EmployeeID', $data['EmployeeID']);
        $this->db->bind(':ReCorrection', $data['ReCorrection']);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteDefect($ChassisNo, $DefectNo) {

        $this->db->query(
            "DELETE FROM `cardefect` 
            WHERE `cardefect`.`DefectNo` = :DefectNo AND `cardefect`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function recordPDI($data) {
        $this->db->query(
            "INSERT INTO `carpdi` (`ChassisNo`, `CheckId`, `Status`, `EmployeeID`) 
            VALUES (:ChassisNo, :CheckId, :Status, :EmployeeID)"
        );

        $this->db->bind(':ChassisNo', $data['ChassisNo']);
        $this->db->bind(':CheckId', $data['CheckId']);
        $this->db->bind(':Status', $data['Status']);
        $this->db->bind(':EmployeeID', $data['EmployeeID']);
    }

    public function viewPDI(){
        $this->db->query(
            "SELECT * FROM `pdichecks`"
        );

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }


}