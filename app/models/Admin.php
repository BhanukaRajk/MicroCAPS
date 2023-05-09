<?php
class  Admin {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function assemblyCount()
    {
        $this->db->query(
            'SELECT COUNT(*) as Count
                FROM `vehicle`
                WHERE `vehicle`.CurrentStatus IN ("S1","S2","S3","S4");'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }
    
    public function getLastId() {
        $this->db->query('SELECT MAX(EmployeeId) AS id FROM Employee');

        $row = $this->db->single();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function employeeDetails($position) {
        $this->db->query('SELECT * FROM Employee WHERE (Position = :position AND Progress = 1)');

        $this->db->bind(':position', $position);

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }
    
    public function employeeDetailsById($id) {
        $this->db->query('SELECT * FROM Employee WHERE EmployeeId = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function employeeCount($position) {
        $this->db->query('SELECT COUNT(*) as Count FROM Employee WHERE Position = :position');

        $this->db->bind(':position', $position);

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

    public function addEmployee($data): bool {
        $this->db->query(
            'INSERT INTO Employee (EmployeeId, FirstName, LastName, NIC, Email, TelephoneNo, Position)
                VALUES (:id, :firstname, :lastname, :nic, :email, :telephone, :position)'
        );

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':nic', $data['nic']);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function editEmployee($data): bool {
        
        $this->db->query(
            'UPDATE `employee` 
            SET `Firstname`=:firstname,
                `Lastname`=:lastname,
                `NIC`=:nic,
                `TelephoneNo`=:telephone,
                `Email`=:email,
                `Position`=:position
            WHERE `EmployeeId`=:id'
        );

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':nic', $data['nic']);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function createUser($data): bool {
        $this->db->query(
            'INSERT INTO `employee-credentials` (EmployeeId, Username, Password)
                VALUES (:id, :username, :password)'
        );

        $password = password_hash($data['nic'],PASSWORD_DEFAULT,['cost' => 12]);

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['email']);
        $this->db->bind(':password', $password);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id): bool {

        $this->db->query('UPDATE Employee SET Progress= 0 WHERE EmployeeId = :id');
       

        $this->db->bind(':id', $id);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function onPDIVehicles() {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.EngineNo
                FROM `vehicle`
                WHERE `vehicle`.CurrentStatus = :status AND `vehicle`.PDIStatus = :pdi
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':status', 'PDI');
        $this->db->bind(':pdi', 'NC');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function pdiCheckCategories() {
        $this->db->query(
            'SELECT *
                FROM `pdi-check-category`'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }

    }

    public function pdiCheckList($id) {
        $this->db->query(
            'SELECT `pdi-result`.*,`pdi-check`.CategoryId, `pdi-check`.CheckName
                FROM `pdi-result`
                INNER JOIN `pdi-check`
                ON `pdi-result`.CheckId = `pdi-check`.CheckId 
                WHERE `pdi-result`.ChassisNo = :id;'
        );

        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function dispatchDetails() {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ReleaseDate, `vehicle`.ShowRoomName, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :released
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':released', 'D');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function assemblyDetails($order = 'DESC')
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus IN ("S1","S2","S3","S4")
                ORDER BY `vehicle`.ChassisNo '.$order.';'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
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

    public function updateProfile($id, $firstname, $email, $image): bool {
        $this->db->query(
            'UPDATE employee
            SET firstname = :firstname, email = :email, image = :image
            WHERE EmployeeID = :id'
        );

        $this->db->bind(':id', $id);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':email', $email);
        $this->db->bind(':image', $image);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfileValues($id, $firstname, $email): bool {
        $this->db->query(
            'UPDATE employee
            SET firstname = :firstname, email = :email
            WHERE EmployeeID = :id'
        );

        $this->db->bind(':id', $id);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':email', $email);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function test($id) {
        $this->db->query(
            'SELECT Firstname,Lastname,NIC,TelephoneNo,Email,Position
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

    public function activityLogs() {

        $this->db->query(
            'SELECT `employee-logs`.`EmployeeId`, `employee-logs`.`LoggedIn` ,CONCAT(`Firstname`," ",`Lastname`) AS `empName`, DATE(`lastLog`) AS `logDate`, TIME(`lastLog`) AS `logTime` 
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