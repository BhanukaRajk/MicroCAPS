<?php
class Supervisor
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function findUserByUsername($username)
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
                WHERE `CurrentStatus` != "PA";'
        );
        array_push($counts, $this->db->single());


        // CALCULATE THE NUMBER OF VEHICLES DISPATCHED
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS dispatched
                FROM `vehicle`
                WHERE `PDIStatus` = "CM";'
        );
        array_push($counts, $this->db->single());

        // CALCULATE THE NUMBER OF VEHICLES IN ON-HOLD STATE
        $this->db->query(
            'SELECT COUNT(`ChassisNo`) AS onHold
                FROM `vehicle`
                WHERE `CurrentStatus` = "Hold";'
        );
        array_push($counts, $this->db->single());

        if ($counts) {
            return $counts;
        } else {
            return false;
        }

    }


    public function recordPAQresults($ChassisNo, $BrakeBleeding, $GearOilLevel, $Adjusment, $Clutch, $RAP, $Visual)
    {
        $this->db->query(
            'INSERT INTO paqresult(ChassisNo, BrakeBleeding, GearOilLevel, RackEnd, Clutch, RearAxelPlate, Visual, Supervisor1) 
            VALUES (:chassisNo,:brake,:gearOil,:adjusment,:clutch,:rap,:visual,:supervisor)'
        );

        $this->db->bind(':chassisNo', $ChassisNo);
        $this->db->bind(':brake', $BrakeBleeding);
        $this->db->bind(':gearOil', $GearOilLevel);
        $this->db->bind(':adjusment', $Adjusment);
        $this->db->bind(':clutch', $Clutch);
        $this->db->bind(':rap', $RAP);
        $this->db->bind(':visual', $Visual);
        $this->db->bind(':supervisor', $_SESSION['_name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function checkEmployee($empid)
    {

        $this->db->query(
            'SELECT EmployeeId FROM employee WHERE EmployeeId = :employee AND Progress = 1;'
        );

        $this->db->bind(':employee', $empid);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    // CHECK THIS EMPLOYEE IS WORKING IN FACTORY
    public function activityLogs()
    {

        $this->db->query(
            'SELECT CONCAT(`Firstname`," ",`Lastname`) AS `empName`, `lastLog` 
            FROM `employee-logs`,`employee` 
            WHERE `employee-logs`.`EmployeeId` = `employee`.`EmployeeId` 
            ORDER BY `lastLog` LIMIT 6;'
        );

        $lastLogs = $this->db->resultSet();

        if ($lastLogs) {
            return $lastLogs;
        } else {
            return false;
        }
    }


    // CHECK THIS EMPLOYEE REQUESTED ANOTHER LEAVE ON THIS DATE
    public function checkLeaves($empid, $reqdate)
    {

        $this->db->query(
            'SELECT EmployeeId, LeaveDate FROM `employee-leaves` WHERE EmployeeId = :employee AND LeaveDate = :req_date;'
        );

        $this->db->bind(':employee', $empid);
        $this->db->bind(':req_date', $reqdate);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function checkLeaveByID($LeaveID)
    {

        $this->db->query(
            'SELECT `LeaveId` FROM `employee-leaves` WHERE `LeaveId` = :Leave;'
        );

        $this->db->bind(':Leave', $LeaveID);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function addleave($EmpId, $leavedate, $reason)
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


    public function EditLeave($EmpId, $leavedate, $reason, $id)
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


    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////

    // public function removeleave($ID, $leavedate) {
    public function removeleave($LeaveID)
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
    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////










    public function addNewTask($chassis_no, $task_name)
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
            'SELECT `employee-leaves`.`LeaveId`, `employee-leaves`.`EmployeeId`, `employee`.`Firstname`, `employee`.`Lastname`, `employee-leaves`.`LeaveDate`, `employee-leaves`.`Reason`
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

    
    public function ViewAllConsumables()
    {

        $this->db->query(
            'SELECT * FROM `consumable`;'
        );

        $consumables = $this->db->resultSet();

        if ($consumables) {
            return $consumables;
        } else {
            return false;
        }
    }

    public function ViewS4Finishers()
    {

        $this->db->query(
            'SELECT * FROM `vehicles`;'
        );

        $S4FVehicles = $this->db->resultSet();
        //print_r($S4FVehicles);

        if ($S4FVehicles) {
            return $S4FVehicles;
        } else {
            return false;
        }
    }


    public function SendEditLeave($ID)
    {

        $this->db->query(
            'SELECT *
                FROM leaves 
                WHERE Leave_Id = :id;'
        );

        $this->db->bind(':id', $ID);

        $editor = $this->db->single();

        if ($editor) {
            return $editor;
        } else {
            return false;
        }
    }


    public function ViewAssignedTasks()
    {

        $this->db->query(
            'SELECT *
                FROM tasks 
                WHERE EmployeeId != NULL; '
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


    public function updateToolStatus($chassis_no, $task_name)
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


    public function ViewTools()
    {

        $this->db->query(
            'SELECT *
                FROM tools; '
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
                    `Color` 
                    FROM `vehicle` 
                    WHERE `CurrentStatus` = "PA";'
        );

        $vehicles = $this->db->resultSet();

        if ($vehicles) {
            return $vehicles;
        } else {
            return false;
        }
    }


    public function viewAssemblyLineVehicleNos()
    {

        $this->db->query(
            'SELECT `ChassisNo`
                    FROM `vehicle` 
                    WHERE `CurrentStatus` = "PA";'
        );

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

}
