<?php
class Leave
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    // ADD NEW LEAVES
    public function addLeave($EmpId, $leavedate, $reason): bool
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


    // VIEW ALL THE LEAVES
    public function viewLeaves()
    {

        $this->db->query(
            'SELECT `employee-leaves`.`LeaveId`, 
                `employee-leaves`.`EmployeeId`, 
                CONCAT(`employee`.`Firstname`, " ", `employee`.`Lastname`) AS `Name`, 
                `employee-leaves`.`LeaveDate`, 
                `employee-leaves`.`Reason`
            FROM `employee-leaves`
            INNER JOIN `employee`
            ON `employee-leaves`.`EmployeeId` = `employee`.`EmployeeId`
            -- WHERE LeaveDate > CURDATE()
            ORDER BY `LeaveDate` ASC;'
        );

        $leaves = $this->db->resultSet();

        if (isset($leaves)) {
            return $leaves;
        } else {
            return false;
        }
    }


    // GET THE REQUESTED LEAVE DETAILS FOR EDITING PROCESS
    public function getLeaveByID($LeaveID)
    {

        $this->db->query(
            'SELECT * FROM `employee-leaves` WHERE `LeaveId` = :Leave;'
        );

        $this->db->bind(':Leave', $LeaveID);

        $current_leave = $this->db->single();

        // IF REQUESTED LEAVE FOUND, RETURN IT
        if (isset($current_leave)) {
            return $current_leave;
        } else {
            return false;
        }
    }


    // CHECK THIS EMPLOYEE REQUESTED ANOTHER LEAVE ON THIS DATE ======> VERIFICATION
    public function checkLeaves($empid, $reqdate): bool
    {

        $this->db->query(
            'SELECT `LeaveId` FROM `employee-leaves` WHERE EmployeeId = :employee AND LeaveDate = :req_date;'
        );

        $this->db->bind(':employee', $empid);
        $this->db->bind(':req_date', $reqdate);

        $rows = $this->db->resultSet();

        if(!isset($rows)) {
            return true;
        } else {
            return false;
        }

    }


    // EDIT REQUESTED LEAVE AND UPDATE DATABASE
    public function editLeave($EmpId, $leavedate, $reason, $id): bool
    {
        $this->db->query(
            'UPDATE `employee-leaves`
            SET EmployeeId = :empid, 
                LeaveDate = :leavedate, 
                Reason = :reason
            WHERE LeaveId = :id;'
        );

        $this->db->bind(':empid', $EmpId);
        $this->db->bind(':leavedate', $leavedate);
        $this->db->bind(':reason', $reason);

        $this->db->bind(':id', $id);

        // IF THE QUERY EXECUTED, RETURN TRUE
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // REMOVE LEAVE OR TIMEOFF
    //// public function removeleave($ID, $leavedate) {
    public function removeLeave($LeaveID): bool
    {
        $this->db->query(
            'DELETE FROM `employee-leaves` WHERE `LeaveId` = :leave_id;'
            //// 'DELETE FROM leaves WHERE EmployeeId = :Empid AND LeaveDate = :LDate;'
        );

        $this->db->bind(':leave_id', $LeaveID);
        //// $this->db->bind(':Empid', $ID);
        //// $this->db->bind(':LDate', $leavedate);

        // IF THE QUERY EXECUTED, RETURN TRUE
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}

?>