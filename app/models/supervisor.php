<?php
class Supervisor {
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

    public function recordPAQresults($ChassisNo, $BrakeBleeding, $GearOilLevel, $Adjusment, $Clutch, $RAP, $Visual) {
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
        $this->db->bind(':supervisor', $_SESSION[]);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewLeave($EmpId, $leavedate, $reason) {
        $this->db->query(
            'INSERT INTO leaves(EmployeeId, LeaveDate, Reason) 
            VALUES (:empid,:leavedate,:reason)'
        );

        $this->db->bind(':empid', $EmpId);
        $this->db->bind(':leavedate', $leavedate);
        $this->db->bind(':reason', $reason);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function viewPAQresults($ChassisNo) {
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

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function ViewLeaves() {

        $this->db->query(
            'SELECT *
                FROM leaves 
                ORDER BY LeaveDate DESC; '
        );

        $leaves = $this->db->resultSet();

        if ( $leaves ) {
            return $leaves;
        } else {
            return false;
        }
    }


}