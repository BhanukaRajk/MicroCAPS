<?php
class Tester {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // ____________________USER DETAILS_____________________


    // FINDS USER BY USERNAME

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


    // FINDS USER BY ID

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


    // GET ALL USER DETAILS BY ID

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


    // UPDATE USER DETAILS

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


    // GET TESTER NAMES

    public function getTesterNames(){
        $this->db->query('SELECT `employee`.`EmployeeId`, `employee`.`Firstname`, `employee`.`Lastname` 
                                    FROM `employee`
                                    WHERE `employee`.`Position`= "Tester";');
        
        $results = $this->db->resultSet();

        if ($results) {
            return $results;
        } else {
            return false;
        }
    }


    // __________________VEHICLE DETAILS____________________



    // GET VEHICLE DETAILS BY CHASSIS NUMBER

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


    // GET VEHCILE DETAILS BY ASSIGNED TESTER ID

    public function PDIVehiclesByTester($id) {

        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName, `vehicle`.EngineNo 
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.PDIStatus = :pdi AND `vehicle`.TesterId = :id
                ORDER BY `vehicle`.`ArrivalDate` ASC
                LIMIT 10;'
        );

        $this->db->bind(':pdi', 'P');
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


    // GET VEHICLE COUNTS FOR THE DASHBOARD

    public function vehicleCount(){
        $counts = array();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS inLine
            FROM `vehicle`
            WHERE `vehicle`.CurrentStatus = "RR" AND `vehicle`.PDIStatus != "CM"'
        );
        $counts[] = $this->db->single();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS dispatched
            FROM `vehicle`
            WHERE `vehicle`.`CurrentStatus` = "D";'
        );
        $counts[] = $this->db->single();

        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS onHold
            FROM `vehicle`
            WHERE `vehicle`.`CurrentStatus` LIKE "S%" OR `vehicle`.`CurrentStatus` = "H"'
        );
        $counts[] = $this->db->single();

        if ($counts) {
            return $counts;
        } else {
            return false;
        }
    }


    // GET VEHICLE DETAILS THAT ARE READY TO TEST

    public function vehiclesReadyToTest() {

        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus,`vehicle`.PDIStatus, `vehicle-model`.ModelName, `vehicle`.EngineNo, `vehicle`.TesterId  
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :status AND `vehicle`.PDIStatus != :pdi
                ORDER BY `vehicle`.`ArrivalDate` ASC;'
        );

        $this->db->bind(':status', 'RR');
        $this->db->bind(':pdi', 'CM');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }



    // _______________DEFECT DETAILS_________________


    // CHECKS IF DEFECT EXISTS 

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


    // GET DEFECT DETAILS BY DEFECT NUMBER & CHASSIS NUMBER, RETURNS DEFECT DETAILS

    public function getDefect($ChassisNo, $DefectNo) {

        $this->db->query('SELECT * FROM `pdi-defect` WHERE `pdi-defect`.`DefectNo` = :DefectNo AND `pdi-defect`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $DefectNo);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;

    }


    // GET DEFECT DETAILS BY CHASSIS NUMBER, RETURNS DEFECT DETAILS

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


    // RECORD A DEFECT

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


    // EDIT DEFECT DETAILS

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


    // DELETE DEFECT DETAILS

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


    // CHECKS FOR NOT COMPLETED DEFECTS

    public function notCompletedDefect($chassisno){
        $this->db->query('SELECT `pdi-defect`.* 
                                    FROM `pdi-defect` 
                                    WHERE `pdi-defect`.`ChassisNo` = :chassisno AND `pdi-defect`.`ReCorrection` != :recorrection');

        $this->db->bind(':chassisno', $chassisno);
        $this->db->bind(':recorrection', 'Yes');

        $results = $this->db->resultSet();

        if ( $results ) {
            return true;
        } else {
            return false;
        }
    }


    // ----------- PDI DETAILS -----------


    // GET PDI DETAILS

    public function getPDI($ChassisNo, $CheckId) {

        $this->db->query('SELECT * FROM `pdi-result` WHERE `pdi-result`.`CheckId` = :CheckId AND `pdi-result`.`ChassisNo` = :ChassisNo');

        $this->db->bind(':DefectNo', $CheckId);
        $this->db->bind(':ChassisNo', $ChassisNo);

        $row = $this->db->single();

        return $row;
    }

    // UPDATE PDI RESULTS

    public function addPDI($v1,$v2,$v3) {
        $this->db->query(
            "UPDATE `pdi-result` 
            SET `Result` = :Result
            WHERE `pdi-result`.`CheckId` = :CheckId AND `pdi-result`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':ChassisNo', $v1);
        $this->db->bind(':CheckId', $v2);
        $this->db->bind(':Result', $v3);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // UPDATE PDI ALL RESULTS SAME TIME

    public function selectAllPDI($chassisno, $category, $result) {
        $this->db->query(
            "SELECT `pdi-check`.`CheckId` 
            FROM `pdi-check` WHERE `pdi-check`.`CategoryId` = :CategoryId"
        );

        $this->db->bind(':CategoryId', $category);

        $data['id'] = $this->db->resultSet();

        $flag = true;

        foreach($data['id'] as $value) {
            $this->db->query(
                "UPDATE `pdi-result` 
                SET `Result` = :Result 
                WHERE `pdi-result`.`ChassisNo` = :ChassisNo AND `pdi-result`.`CheckId` = :CheckId"
            );

            $this->db->bind(':ChassisNo', $chassisno);
            $this->db->bind(':CheckId', $value->CheckId);
            $this->db->bind(':Result', $result);

           if (!$this->db->execute()){
                $flag = false;
           }
        } 

        return $flag;
    }


    // GET PDI RESULTS

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


    // GET PDI CHECK CATEGORIES

    public function pdiCheckCategories() {
        $this->db->query(
            'SELECT `pdi-check-category`.`CategoryId`, `pdi-check-category`.`Title`, `pdi-check-category`.`SubTitle`,
            COUNT(*) AS count
            FROM `pdi-check-category`
            INNER JOIN `pdi-check`
            ON `pdi-check-category`.`CategoryId` = `pdi-check`.`CategoryId`
            GROUP BY `pdi-check-category`.`CategoryId`
            ORDER BY count ASC'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }

    }


    // GET PDI CHECK LIST OF A VECHICLE

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


    // CHECKS FOR NOT COMPLETED PDIs

    public function notCompletedPDI($chassisno){
        $this->db->query('SELECT `pdi-result`.* 
                                    FROM `pdi-result` 
                                    WHERE `pdi-result`.`ChassisNo` = :chassisno AND `pdi-result`.`Result` = :result');

        $this->db->bind(':chassisno', $chassisno);
        $this->db->bind(':result', 'SA');

        $results = $this->db->resultSet();

        if ( $results ) {
            return true;
        } else {
            return false;
        }
    }


    // --------------- TASK DETAILS ----------------


    // ADD A TASK

    public function addTask($chassisno,$testerid) {
        $this->db->query(
            "UPDATE `vehicle` 
            SET `TesterId` = :TesterId,
            `vehicle`.PDIStatus = :PDIStatus
            WHERE `vehicle`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':ChassisNo', $chassisno);
        $this->db->bind(':PDIStatus', 'P');
        $this->db->bind(':TesterId', $testerid);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }


    // REMOVE A TASK

    public function removeTask($chassisno) {
        $this->db->query(
            "UPDATE `vehicle` 
            SET `TesterId` = :TesterId,
            `vehicle`.PDIStatus = :PDIStatus
            WHERE `vehicle`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':ChassisNo', $chassisno);
        $this->db->bind(':PDIStatus', 'NC');
        $this->db->bind(':TesterId', NULL);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }


    // MARK A TASK AS COMPLETED

    public function completeTask($chassisno) {
        $this->db->query(
            "UPDATE `vehicle` 
            SET `vehicle`.PDIStatus = :PDIStatus
            WHERE `vehicle`.`ChassisNo` = :ChassisNo"
        );

        $this->db->bind(':ChassisNo', $chassisno);
        $this->db->bind(':PDIStatus', 'CM');

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }


    // ---------------------- OTHER ----------------------


    // GET LAST LOGGED IN EMPLOYEES

    public function activityLogs() {

        $this->db->query(
            'SELECT `employee-logs`.`EmployeeId`, `employee-logs`.`LoggedIn` ,CONCAT(`Firstname`," ",`Lastname`) AS `empName`, DATE(`lastLog`) AS `logDate`, TIME(`lastLog`) AS `logTime` 
            FROM `employee-logs`,`employee` 
            WHERE `employee-logs`.`EmployeeId` = `employee`.`EmployeeId` 
            ORDER BY `employee-logs`.`lastLog` DESC LIMIT 6;'
        );

        $lastLogs = $this->db->resultSet();

        if ($lastLogs) {
            return $lastLogs;
        } else {
            return false;
        }
    }


    // GET COMPONENT DETAILS

    public function getComponentStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, component.PartName, component.StageNo, component.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN component
                    ON `stage-vehicle-process`.PartNo = component.PartNo
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND component.StageNo LIKE :stage;'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':status', $status);
        $this->db->bind(':stage', $stage);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

    
    // GETS ASSERMBLY DETAILS

    public function assemblyDetails($chassisNo = "%", $order = 'DESC')
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE (`vehicle`.CurrentStatus IN ("S1","S2","S3","S4","H") OR `vehicle`.CurrentStatus LIKE :status) AND `vehicle`.ChassisNo LIKE :chassisNo
                ORDER BY `vehicle`.ChassisNo '.$order.';'
        );

        $this->db->bind(':chassisNo', '%'.$chassisNo . '%');
        $this->db->bind(':status', '%H');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


    // GETS PROCESS DETAILS

    public function getProcessStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, `stage-process`.ProcessName, `stage-process`.StageNo, `stage-process`.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN `stage-process`
                    ON `stage-vehicle-process`.ProcessId = `stage-process`.ProcessId
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND `stage-process`.StageNo LIKE :stage;'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':status', $status);
        $this->db->bind(':stage', $stage);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }


    // GETS VEHICLE DETAILS FOR ASSEMBLY

    public function onPDIVehicles($parameters = null, $arr = true ) {

        $condition = '';
        $array = [];

        if ( $parameters != null) {
            foreach ($parameters as $key => $value) {
                switch ($key) {
                    case 'ModelName':
                        $condition .= 'AND `vehicle-model`.'.$key.' LIKE :'.$key.' ';
                        break;
                    case 'Tester':
                        $condition .= 'AND CONCAT(`employee`.Firstname," ",`employee`.Lastname) LIKE :'.$key.' ';
                        break;
                    default:
                        $condition .= 'AND `vehicle`.'.$key.' LIKE :'.$key.' ';
                        break;
                }
                $array[] = [ 'key' => ':'.$key, 'parameter' => $value ];
            }
        }

        $this->db->query(
            'SELECT `vehicle`.*, CONCAT(`employee`.Firstname," ",`employee`.Lastname) AS Tester,`vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                INNER JOIN `employee`
                ON `vehicle`.TesterId = `employee`.EmployeeId
                WHERE `vehicle`.CurrentStatus = :status '.$condition.'
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':status', 'PDI');
        foreach ($array as $item) {
            $this->db->bind($item['key'], $item['parameter'].'%');
        }

        if ( $arr ) {
            $results = $this->db->resultSet();
        } else {
            $results = $this->db->single();
        }

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


    // GETS VEHICLE DETAILS BY VEHICLE MODEL

    public function assemblyDetailsByModel($model, $order = 'DESC')
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus IN ("S1","S2","S3","S4","H") AND `vehicle-model`.ModelName LIKE :ModelNo
                ORDER BY `vehicle`.ChassisNo '.$order.';'
        );

        $this->db->bind(':ModelNo', $model . '%');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


    // GETS DISPATCH DETAILS

    public function dispatchDetails($parameters = null) {

        $condition = '';
        $array = [];

        if ( $parameters != null) {
            foreach ($parameters as $key => $value) {
                switch ($key) {
                    case 'ModelName':
                        $condition .= 'AND `vehicle-model`.'.$key.' LIKE :'.$key.' ';
                        break;
                    default:
                        $condition .= 'AND `vehicle`.'.$key.' LIKE :'.$key.' ';
                        break;
                }
                $array[] = [ 'key' => ':'.$key, 'parameter' => $value ];
            }
        }

        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ReleaseDate, `vehicle`.ShowRoomName, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :released '.$condition.'
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':released', 'D');
        foreach ($array as $item) {
            $this->db->bind($item['key'], '%'.$item['parameter'].'%');
        }

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


    // GETS SHELL DETAILS

    public function shellDetail($chassisNo)
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ArrivalDate, `vehicle`.EngineNo, `vehicle`.ModelNo, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.ChassisNo = :chassisNo'
        );

        $this->db->bind(':chassisNo', $chassisNo);

        $results = $this->db->single();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }


}

