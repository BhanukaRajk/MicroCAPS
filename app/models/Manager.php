<?php
class Manager {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addShell($chassisNo, $chassisType, $color): bool
    {
        $this->db->query(
            'INSERT INTO car(ChassisNo, VehicleModel, Color, ArrivalDate) 
            VALUES (:chassisNo,:chassisType,:color, :arrivalDate)'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':chassisType', $chassisType);
        $this->db->bind(':color', $color);
        $this->db->bind(':arrivalDate', date("Y-m-d"));

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function addRepairJob($chassisNo, $repairDescription): bool
    {
        $this->db->query(
            'INSERT INTO repairjob(`RepairID`, `ChassisNo`, `RepirDescription`, `RequestDate`, `Status`) 
            VALUES (:repairId, :chassisNo, :repairDescription, :requestDate, :status)'
        );

        $this->db->bind(':repairId', 'R00' . ($chassisNo[8] + random_int(100,10000)));
        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':repairDescription', $repairDescription);
        $this->db->bind(':requestDate', date("Y-m-d"));
        $this->db->bind(':status', 'NC');

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function addPaintJob($chassisNo): bool
    {
        $this->db->query(
            'INSERT INTO paintjob(`PaintID`, `ChassisNo`, `RequestDate`, `Status`)
            VALUES (:paintId, :chassisNo, :requestDate, :status)'
        );

        $this->db->bind(':paintId', 'P00' . ($chassisNo[8] + random_int(100,10000)));
        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':requestDate', date("Y-m-d"));
        $this->db->bind(':status', 'NC');

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function shellDetails()
    {
        $this->db->query(
            'SELECT ChassisNo, VehicleModel, Color, ArrivalDate
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
            'SELECT repairjob.*, car.VehicleModel, car.Color
            FROM repairjob
            INNER JOIN car
            ON repairjob.ChassisNo = car.ChassisNo
            WHERE repairjob.Status = :status
            ORDER BY repairjob.RequestDate'
        );

        $this->db->bind(':status', 'NC');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function paintDetails() {
        $this->db->query(
            'SELECT paintjob.*, car.VehicleModel, car.Color
            FROM paintjob
            INNER JOIN car
            ON paintjob.ChassisNo = car.ChassisNo
            WHERE paintjob.Status = :status
            ORDER BY paintjob.RequestDate'
        );

        $this->db->bind(':status', 'NC');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function jobDone($id,$job) {

        if ( $job == 'repair' ) {
            $this->db->query(
                'UPDATE repairjob
                SET Status = :status
                WHERE RepairID = :id'
            );
        } else if ( $job == 'paint' ) {
            $this->db->query(
                'UPDATE paintjob
                SET Status = :status
                WHERE PaintID = :id'
            );
        }

        $this->db->bind(':id', $id);
        $this->db->bind(':status', 'C');

        if ( $this->db->execute() ) {
            return true;
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
}