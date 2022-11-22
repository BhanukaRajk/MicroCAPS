<?php
class Manager {
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

//        $password = password_hash($password,PASSWORD_BCRYPT,['cost' => 12]);

        if ( password_verify($password, $row->Password) ) {
            return $row;
        } else {
            return null;
        }
    }

    public function resetPassword($username,$password) {
        $this->db->query('UPDATE credentials
            SET credentials.Password = :password
            WHERE credentials.Username = :username'
        );

        $password = password_hash($password,PASSWORD_DEFAULT,['cost' => 12]);

        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addShell($chassisNo, $chassisType, $color, $repair, $paint) {
        $this->db->query(
            'INSERT INTO car(ChassisNo, VehicleModel, Color, RepairStatus, PaintStatus, ArrivalDate) 
            VALUES (:chassisNo,:chassisType,:color,:repair,:paint, :arrivalDate)'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':chassisType', $chassisType);
        $this->db->bind(':color', $color);
        $this->db->bind(':repair', $repair);
        $this->db->bind(':paint', $paint);
        $this->db->bind(':arrivalDate', date("Y-m-d"));

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function shellDetails() {
        $this->db->query(
            'SELECT ChassisNo, VehicleModel, Color, RepairStatus, PaintStatus, ArrivalDate
                FROM car 
                WHERE Released = :released
                ORDER BY ArrivalDate DESC; '
        );

        $this->db->bind(':released', 'No');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function repairDetails() {
        $this->db->query(
            'SELECT ChassisNo, VehicleModel, Color, RepairStatus, PaintStatus, ArrivalDate
                FROM car 
                WHERE Released = :released AND RepairStatus = :repairStatus
                ORDER BY ArrivalDate DESC; '
        );

        $this->db->bind(':released', 'No');
        $this->db->bind(':repairStatus', 'Yes');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function paintDetails() {
        $this->db->query(
            'SELECT ChassisNo, VehicleModel, Color, RepairStatus, PaintStatus, ArrivalDate
                FROM car 
                WHERE Released = :released AND PaintStatus = :paintStatus
                ORDER BY ArrivalDate DESC; '
        );

        $this->db->bind(':released', 'No');
        $this->db->bind(':paintStatus', 'Yes');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

}