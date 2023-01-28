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

        $this->db->query('SELECT * FROM credentials  WHERE credentials.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function login($username, $password)
    {
        $this->db->query(
            'SELECT credentials.Username, credentials.Password, employee.EmployeeID, employee.Firstname, employee.Lastname, employee.Position
            FROM credentials
            INNER JOIN employee
            ON credentials.EmployeeID = employee.EmployeeId
            WHERE credentials.Username = :username'
        );

        $this->db->bind(':username', $username);

        $row = $this->db->single();


        // COMPARING HASHED PASSWORDS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // if (password_hash($password, PASSWORD_DEFAULT) == password_hash($row->Password, PASSWORD_DEFAULT)) {
        if ($password == $row->Password) {
            return $row;
        } else {
            return null;
        }
    }



    public function dashdetails()
    {

        $this->db->query(
            'SELECT COUNT(*)
                FROM carprocess
                WHERE StageNo != NOT NULL;'
        );

        $assemblingCount = $this->db->rowCount();

        if ($assemblingCount >= 0) {
            return $assemblingCount;
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


    public function checkEmployee($empid)
    {

        $this->db->query('SELECT EmployeeId FROM employee WHERE EmployeeId = :employee AND Progress = 1');

        $this->db->bind(':employee', $empid);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function checkLeaves($empid, $reqdate)
    {

        $this->db->query('SELECT EmployeeId, LeaveDate FROM leaves WHERE leaves.EmployeeId = :employee AND leaves.LeaveDate = :req_date');

        $this->db->bind(':employee', $empid);
        $this->db->bind(':req_date', $reqdate);

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
            'INSERT INTO leaves(EmployeeId, LeaveDate, Reason) 
            VALUES (:empid,:leavedate,:reason)'
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
            'UPDATE leaves
            SET EmployeeId = :empid, LeaveDate = :leavedate, Reason = :reason
            WHERE Leave_Id = :id;'
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
            'DELETE FROM leaves WHERE Leave_Id = :leave_id;'
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
            'SELECT leaves.Leave_Id, leaves.EmployeeId, employee.Firstname, employee.Lastname, leaves.LeaveDate, leaves.Reason
                FROM leaves 
                INNER JOIN employee
            ON leaves.EmployeeId = employee.EmployeeId
            -- WHERE LeaveDate > GETDATE()
            ORDER BY LeaveDate ASC;'
        );

        $leaves = $this->db->resultSet();
        // print_r($leaves);

        if ($leaves) {
            return $leaves;
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
        //print_r($consumables);

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


    public function ViewVehicles()
    {

        $this->db->query(
            'SELECT *
                FROM vehicles; '
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
