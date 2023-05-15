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
                WHERE `CurrentStatus` = "D";'
        );
        $counts[] = $this->db->single();

        // CALCULATE THE NUMBER OF VEHICLES IN ON-HOLD STATE
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS onHold
                FROM `vehicle`
                WHERE `CurrentStatus` = "H";'
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

        if ($row != null) {
            return true;
        } else {
            return false;
        }
    
    }

    // PROVIDE THE CURRENT ACTIVITY LOGS
    public function activityLogs()
    {

        $this->db->query(
            'SELECT `employee`.`EmployeeId`, CONCAT(`Firstname`," ",`Lastname`) AS `empName`, DATE(`lastLog`) AS `logDate`, TIME(`lastLog`) AS `logTime`, `LoggedIn` 
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









    // SETTINGS PAGE FUNCTIONS //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateProfileValues($id, $firstname, $lastname, $email, $mobile, $nic) {
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









    // VIEW LEAVES //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ViewLeaves()
    {

        $this->db->query(
            'SELECT `employee-leaves`.`LeaveId`, `employee-leaves`.`EmployeeId`, CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Name`, `employee-leaves`.`LeaveDate`, `employee-leaves`.`Reason`
                FROM `employee-leaves`
                INNER JOIN `employee`
            ON `employee-leaves`.`EmployeeId` = `employee`.`EmployeeId`
            -- WHERE LeaveDate > CURDATE() 
            ORDER BY `LeaveDate` ASC;'
        );

        $leaves = $this->db->resultSet();

        if ($leaves) {
            return $leaves;
        } else {
            return false;
        }
    }

    // CHECK THIS EMPLOYEE REQUESTED ANOTHER LEAVE ON THIS DATE
    public function checkLeaves($empid, $reqdate): bool
    {

        $this->db->query(
            'SELECT `LeaveId` FROM `employee-leaves` WHERE `EmployeeId` = :employee AND `LeaveDate` = :req_date;'
        );

        $this->db->bind(':employee', $empid);
        $this->db->bind(':req_date', $reqdate);

        $rows = $this->db->resultSet();

        if($rows != null) {
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
        );

        $this->db->bind(':leave_id', $LeaveID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }












    public function viewPAQresults($ChassisNo)
    {
        $this->db->query(
            'SELECT `vehicle`.`ChassisNo`, `vehicle`.`EngineNo`, `vehicle`.VehicleModel, `operation`.BrakeBleeding,
                    `operation`.GearOilLevel, `operation`.RackEnd, `operation`.Clutch,
                    `operation`.RearAxelPlate, `operation`.Visual, `operation`.`date`, `operation`.Supervisor1
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

    public function recordPAQresults($ChassisNo, $BrakeBleeding, $GearOilLevel, $Adjustment, $Clutch, $RAP, $Visual, $Final, $Supervisor)
    {

        $this->db->query(
            'INSERT INTO `operation` VALUES (:chassisNo, DEFAULT, :VAL1, :VAL2, :VAL3, :VAL4, :VAL5, :VAL6, :VAL7, :supervisor, CURDATE());'
        );

        $this->db->bind(':chassisNo', $ChassisNo);
        $this->db->bind(':VAL1', $BrakeBleeding);
        $this->db->bind(':VAL2', $GearOilLevel);
        $this->db->bind(':VAL3', $Adjustment);
        $this->db->bind(':VAL4', $Clutch);
        $this->db->bind(':VAL5', $RAP);
        $this->db->bind(':VAL6', $Visual);
        $this->db->bind(':VAL7', $Final);
        $this->db->bind(':supervisor', $Supervisor);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function recordPAQresultsUpdate($ChassisNo, $BrakeBleeding, $GearOilLevel, $Adjustment, $Clutch, $RAP, $Visual, $Final, $Supervisor)
    {

        $this->db->query(
            'UPDATE `operation` 
                SET `Attempt` = `Attempt` + 1, `BrakeBleed` = :VAL1, `GearOil` = :VAL2, `RackEnd` = :VAL3, `Clutch` = :VAL4, `AxelPlate` = :VAL5, `Visual` = :VAL6, `Final` = :VAL7, `SupervisorId` = :supervisor, `Date` = CURDATE() 
                WHERE `ChassisNo` = :chassisNo;'
        );

        $this->db->bind(':chassisNo', $ChassisNo);
        $this->db->bind(':VAL1', $BrakeBleeding);
        $this->db->bind(':VAL2', $GearOilLevel);
        $this->db->bind(':VAL3', $Adjustment);
        $this->db->bind(':VAL4', $Clutch);
        $this->db->bind(':VAL5', $RAP);
        $this->db->bind(':VAL6', $Visual);
        $this->db->bind(':VAL7', $Final);
        $this->db->bind(':supervisor', $Supervisor);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function getPDIChecklist() {
        $this->db->query(
            'SELECT `CheckId` FROM `pdi-check`;'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function sendtoRR($id, $checkid) {

        $this->db->query( 'INSERT INTO `pdi-result` VALUES (:id, :checkid, DEFAULT);');

        $this->db->bind(':id', $id);
        $this->db->bind(':checkid', $checkid);

        $this->db->execute();
    }












// TASK SCHEDULING PROCESS /////////////////////////////////////////////////////////////////////////////////////////////////////

    public function findProcessByName($process_name, $car)
    {
        $this->db->query(
            'SELECT `stage-process`.`ProcessId`, 
                        `stage-process`.`ProcessName`
                FROM `vehicle`, `stage-process`
                WHERE `stage-process`.`ModelNo` = `vehicle`.`ModelNo` AND 
                        `vehicle`.`ChassisNo` = :car AND 
                        `stage-process`.`ProcessName` LIKE :process
                        ;'
        );

        $this->db->bind(':process', '%'.$process_name.'%');
        $this->db->bind(':car', $car);

        $taskset = $this->db->resultSet();

        if ($taskset) {
            return $taskset;
        } else {
            return false;
        }
    }

    public function assemblerForProcess($chassisNo, $processId) {

        $this->db->query(
            'SELECT `employee`.`EmployeeId`, CONCAT(`employee`.firstname," ",`employee`.lastname) AS Name
            FROM `employee`
            WHERE EmployeeId NOT IN (SELECT EmployeeId FROM `employee-leaves` WHERE LeaveDate = :leavedate AND Progress = 1)
            AND EmployeeId NOT IN (SELECT EmployeeId FROM `employee-schedule` WHERE (ChassisNo = :chassisNo AND ProcessId = :processId))
            AND `employee`.Position = :position;'
        );

        //bind next day to leave date
        $nextDay = strtotime('+1 day');
        $this->db->bind(':leavedate', date('Y-m-d', $nextDay));
        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':processId', $processId);
        $this->db->bind(':position', 'Assembler');


        $result = $this->db->resultSet();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


    public function addNewTask($chassisNo, $processID, $assembler): bool {
        $this->db->query(
            'INSERT INTO `employee-schedule` VALUES (:chassisNo,:processId,:assmbler,:date,DEFAULT);'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':processId', $processID);
        $this->db->bind(':assmbler', $assembler);
        $nextDay = strtotime('+1 day');
        $this->db->bind(':date', date('Y-m-d', $nextDay));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // THIS WILL GIVE THE TASKS IN EMPLOYEE SCHEDULE TABLE
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
                        (`employee-schedule`.`Date` >= CURRENT_DATE() OR `employee-schedule`.`Completeness` = "0");'
        );

        $tasks = $this->db->resultSet();

        if ($tasks) {
            return $tasks;
        } else {
            return false;
        }
    }


    // THIS FUNCTION WILL UPDATE THE DATABASE WHEN USER MARKS AS THE TASK IS COMPLETED OR NOT (REALTIME)
    public function recordTaskStatus($car_id, $process_id, $status): bool {
        $this->db->query(
            'UPDATE `employee-schedule`
            SET `Completeness` = :CStatus 
            WHERE `ChassisNo` = :Car AND `ProcessId` = :Process'
        );

        $this->db->bind(':Car', $car_id);
        $this->db->bind(':Process', $process_id);
        $this->db->bind(':CStatus', $status);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // CHECK THIS REQUESTED TASK IS AVAILABLE?
    public function checkTaskById($car_id, $process_id): bool
    {

        $this->db->query(
            'SELECT `ChassisNo` FROM `employee-schedule` WHERE `ChassisNo` = :car AND `ProcessId` = :process;'
        );

        $this->db->bind(':car', $car_id);
        $this->db->bind(':process', $process_id);

        $row = $this->db->resultSet();

        if (isset($row)) {
            return true;
        } else {
            return false;
        }

    }


    // REMOVING TASK BY USING CAR ID AND PROCESS ID
    public function removeTask($car_id, $process_id): bool
    {

        $this->db->query(
            'DELETE FROM `employee-schedule` WHERE `ChassisNo` = :car AND `ProcessId` = :process;'
        );

        $this->db->bind(':car', $car_id);
        $this->db->bind(':process', $process_id);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }













    // ASSEMBLY LINE VEHICLES
    public function viewAssemblyLineVehicles()
    {

        $this->db->query(
            'SELECT `ChassisNo`,
                    `ModelNo`,
                    `Color`, 
                    `CurrentStatus`
                    FROM `vehicle` 
                    WHERE `CurrentStatus` IN ("S1", "S2", "S3", "S4", "H");'
        );

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }











    public function viewDamages() // UNDEFINED
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









    public function viewDamagedParts()
    {
        $this->db->query(
            'SELECT `component-damage`.`SerialNo`,
                    `component-damage`.`RequestStatus`,
                    `component`.`Color`,
                    `component`.`PartName`
            FROM `component-damage` INNER JOIN `component`
            ON `component-damage`.`PartNo` = `component`.`PartNo`
            ORDER BY `component-damage`.`RequestStatus` ASC
            LIMIT 5;'
        );

        $damaged_parts = $this->db->resultSet();

        if($damaged_parts) {
            return $damaged_parts;
        } else {
            return false;
        }
    }





    public function viewCarComponents($car)
    {
        $this->db->query(
            'SELECT `component`.`PartNo`, `component`.`PartName`, `component-release`.`Status`
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








    public function retrievePAQdata($car_id)
    {
        $this->db->query(
            'SELECT `operation`.* , 
                        `vehicle`.`EngineNo`, 
                        `vehicle-model`.`ModelName` 
                        FROM `vehicle`, `vehicle-model`, `operation`
                        WHERE `vehicle`.`ChassisNo` = :car 
                        AND `operation`.`ChassisNo` = `vehicle`.`ChassisNo` 
                        AND `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo`;'
        );

        $this->db->bind(':car', $car_id);

        $test_data = $this->db->single();

        if ($test_data != NULL) {
            return $test_data ;
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
            'SELECT `pdi-check-category`.*,
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

    // Retrieve Query : PDI Checks
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
            return false;
        }
    }

    public function pdiVehicle($id){
        $this->db->query('SELECT ChassisNo, EngineNo FROM `vehicle` WHERE `vehicle`.`ChassisNo` = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if ( $result ) {
            return $result;
        } else {
            return false;
        }
    }
















    // THIS FUNCTION PROVIDES THE PROCESSES FOR THE VEHICLES AT THE EACH STAGE
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


        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':stage', $stage);

        $processData = $this->db->resultSet();

        if ( $processData ) {
            return $processData;
        } else {
            return false;
        }
    }

    // UPDATE ONE BY ONE PROCESS IN A VEHICLE
    public function updateProgress($vehicleID, $proID, $status) {

        $this->db->query(
            'UPDATE `stage-vehicle-process` SET `Status` = :pstatus
                    WHERE `ChassisNo` = :chassisNo 
                    AND `ProcessId` = :processid;'
        );

        $this->db->bind(':chassisNo', $vehicleID);
        $this->db->bind(':processid', $proID);
        $this->db->bind(':pstatus', $status);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // THIS IS THE FUNCTION USED FOR CHANGE THE CURRENT STATUS OF A VEHICLE
    public function stageChanger($vehicleID, $new_stage) {

        $this->db->query(
            'UPDATE `vehicle` SET `CurrentStatus` = :newStage
                    WHERE `ChassisNo` = :chassisNo;'
        );

        $this->db->bind(':chassisNo', $vehicleID);
        $this->db->bind(':newStage', $new_stage);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    
    }

    // THIS IS THE FUNCTION USED FOR CHECK THE CAR HAS HOLDING PROCESSES
    public function checkHoldingCars($vehicleID) {

        $this->db->query(
            'SELECT COUNT(`Status`) AS `holdCounter` FROM `stage-vehicle-process` 
                    WHERE `ChassisNo` = :chassisNo AND `Status` = :status;'
        );

        $this->db->bind(':chassisNo', $vehicleID);
        $this->db->bind(':status', 'OnHold');

        $count = $this->db->single();

        if ($count != null) {
            return $count;
        } else {
            return false;
        }
    }

    public function stageOfThisProcess($process)
    {

        $this->db->query(
            'SELECT `StageNo` FROM `stage-process` WHERE `ProcessId` = :process;'
        );

        $this->db->bind(':process', $process);

        $stage = $this->db->single();

        if ($stage != null) {
            return $stage;
        } else {
            return false;
        }
    }

    // COMPONENTS STATUS UPDATING FUNCTION
    public function recordComponentDetails($car_id, $part_id, $status)
    {
        $this->db->query(
            'UPDATE `component-release` SET `Status` = :cstatus WHERE `ChassisNo` = :chassisNo AND `PartNo` = :part;'
        );

        $this->db->bind(':chassisNo', $car_id);
        $this->db->bind(':part', $part_id);
        $this->db->bind(':cstatus', $status);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    















    // THIS FUNCTION IS USED TO GET THE CAR'S CHASSIS NUMBERS FOR SELECT OPTIONS BY PASSING CURRENT STAGE OR STATUS
    public function viewCarList($Stages = null)
    {
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

        }

        if ($Cars) {
            return $Cars;
        } else {
            return [];
        }

    }


    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING VEHICLES IN PAQ
    public function viewCars($vehicleType = null, $completeness = null)
    {
        $sql = 'SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle`.`CurrentStatus`, 
                        `vehicle`.`Color`, 
                        `vehicle-model`.`ModelName` 
                        FROM `vehicle`, `vehicle-model` 
                        WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo`';


        if (isset($vehicleType)) {

            if (empty($vehicleType)) {
                // NO VALID MODEL NAMES SELECTED, RETURN AN EMPTY RESULT SET
                return false;
            }


            $quotedVehicles = implode(',', array_map(function($vehicle) {
                return "'" . addslashes($vehicle) . "'";
            }, $vehicleType));
    
            $sql .= " AND `vehicle`.`ModelNo` IN ($quotedVehicles)";
        }

        if ($completeness == "PA") {
            $sql .= ' AND `vehicle`.`CurrentStatus` = "PA"';
        } else if ($completeness == "AC") {
            $sql .= ' AND `vehicle`.`CurrentStatus` = "AC"';
        } else {
            $sql .= ' AND `vehicle`.`CurrentStatus` IN ("AC", "PA")';
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);


        $vehicles = $this->db->resultSet();


        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }

    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING VEHICLES IN PDI
    public function viewPDICars($vehicleType = null, $cmstate = null)
    {
        $sql = 'SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle`.`CurrentStatus`, 
                        `vehicle`.`Color`, 
                        `vehicle-model`.`ModelName` 
                        FROM `vehicle`, `vehicle-model` 
                        WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo` 
                        AND `vehicle`.`CurrentStatus` = "RR"';


        if (isset($vehicleType)) {

            if (empty($vehicleType)) {
                // NO VALID MODEL NAMES SELECTED, RETURN AN EMPTY RESULT SET
                return false;
            }

            $quotedVehicles = implode(',', array_map(function($vehicle) {
                return "'" . addslashes($vehicle) . "'";
            }, $vehicleType));
    
            $sql .= " AND `vehicle`.`ModelNo` IN ($quotedVehicles)";
        }


        if (isset($cmstate)) {

            if (empty($cmstate)) {
                // NO VALID MODEL NAMES SELECTED, RETURN AN EMPTY RESULT SET
                return false;
            }

            $pdistates = implode(',', array_map(function($state) {
                return "'" . addslashes($state) . "'";
            }, $cmstate));
    
            // $sql .= " AND `vehicle`.`PDIStatus` IN ($pdistates)";
            $sql .= "";
        }


        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);


        $vehicles = $this->db->resultSet();


        if ($vehicles) {
            return $vehicles;
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


    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING TOOLS IN CARD VIEWS

    public function addTool($name, $type, $status, $quantity, $image) {

        $this->db->query(
            'INSERT INTO `tool`(`ToolName`, `Status`, `LastUpdate`, `LastUpdateBy`, `Image`, `quantity`, `ToolType`) 
                    VALUES (:name,:status,CURRENT_TIMESTAMP,:by,:image, :quantity, :type);'
        );

        $this->db->bind(':name', ucwords($name));
        $this->db->bind(':status', $status);
        $this->db->bind(':by', $_SESSION['_id']);
        $this->db->bind(':image', $image);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':type', $type);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function viewToolz($toolType = null, $toolStatus = null)
    {
        $sql = 'SELECT `tool`.`ToolId`, 
                `tool`.`ToolName`, 
                `tool`.`Status`, 
                `tool`.`ToolType`, 
                `tool`.`quantity`, 
                DATE(`tool`.`LastUpdate`) AS `UDate`,
                TIME(`tool`.`LastUpdate`) AS `UTime`, 
                `tool`.`Image`, 
                CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Updater` 
                FROM `tool`, `employee`
                WHERE `tool`.`LastUpdateBy` = `employee`.`EmployeeId`';


        if ($toolType != null) {
            if ($toolType != 'All') {
                $sql .= ' AND `tool`.`ToolType` = :toolType';
            }
        }

        if ($toolStatus != null) {
            if ($toolStatus == 'Normal') {
                $sql .= ' AND `tool`.`Status` = "Normal"';
            } elseif ($toolStatus == 'NA') {
                $sql .= ' AND `tool`.`Status` = "Need an attention"';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        if ($toolType != null) {
            if ($toolType != 'All') {
                $this->db->bind(':toolType', $toolType);
            }
        }

        $tools = $this->db->resultSet();


        if ($tools) {
            return $tools;
        } else {
            return false;
        }
    }


    public function updateToolStatus($toolId, $newStatus): bool
    {
        $this->db->query(
            'UPDATE `tool` SET `Status` = :tool_status, 
                                    `LastUpdateBy` = :user_id 
            WHERE `ToolId` = :tool_id;'
        );

        $this->db->bind(':tool_id', $toolId);
        $this->db->bind(':tool_status', $newStatus);
        $this->db->bind(':user_id', $_SESSION['_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // CHECK THIS TOOL IS CURRENT IN OPARATION
    public function checkToolById($tool_id): bool
    {

        $this->db->query(
            'SELECT `ToolId` FROM `tool` WHERE `ToolId` = :singletool;'
        );

        $this->db->bind(':singletool', $tool_id);

        $row = $this->db->single();

        if ($row != null) {
            return true;
        } else {
            return false;
        }
    
    }

    // ADDING NEW TOOL
    public function addNewTool($name, $type, $status, $quantity, $image) {


        $this->db->query(
            'INSERT INTO `tool`(`ToolName`, `Status`, `LastUpdate`, `LastUpdateBy`, `quantity`, `ToolType`, `Image`) 
                    VALUES (:name, :status, CURRENT_TIMESTAMP, :by, :quantity, :tooltype, :image);'
        );


        // $this->db->bind(':id', str_replace(" ", "", $name));
        $this->db->bind(':name', $name);
        $this->db->bind(':status', $status);
        $this->db->bind(':by', $_SESSION['_id']);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':tooltype', $type);
        $this->db->bind(':image', $image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }









    public function updateStage($chassisNo, $stage)
    {

        $this->db->query(
            'UPDATE `vehicle` SET `CurrentStatus` = :stage WHERE `ChassisNo` = :chassisNo;'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':stage', $stage);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }
















    // public function ViewAllConsumables()
    // {

    //     $this->db->query(
    //         'SELECT `consumable`.`ConsumableId`, 
    //                 `consumable`.`ConsumableName`, 
    //                 `consumable`.`Volume`, 
    //                 `consumable`.`Weight`, 
    //                 DATE(`consumable`.`LastUpdate`) AS `UDate`,
    //                 TIME(`consumable`.`LastUpdate`) AS `UTime`, 
    //                 `consumable`.`Image`, 
    //                 CONCAT(`employee`.`Firstname`," ",`employee`.`Lastname`) AS `Updater`, 
    //         FROM `consumable`, `employee`
    //         WHERE `consumable`.`LastUpdateBy` = `employee`.`EmployeeId`;'

    //     );

    //     $consumables = $this->db->resultSet();

    //     if ($consumables) {
    //         return $consumables;
    //     } else {
    //         return false;
    //     }
    // }


    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING CONSUMABLES IN CARD VIEWS
    public function viewConsumables($consumeType = null, $cstatus = null)
    {
        $sql = 'SELECT `consumable`.`ConsumableId`, 
                    `consumable`.`ConsumableName`, 
                    `consumable`.`Volume`, 
                    `consumable`.`Weight`, 
                    DATE(`consumable`.`LastUpdate`) AS `UDate`,
                    TIME(`consumable`.`LastUpdate`) AS `UTime`, 
                    `consumable`.`Image`, 
                    CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Updater`
                FROM `consumable`, `employee`
                WHERE `consumable`.`LastUpdateBy` = `employee`.`EmployeeId`';


        if (isset($consumeType)) {
            if ($consumeType == 'Lubricants') {
                $sql .= ' AND `consumable`.`Volume` IS NOT NULL';
            } elseif ($consumeType == 'Grease') {
                $sql .= ' AND `consumable`.`Weight` IS NOT NULL';
            }
        }

        if (isset($cstatus)) {
            if ($cstatus == 'Available') {
                $sql .= ' AND (`consumable`.`Volume` >= 60 OR `consumable`.`Weight` >= 60)';
            } elseif ($cstatus == 'Low') {
                $sql .= ' AND (`consumable`.`Volume` < 60 OR `consumable`.`Weight` < 60)';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $consumables = $this->db->resultSet();

        // print_r($consumables);

        if ($consumables) {
            return $consumables;
        } else {
            return false;
        }
    }

    public function updateConsumableQuantity($consume_id, $quantity, $consume_type, $user): bool
    {
        if($consume_type == "Liters") {
            $this->db->query(
                'UPDATE `consumable` SET `Volume` = :quantity, 
                        `LastUpdate` = CURRENT_TIMESTAMP, 
                        `LastUpdateBy` = :user 
                WHERE `ConsumableId` = :consume;'
            );
        } else {
            $this->db->query(
                'UPDATE `consumable` SET `Weight` = :quantity, 
                        `LastUpdate` = CURRENT_TIMESTAMP, 
                        `LastUpdateBy` = :user 
                WHERE `ConsumableId` = :consume;'
            );
        }
        

        $this->db->bind(':consume', $consume_id);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':user', $user);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // CHECK THIS CONSUMABLE USING IN FACTORY
    public function checkConsumeById($consume_id): bool
    {
        $this->db->query(
            'SELECT `ConsumableId` FROM `consumable` WHERE `ConsumableId` = :consumable;'
        );

        $this->db->bind(':consumable', $consume_id);

        $row = $this->db->resultSet();

        if ($row != NULL) {
            return true;
        } else {
            return false;
        }
    
    }
    
    public function ViewAllConsumables()
    {

        $this->db->query(
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







    // THIS IS THE FUNCTION CAN GET STAGES AS AN ARRAY AND GIVE DETAILS
    public function viewVehicleList($stage)
    {

        $quotedStages = implode(',', array_map(function($stage) {
            return "'" . addslashes($stage) . "'";
        }, $stage));

        $sql = "SELECT `vehicle`.`ChassisNo`, 
                        `vehicle`.`EngineNo`, 
                        `vehicle`.`CurrentStatus`, 
                        `vehicle`.`Color`, 
                        `vehicle-model`.`ModelName` 
                    FROM `vehicle`, `vehicle-model` 
                    WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo` AND `vehicle`.`CurrentStatus` IN ($quotedStages)";

            $this->db->query($sql);

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }

    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING VEHICLES IN CARD VIEWS
    public function viewCarsOnFactory($vehicleType = null, $stages = null, $progress = null)
    {
        $sql = 'SELECT `vehicle`.`ChassisNo`, 
                            `vehicle`.`EngineNo`, 
                            `vehicle`.`CurrentStatus`, 
                            `vehicle`.`Color`, 
                            `vehicle-model`.`ModelName` 
                            FROM `vehicle`, `vehicle-model` 
                            WHERE `vehicle`.`ModelNo` = `vehicle-model`.`ModelNo`';


        if ($vehicleType != null) {

            if (empty($vehicleType)) {
                // NO VALID MODEL NAMES SELECTED, RETURN AN EMPTY RESULT SET
                return false;
            }

            $vehicleModels = implode(',', array_map(function ($vehicle) {
                return "'" . addslashes($vehicle) . "'";
            }, $vehicleType));

            $sql .= " AND `vehicle`.`ModelNo` IN ($vehicleModels)";
        }



        if ($progress == null) {

            $sql .= " AND `vehicle`.`CurrentStatus` IN ('S1', 'S2', 'S3', 'S4')";

        } else {

            if ($progress == 'inprogress') {

                if (isset($stages)) {

                    if (empty($stages)) {
                        // NO VALID MODEL NAMES SELECTED, RETURN AN EMPTY RESULT SET
                        return false;
                    }

                    $reqstages = implode(',', array_map(function ($stage) {
                        return "'" . addslashes($stage) . "'";
                    }, $stages));

                    $sql .= " AND `vehicle`.`CurrentStatus` IN ($reqstages)";
                }
            } else if ($progress == 'All') {

                $sql .= " AND `vehicle`.`CurrentStatus` IN ('S1', 'S2', 'S3', 'S4', 'H')";

            }
        }



        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $vehicles = $this->db->resultSet();


        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }



}