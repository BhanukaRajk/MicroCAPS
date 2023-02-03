<?php
class Manager {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addShell($chassisNo, $chassisType, $color): bool
    {
        $this->db->query(
            'INSERT INTO vehicle(ChassisNo, ModelNo, Color, ArrivalDate) 
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
            'INSERT INTO `vehicle-repair-job`(`RepairID`, `ChassisNo`, `RepirDescription`, `RequestDate`, `Status`) 
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
            'INSERT INTO `vehicle-paint-job`(`PaintID`, `ChassisNo`, `RequestDate`, `Status`)
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
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ArrivalDate, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :released
                ORDER BY ArrivalDate DESC; '
        );

        $this->db->bind(':released', 'PA');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function repairDetails() {
        $this->db->query(
            'SELECT `vehicle-repair-job`.*, `vehicle-model`.ModelName, `vehicle`.Color
            FROM `vehicle-repair-job`
            INNER JOIN `vehicle`
            ON `vehicle-repair-job`.ChassisNo = `vehicle`.ChassisNo
            INNER JOIN `vehicle-model`
            ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
            WHERE `vehicle-repair-job`.Status = :status
            ORDER BY `vehicle-repair-job`.RequestDate'
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
            'SELECT `vehicle-paint-job`.*, `vehicle-model`.ModelName, `vehicle`.Color
            FROM `vehicle-paint-job`
            INNER JOIN `vehicle`
            ON `vehicle-paint-job`.ChassisNo = `vehicle`.ChassisNo 
            INNER JOIN `vehicle-model`
            ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
            WHERE `vehicle-paint-job`.Status = :status
            ORDER BY `vehicle-paint-job`.RequestDate'
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
                'UPDATE `vehicle-repair-job`
                SET Status = :status
                WHERE RepairID = :id'
            );
        } else if ( $job == 'paint' ) {
            $this->db->query(
                'UPDATE `vehicle-paint-job`
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