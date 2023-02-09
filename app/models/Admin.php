<?php
class Admin {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function userDetails($position) {
        $this->db->query('SELECT * FROM Employee WHERE Position = :position');

        $this->db->bind(':position', $position);

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function userDelete($id): bool
    {
        $this->db->query('DELETE FROM Employee WHERE EmployeeId = :id');

        $this->db->bind(':id', $id);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEmployees($EmployeeId) {

        $this->db->query(
            "DELETE FROM `employee` 
            WHERE `employee`.`EmployeeId` = :EmployeeId"
        );

        $this->db->bind(':EmployeeId', $EmployeeId);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}