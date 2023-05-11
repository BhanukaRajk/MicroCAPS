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

        $this->db->query(
        'SELECT employee.EmployeeID, employee.Firstname, employee.Lastname, employee.Email, employee.Position, employee.Image
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

    public function validateOldPassword($id,$password): bool {
        $this->db->query(
            'SELECT `employee-credentials`.Password
                FROM `employee-credentials`
                INNER JOIN employee
                ON `employee-credentials`.Username = employee.Email
                WHERE `employee`.EmployeeID = :id'
        );

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return password_verify($password, $row->Password);
    }

    public function updatePassword($id,$password): bool {

        $this->db->query(
            'SELECT `employee-credentials`.Username
                FROM `employee-credentials`
                INNER JOIN employee
                ON `employee-credentials`.Username = employee.Email
                WHERE `employee`.EmployeeID = :id'
        );

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        $this->db->query('UPDATE `employee-credentials`
                SET `employee-credentials`.Password = :password
                WHERE `employee-credentials`.Username = :username'
        );

        $password = password_hash($password,PASSWORD_DEFAULT,['cost' => 12]);

        $this->db->bind(':username', $row->Username);
        $this->db->bind(':password', $password);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function markActivity($userId, $logged = 1): bool {

        $this->db->query(
            'UPDATE `employee-logs`
                SET lastLog = CURRENT_TIMESTAMP, loggedIn = :logged
                WHERE EmployeeId = :userId'
        );

        $this->db->bind(':userId', $userId);
        $this->db->bind(':logged', $logged);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }



}