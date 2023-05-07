<?php
class Supervisor
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function findUserByUsername($username): bool
    {
        $this->db->query('SELECT * FROM `employee-credentials`  WHERE `employee-credentials`.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function statusCounters()
    {

        $counts = array();

        // CALCULATE THE NUMBER OF VEHICLES IN ASSEMBLY LINE
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS asLine
                FROM `vehicle`
                WHERE `CurrentStatus` LIKE "S%";'
        );
        $counts[] = $this->db->single();


        // CALCULATE THE NUMBER OF VEHICLES DISPATCHED
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS dispatched
                FROM `vehicle`
                WHERE `PDIStatus` = "CM";'
        );
        $counts[] = $this->db->single();

        // CALCULATE THE NUMBER OF VEHICLES IN ON-HOLD STATE
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS onHold
                FROM `vehicle`
                WHERE `CurrentStatus` = "Hold";'
        );
        $counts[] = $this->db->single();

        if ($counts) {
            return $counts;
        } else {
            return false;
        }

    }



    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function checkEmployee($empid): bool
    {

        $this->db->query(
            'SELECT `EmployeeId` FROM `employee` WHERE `EmployeeId` = :employee AND `Progress` = 1;'
        );

        $this->db->bind(':employee', $empid);
        $row = $this->db->single();

        // if ($this->db->rowCount()) {
        if ($row != NULL) {
            return true;
        } else {
            return false;
        }
    
    }

    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function activityLogs()
    {

        $this->db->query(
            'SELECT `employee`.`EmployeeId`, CONCAT(`Firstname`," ",`Lastname`) AS `empName`, DATE(`lastLog`) AS `logDate`, TIME(`lastLog`) AS `logTime`, `logged_in` 
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


    // CHECK THIS EMPLOYEE REQUESTED ANOTHER LEAVE ON THIS DATE
    public function checkLeaves($empid, $reqdate): bool
    {

        $this->db->query(
            'SELECT COUNT(`LeaveId`) AS `LeaveCount` FROM `employee-leaves` WHERE EmployeeId = :employee AND LeaveDate = :req_date;'
        );

        $this->db->bind(':employee', $empid);
        $this->db->bind(':req_date', $reqdate);

        $row = $this->db->single();
        // print_r($row->LeaveCount);

        // if ($this->db->rowCount()) {
        if ($row->LeaveCount > 0) {
            return true;
        } else {
            return false;
        }

    }


    public function getLeaveByID($LeaveID)
    {

        $this->db->query(
            'SELECT * FROM `employee-leaves` WHERE `LeaveId` = :Leave;'
        );

        $this->db->bind(':Leave', $LeaveID);

        $current_leave = $this->db->single();

        if ($current_leave) {
            return $current_leave;
        } else {
            return false;
        }
    }


    public function addleave($EmpId, $leavedate, $reason): bool
    {
        $this->db->query(
            'INSERT INTO `employee-leaves`(EmployeeId, LeaveDate, Reason) 
            VALUES (:empid,:leavedate,:reason);'
        );

        $this->db->bind(':empid', $EmpId);
        $this->db->bind(':leavedate', $leavedate);
        $this->db->bind(':reason', $reason);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function EditLeave($EmpId, $leavedate, $reason, $id): bool
    {
        $this->db->query(
            'UPDATE `employee-leaves`
            SET EmployeeId = :empid, LeaveDate = :leavedate, Reason = :reason
            WHERE LeaveId = :id;'
        );

        $this->db->bind(':empid', $EmpId);
        $this->db->bind(':leavedate', $leavedate);
        $this->db->bind(':reason', $reason);

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // public function removeleave($ID, $leavedate) {
    public function removeleave($LeaveID): bool
    {
        $this->db->query(
            'DELETE FROM `employee-leaves` WHERE LeaveId = :leave_id;'
            // 'DELETE FROM leaves WHERE EmployeeId = :Empid AND LeaveDate = :LDate;'
        );

        $this->db->bind(':leave_id', $LeaveID);
        // $this->db->bind(':Empid', $ID);
        // $this->db->bind(':LDate', $leavedate);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }










    public function addNewTask($chassis_no, $task_name): bool
    {
        $this->db->query(
            'INSERT INTO tasks(ChassisNo, taskName) 
            VALUES (:chassis_number, :task)'
        );

        $this->db->bind(':chassis_number', $chassis_no);
        $this->db->bind(':task', $task_name);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function viewPAQresults($ChassisNo)
    {
        $this->db->query(
            'SELECT car.ChassisNo, car.EngineNo, car.VehicleModel, paqresult.BrakeBleeding,
                    paqresult.GearOilLevel, paqresult.RackEnd, paqresult.Clutch,
                    paqresult.RearAxelPlate, paqresult.Visual, paqresult.date, paqresult.Supervisor1
            FROM paqresult
            INNER JOIN car
            ON paqresult.ChassisNo = car.ChassisNo
            WHERE paqresult.ChassisNo = :chassisno'
        );

        $this->db->bind(':chassisno', $ChassisNo);

        $results = $this->db->single();

        if ($results) {
            return $results;
        } else {
            return false;
        }
    }


    public function ViewLeaves()
    {

        $this->db->query(
            'SELECT `employee-leaves`.`LeaveId`, `employee-leaves`.`EmployeeId`, CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Name`, `employee-leaves`.`LeaveDate`, `employee-leaves`.`Reason`
                FROM `employee-leaves`
                INNER JOIN `employee`
            ON `employee-leaves`.`EmployeeId` = `employee`.`EmployeeId`
            -- WHERE LeaveDate > GETDATE()
            ORDER BY `LeaveDate` ASC;'
        );

        $leaves = $this->db->resultSet();
        // print_r($leaves);

        if ($leaves) {
            return $leaves;
        } else {
            return false;
        }
    }


    public function userDetails($id) {
        $this->db->query(
            'SELECT *
                FROM `employee`
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

    
    public function ViewAllConsumables()
    {

        $this->db->query(
//            'SELECT * FROM `consumable`;'
            'SELECT `ConsumableId`, `ConsumableName`, 
                        `Volume`, `Weight`, 
                        DATE(`LastUpdate`) AS `UDate`,
                        TIME(`LastUpdate`) AS `UTime`, 
                        `LastUpdateBy`, `Image` FROM `consumable`;'

        );

        $consumables = $this->db->resultSet();

        if ($consumables) {
            return $consumables;
        } else {
            return false;
        }
    }

    public function ViewAllTools()
    {

        $this->db->query(
            'SELECT * FROM `tool`;'
        );

        $tools = $this->db->resultSet();

        if ($tools) {
            return $tools;
        } else {
            return false;
        }
    }


    public function ViewS4Finishers()
    {

        $this->db->query(
            'SELECT `ChassisNo` FROM `vehicle`;'
        );

        $S4FVehicles = $this->db->resultSet();

        if ($S4FVehicles != NULL) {
            return $S4FVehicles;
        } else {
            return false;
        }
    }




    public function ViewTaskSchedule()
    {

        $this->db->query(
            'SELECT `employee-schedule`.`ChassisNo`, 
                        `employee-schedule`.`Completeness`, 
                        `employee-schedule`.`ProcessId`, 
                        `employee-schedule`.`Date`,
                        CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Worker`, 
                        `stage-process`.`ProcessName`
                FROM `employee-schedule`, `employee`, `stage-process`
                WHERE `employee-schedule`.`ProcessId` = `stage-process`.`ProcessId` AND 
                        `employee-schedule`.`EmployeeId` = `employee`.`EmployeeId` AND 
                        (`employee-schedule`.`Date` < CURRENT_DATE() OR `employee-schedule`.`Completeness` = "0");'
        );

        $tasks = $this->db->resultSet();

        if ($tasks) {
            return $tasks;
        } else {
            return false;
        }
    }


    public function ViewReturnDefectSheet()
    {

        $this->db->query(
            'SELECT *
                FROM tasks 
                where EmployeeId != NULL; '
        );

        $tasks = $this->db->resultSet();

        if ($tasks) {
            return $tasks;
        } else {
            return false;
        }
    }


    public function updateToolStatus($toolId, $newStatus): bool
    {
        $this->db->query(
            'UPDATE `tool` SET `Status` = :tool_status 
            WHERE `ToolId` = :tool_id;'
        );

        $this->db->bind(':tool_id', $toolId);
        $this->db->bind(':tool_status', $newStatus);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // THIS IS NOT THE WORKING FUNCTION
    public function ViewTools()
    {

        $this->db->query(
            'SELECT *
                FROM toolset;'
        );

        $tools = $this->db->resultSet();

        if ($tools) {
            return $tools;
        } else {
            return false;
        }
    }


    public function viewAssemblyLineVehicles()
    {

        $this->db->query(
            'SELECT `ChassisNo`,
                    `ModelNo`,
                    `Color`, 
                    `CurrentStatus`
                    FROM `vehicle` 
                    WHERE `CurrentStatus` LIKE "S_%";'
        );

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }


    public function recordPAQresults($ChassisNo, $BrakeBleeding, $GearOilLevel, $Adjustment, $Clutch, $RAP, $Visual, $Final) {



        for ($record = 1; $record <= 7; $record++) {

            // Insert the value
            $this->db->query(

                'UPDATE `operation-vehicle` 
                SET `Status` = :VAL'. $record .',
                `SupervisorId` = :supervisor,
                `Date` = CURRENT_TIMESTAMP 
                WHERE `ChassisNo` = :chassisNo AND `OpId` = :ID' . $record . ';'

            );
        
            // Bind the parameters
            $this->db->bind(':ID' . $record, 'OPT000'.$record);
        
            // Execute the query
            $this->db->execute();
        }

        $this->db->bind(':chassisNo', $ChassisNo);
        $this->db->bind(':VAL1', $BrakeBleeding);
        $this->db->bind(':VAL2', $GearOilLevel);
        $this->db->bind(':VAL3', $Adjustment);
        $this->db->bind(':VAL4', $Clutch);
        $this->db->bind(':VAL5', $RAP);
        $this->db->bind(':VAL6', $Visual);
        $this->db->bind(':VAL7', $Final);
        $this->db->bind(':supervisor', $_SESSION['_name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }



    public function viewDamagedParts()
    {
        $this->db->query(
            'SELECT `component-damage`.`SerialNo`, 
                    `component-damage`.`RequestStatus`, 
                    `component`.`Color`, 
                    `component`.`PartName` 
                    FROM `component-damage`, `component` 
                    ORDER BY `component-damage`.`RequestStatus` 
                    ASC LIMIT 5;'
        );

        $damaged_parts = $this->db->resultSet();

        if($damaged_parts) {
            return $damaged_parts;
        } else {
            return FALSE;
        }
    }

    public function viewCarComponents($car) {
        $this->db->query(
            'SELECT `component`.`PartNo`, `component`.`PartName`, `component-release`.`CurrentStatus`
                    FROM `component-release`, `component` 
                    WHERE `component-release`.`PartNo` = `component`.`PartNo` 
                    AND `component-release`.`ChassisNo` = :THIS_CAR;'
        );

        $this->db->bind(':THIS_CAR', $car);

        $parts = $this->db->resultSet();

        if ($parts) {
            return $parts;
        } else {
            return false;
        }
    }
    
    public function viewVehicleList($stage)
    {

        $this->db->query(
            'SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle`.`Color`, 
                        `vehicle-model`.`ModelName` 
                    FROM `vehicle`, `vehicle-model` 
                    WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo` AND `vehicle`.`CurrentStatus` = :STAGE;'
        );

        $this->db->bind(':STAGE', $stage);

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }


    public function ViewPDIresults()
    {

        $this->db->query(
            'SELECT *
                FROM vehicles; ' //pdi results table
        );

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }


    public function viewProfile($user)
    {

        $this->db->query(
                'SELECT * 
                FROM employee
                WHERE EmployeeId = :id;'
        );

        $this->db->bind(':id', $user);
        $userdata = $this->db->single();

        if ($userdata) {
            return $userdata;
        } else {
            return false;
        }
    }


    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function checkToolById($tool_id): bool
    {

        $this->db->query(
            'SELECT `ToolId` FROM `tool` WHERE `ToolId` = :singletool;'
        );

        $this->db->bind(':singletool', $tool_id);

        $row = $this->db->single();

        if ($row != NULL) {
            return true;
        } else {
            return false;
        }
    
    }


    public function createPAQForm($car_id)
    {
        $this->db->query(
            'SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle-model`.`ModelName` 
                        FROM `vehicle`, `vehicle-model` 
                        WHERE `ChassisNo` = :car AND `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo`;'
        );
        $this->db->bind(':car', $car_id);
        $car_data = $this->db->single();

        if ($car_data != NULL) {
            return $car_data ;
        } else {
            return false;
        }
    }

    public function checkCarById($car_id, $state): bool
    {

        $this->db->query(
            'SELECT `ChassisNo` FROM `vehicle` WHERE `ChassisNo` = :car AND `CurrentStatus` = :cstate;'
        );

        $this->db->bind(':car', $car_id);
        $this->db->bind(':cstate', $state);
        $row = $this->db->single();

        if ($row != NULL) {
            return true;
        } else {
            return false;
        }

    }


    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function checkConsumeById($consume_id): bool
    {

        $this->db->query(
            'SELECT `ConsumableId` FROM `consumable` WHERE `ConsumableId` = :consumable;'
        );

        $this->db->bind(':consumable', $consume_id);
        $row = $this->db->single();

        // if ($this->db->rowCount()) {
        if ($row != NULL) {
            return true;
        } else {
            return false;
        }
    
    }


    public function updateConsumableQuantity($consume_id, $quantity, $con_type): bool
    {
        if($con_type == "Liters") {
            $this->db->query(
                'UPDATE `consumable` SET `Volume` = :quantity, `LastUpdate` = CURRENT_TIMESTAMP
                WHERE `ConsumableId` = :consume;'
            );
        } else {
            $this->db->query(
                'UPDATE `consumable` SET `Weight` = :quantity, `LastUpdate` = CURRENT_TIMESTAMP
                WHERE `ConsumableId` = :consume;'
            );
        }
        

        $this->db->bind(':consume', $consume_id);
        $this->db->bind(':quantity', $quantity);

        // print_r($con_type);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }







    


    public function onPDIVehicles() {

        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName, `vehicle`.EngineNo 
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
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

















    public function getProcessData($chassisNo = null, $stage = null) {
        
        $this->db->query(
            'SELECT `stage-process`.`ProcessId`, `stage-process`.`ProcessName`, 
                    `stage-vehicle-process`.`Status`, `stage-vehicle-process`.`ChassisNo`, 
                    `stage-process`.`Weight` 
                    FROM `stage-vehicle-process` 
                    INNER JOIN `stage-process` 
                    ON `stage-vehicle-process`.ProcessId = `stage-process`.ProcessId 
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo 
                    AND `stage-process`.`StageNo` LIKE :stage;'
        );

        if($stage == 'S1') {
            $stage = '001';
        } else if($stage == 'S2') {
            $stage = '002';
        } else if($stage == 'S3') {
            $stage = '003';
        } else if($stage == 'S4') {
            $stage = '004';
        }

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':stage', $stage);

        $processData = $this->db->resultSet();

        if ( $processData ) {
            return $processData;
        } else {
            return [];
        }
    }



















    public function viewCarList($Stages = null) {
        if (isset($Stages)) {

            if (empty($Stages)) {
                return [];
            }


            $quotedStages = implode(',', array_map(function($stage) {
                return "'" . addslashes($stage) . "'";
            }, $Stages));
    
            // $modelNamesString = implode(',', $vehicleType);
            $sql = "SELECT `ChassisNo` FROM `vehicle` WHERE `CurrentStatus` IN ($quotedStages)";
            $this->db->query($sql);

            $Cars = $this->db->resultSet();

            // print_r($Cars);

        }

        if ($Cars) {
            return $Cars;
        } else {
            return [];
        }

    }



    public function viewCars($vehicleType = null, $completeness = null, $acceptance = null)
    {
        $sql = 'SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle`.`Color`, 
                        `vehicle-model`.`ModelName` 
                        FROM `vehicle`, `vehicle-model` 
                        WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo`';


        if (isset($vehicleType)) {

            if (empty($vehicleType)) {
                // No valid model names selected, return an empty result set
                return false;
            }


            $quotedVehicles = implode(',', array_map(function($vehicle) {
                return "'" . addslashes($vehicle) . "'";
            }, $vehicleType));
    
            $sql .= " AND `vehicle`.`ModelNo` IN ($quotedVehicles)";
        }

        if (isset($completeness)) {
            if ($completeness != 'All') {
                $sql .= ' AND `vehicle`.`PDIStatus` LIKE :completeness';
            }
        }

        if ($acceptance) {
            if ($acceptance == 'Not accepted') {
                $sql .= ' AND `vehicle`.`CurrentStatus` IN ("S1", "S2", "S3", "S4")';
            } elseif ($acceptance == 'Accepted') {
                $sql .= ' AND `vehicle`.`CurrentStatus` IN ("PA", "CM")';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $this->db->bind(':completeness', $completeness);

        $vehicles = $this->db->resultSet();


        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }


    public function viewToolz($toolType = null, $toolStatus = null)
    {
        $sql = 'SELECT `ToolId`, `ToolName`, 
                    `Status`, `ToolType`, `quantity`, 
                    DATE(`LastUpdate`) AS `UDate`, 
                    TIME(`LastUpdate`) AS `UTime`, 
                    `LastUpdateBy`, `Image` 
                    FROM `tool` 
                    WHERE `ToolId` IS NOT NULL';


        if (isset($toolType)) {
            if ($toolType != 'All') {
                $sql .= ' AND `ToolType` = :toolType';
            }
        }

        if (isset($toolStatus)) {
            if ($toolStatus == 'Normal') {
                $sql .= ' AND `Status` = "Normal"';
            } elseif ($toolStatus == 'NA') {
                $sql .= ' AND `Status` = "Need an attention"';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $this->db->bind(':toolType', $toolType);

        $tools = $this->db->resultSet();


        if ($tools) {
            return $tools;
        } else {
            return false;
        }
    }


    public function viewConsumables($consumeType = null, $cstatus = null)
    {
        $sql = 'SELECT `ConsumableId`, `ConsumableName`, 
                    `Volume`, `Weight`, 
                    DATE(`LastUpdate`) AS `UDate`,
                    TIME(`LastUpdate`) AS `UTime`, 
                    `LastUpdateBy`, `Image` 
                    FROM `consumable`
                    WHERE `ConsumableId` IS NOT NULL';


        if (isset($consumeType)) {
            if ($consumeType == 'Lubricants') {
                $sql .= ' AND `Volume` IS NOT NULL';
            } elseif ($consumeType == 'Grease') {
                $sql .= ' AND `Weight` IS NOT NULL';
            }
        }

        if (isset($cstatus)) {
            if ($cstatus == 'Available') {
                $sql .= ' AND (`Volume` >= 60 OR `Weight` >= 60)';
            } elseif ($cstatus == 'Low') {
                $sql .= ' AND (`Volume` < 60 OR `Weight` < 60)';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $consumables = $this->db->resultSet();


        if ($consumables) {
            return $consumables;
        } else {
            return false;
        }
    }


}