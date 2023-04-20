<?php
class Tester {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findUserByUsername($username) {

        $this->db->query('SELECT * FROM employee-credentials  WHERE employee-credentials.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function findUserByID($EmployeeID) {

        $this->db->query('SELECT * FROM `employee-credentials`  WHERE `employee-credentials`.`EmployeeID` = :EmployeeID');

        $this->db->bind(':EmployeeID', $EmployeeID);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    // public function findDefectByID($DefectNo) {

    //     $this->db->query('SELECT * FROM `defects`  WHERE `defects`.`DefectNo` = :DefectNo');

    //     $this->db->bind(':DefectNo', $DefectNo);

    //     $row = $this->db->single();

    //     if ($this->db->rowCount()) {
    //         return true;
    //     } else {
    //         return false;
    //     }

    // }

    public function vehicleCount(){
        $counts = array();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS inLine
            FROM `vehicle`
            WHERE `vehicle`.`CurrentStatus` = "PDI";'
        );
        $counts[] = $this->db->single();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS dispatched
            FROM `vehicle`
            WHERE `vehicle`.`PDIStatus` = "CM";'
        );
        $counts[] = $this->db->single();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS onHold
            FROM `vehicle`
            WHERE `vehicle`.`CurrentStatus` = "Hold";'
        );
        $counts[] = $this->db->single();

        if ($counts) {
            return $counts;
        } else {
            return false;
        }
    }

    public function findDefectExists($DefectNo, $ChassisNo) {

        $this->db->query('SELECT * FROM `pdi-defect` WHERE `pdi-defect`.`DefectNo` = :DefectNo AND `pdi-defect`.`ChassisNo` = :ChassisNo');


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

        $this->db->query('SELECT * FROM `pdi-defect` WHERE `pdi-defect`.`DefectNo` = :DefectNo AND `pdi-defect`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;

    }

    public function getPDI($ChassisNo, $CheckId) {

        $this->db->query('SELECT * FROM `pdi-result` WHERE `pdi-result`.`CheckId` = :CheckId AND `pdi-result`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $CheckId);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;
    }

    public function selectVehicle(){
        $this->db->query('SELECT ChassisNo FROM `vehicle` WHERE `vehicle`.`CurrentStatus` = "PDI"');

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function viewDefectSheets($id) {
        $this->db->query(
            "SELECT `pdi-defect`.`DefectNo`, 
            `pdi-defect`.`RepairDescription`, 
            `pdi-defect`.`InspectionDate`, 
            `pdi-defect`.`ChassisNo`,
            `pdi-defect`.`EmployeeID`, 
            `pdi-defect`.`ReCorrection` 
            FROM `pdi-defect`
            WHERE `pdi-defect`.`ChassisNo` = :id"
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
            "INSERT INTO `pdi-defect` (`DefectNo`, `ChassisNo`, `EmployeeID`, `InspectionDate`, `RepairDescription`, `ReCorrection`) 
            VALUES (:DefectNo, :ChassisNo, :EmployeeID, :InspectionDate, :RepairDescription, :ReCorrection)"
        );

        $this->db->bind(':DefectNo', $data['DefectNo']);
        $this->db->bind(':InspectionDate', $data['InspectionDate']);
        $this->db->bind(':ChassisNo', $data['ChassisNo']);
        $this->db->bind(':EmployeeID', $data['EmployeeID']);
        $this->db->bind(':ReCorrection', $data['ReCorrection']);
        $this->db->bind(':RepairDescription', $data['RepairDescription']);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function editDefect($data) {

        $this->db->query(
            "UPDATE `pdi-defect`
            SET `InspectionDate` = :InspectionDate,
            `EmployeeID` = :EmployeeID,
            `ReCorrection` = :ReCorrection,
            `RepairDescription` = :RepairDescription
            WHERE `pdi-defect`.`ChassisNo` = :ChassisNo AND `pdi-defect`.`DefectNo` = :DefectNo"
        );

        $this->db->bind(':DefectNo', $data['DefectNo']);
        $this->db->bind(':InspectionDate', $data['InspectionDate']);
        $this->db->bind(':ChassisNo', $data['ChassisNo']);
        $this->db->bind(':EmployeeID', $data['EmployeeID']);
        $this->db->bind(':ReCorrection', $data['ReCorrection']);
        $this->db->bind(':RepairDescription', $data['RepairDescription']);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteDefect($ChassisNo, $DefectNo) {

        $this->db->query(
            "DELETE FROM `pdi-defect` 
            WHERE `pdi-defect`.`DefectNo` = :DefectNo AND `pdi-defect`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function addPDI($v1,$v2,$v3) {
        $this->db->query(
            "UPDATE `pdi-result` 
            SET `Status` = :Status
            WHERE `pdi-result`.`CheckId` = :CheckId AND `pdi-result`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':ChassisNo', $v1);
        $this->db->bind(':CheckId', $v2);
        $this->db->bind(':Status', $v3);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function viewPDI($id){
        $this->db->query(
            "SELECT `pdi-result`.`ChassisNo`,
                         `pdi-result`.`CheckId`, 
                         `pdi-result`.`Status`, 
                         `pdi-result`.`EmployeeID`, 
                         `pdi-check`.`CheckName`, 
                         `pdi-check`.`categoryid` 
            FROM `pdi-result` 
            INNER JOIN `pdi-check` 
            ON `pdi-result`.`CheckId` = `pdi-check`.`CheckId` 
            WHERE `pdi-result`.`ChassisNo` = :id"
        );

        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function pdiVehicle($id){
        $this->db->query('SELECT ChassisNo, EngineNo FROM `vehicle` WHERE `vehicle`.`ChassisNo` = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if ( $result ) {
            return $result;
        } else {
            return null;
        }
    }

    public function onPDIVehicles() {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.EngineNo
                FROM `vehicle`
                WHERE `vehicle`.CurrentStatus = :status AND `vehicle`.PDIStatus = :pdi
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':status', 'PDI');
        $this->db->bind(':pdi', 'NC');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function pdiCheckCategories() {
        $this->db->query(
            'SELECT *
                FROM `pdi-check-category`'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }

    }

    public function pdiCheckList($id) {
        $this->db->query(
            'SELECT `pdi-result`.*,`pdi-check`.CategoryId, `pdi-check`.CheckName
                FROM `pdi-result`
                INNER JOIN `pdi-check`
                ON `pdi-result`.CheckId = `pdi-check`.CheckId 
                WHERE `pdi-result`.ChassisNo = :id;'
        );

        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function userDetails($id) {
        $this->db->query(
            'SELECT *
                FROM employee
                WHERE EmployeeID = :id'
        );

        $this->db->bind(':id', $id);

        $results = $this->db->single();

        if ( $results ) {
            return $results;
        } else {
            return null;
        }
    }

    public function updateProfile($id, $firstname, $lastname, $email, $mobile, $nic, $image): bool {
        $this->db->query(
            'UPDATE employee
            SET firstname = :firstname, lastname = :lastname, email = :email, telephoneno = :mobile, nic = :nic, image = :image
            WHERE EmployeeID = :id'
        );

        $this->db->bind(':id', $id);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':mobile', $mobile);
        $this->db->bind(':nic', $nic);
        $this->db->bind(':image', $image);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfileValues($id, $firstname, $lastname, $email, $mobile, $nic): bool {
        $this->db->query(
            'UPDATE employee
            SET firstname = :firstname, lastname = :lastname, email = :email, telephoneno = :mobile, nic = :nic
            WHERE EmployeeID = :id'
        );

        $this->db->bind(':id', $id);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':mobile', $mobile);
        $this->db->bind(':nic', $nic);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }
}