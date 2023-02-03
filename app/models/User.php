<?php

class User
{
private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByUsername($username): bool {

        $this->db->query('SELECT * FROM `employee-credentials`  WHERE `employee-credentials`.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function findCredentialsByUsername($username,$password): bool {
        $this->db->query(
            'SELECT `employee-credentials`.Username, `employee-credentials`.Password
                FROM `employee-credentials`
                INNER JOIN employee
                ON `employee-credentials`.EmployeeID = employee.EmployeeId
                WHERE `employee-credentials`.Username = :username'
        );

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        return password_verify($password, $row->Password);
    }

    public function login($username,$password) {

        if ($username == 'admin') {
            $this->db->query(
                'SELECT Password
                    FROM `employee-credentials`
                    WHERE Username = :username'
            );

            $this->db->bind(':username', $username);

            $row = $this->db->single();

            $obj = (object) array('EmployeeID' => 0, 'Firstname' => 'Admin', 'Lastname' => 'Admin', 'Position' => 'Admin');

            if ($password === $row->Password) {
                return $obj;
            } else {
                return null;
            }

        }

        $this->db->query(
            'SELECT employee.EmployeeID, employee.Firstname, employee.Lastname, employee.Position, employee.Image
                FROM `employee-credentials`
                INNER JOIN employee
                ON `employee-credentials`.EmployeeID = employee.EmployeeId
                WHERE `employee-credentials`.Username = :username'
        );

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->findCredentialsByUsername($username, $password)) {
            return $row;
        } else {
            return null;
        }
    }

    public function resetPassword($username,$password): bool {
        $this->db->query('UPDATE `employee-credentials`
                SET `employee-credentials`.Password = :password
                WHERE `employee-credentials`.Username = :username'
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

}