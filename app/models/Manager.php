<?php
class Manager {
    private $db;

    public function __construct(){
        $this->db = new Database;
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

    public function activityLogs() {

        $this->db->query(
            'SELECT `employee-logs`.`EmployeeId`, `employee-logs`.`LoggedIn`, CONCAT(`Firstname`," ",`Lastname`) AS `empName`, DATE(`lastLog`) AS `logDate`, TIME(`lastLog`) AS `logTime` 
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

}