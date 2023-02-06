<?php
class Admin {
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

        $this->db->query('SELECT Username, Password FROM credentials  WHERE credentials.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ( $password == $row->Password ) {
            return $row;
        } else {
            return null;
        }

    }

    public function userdetails() {
        $this->db->query('SELECT * FROM Employee WHERE Position = "Manager"');

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function userdetails_2() {
        $this->db->query('SELECT * FROM Employee WHERE Position = "Supervisor"');

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function userdetails_3() {
        $this->db->query('SELECT * FROM Employee WHERE Position = "Tester"');

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }


}