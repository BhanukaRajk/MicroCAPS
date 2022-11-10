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

        if ( $password == $row->Password ) {
            return $row;
        } else {
            return null;
        }
    }

}