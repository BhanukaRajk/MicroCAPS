<?php

class PDI
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function onPDIVehicles($parameters = null, $arr = true ) {

        $condition = '';
        $array = [];

        if ( $parameters != null) {
            foreach ($parameters as $key => $value) {
                switch ($key) {
                    case 'ModelName':
                        $condition .= 'AND `vehicle-model`.'.$key.' LIKE :'.$key.' ';
                        break;
                    case 'Tester':
                        $condition .= 'AND CONCAT(`employee`.Firstname," ",`employee`.Lastname) LIKE :'.$key.' ';
                        break;
                    default:
                        $condition .= 'AND `vehicle`.'.$key.' LIKE :'.$key.' ';
                        break;
                }
                $array[] = [ 'key' => ':'.$key, 'parameter' => $value ];
            }
        }

        $this->db->query(
            'SELECT `vehicle`.*, CONCAT(`employee`.Firstname," ",`employee`.Lastname) AS Tester,`vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                INNER JOIN `employee`
                ON `vehicle`.TesterId = `employee`.EmployeeId
                WHERE `vehicle`.CurrentStatus = :status '.$condition.'
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':status', 'RR');
        foreach ($array as $item) {
            $this->db->bind($item['key'], $item['parameter'].'%');
        }

        if ( $arr ) {
            $results = $this->db->resultSet();
        } else {
            $results = $this->db->single();
        }

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function onPDIVehiclesByModel($model) {

        $this->db->query(
            'SELECT `vehicle`.*, CONCAT(`employee`.Firstname," ",`employee`.Lastname) AS Tester,`vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                INNER JOIN `employee`
                ON `vehicle`.TesterId = `employee`.EmployeeId
                WHERE `vehicle-model`.ModelName LIKE :model 
                  AND `vehicle`.CurrentStatus = :status 
                  AND `vehicle`.PDIStatus = :pdi 
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':model', $model . '%');
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
            'SELECT `pdi-check-category`.*,
                COUNT(*) AS count
                FROM `pdi-check-category`
                INNER JOIN `pdi-check`
                ON `pdi-check-category`.`CategoryId` = `pdi-check`.`CategoryId`
                GROUP BY `pdi-check-category`.`CategoryId`
                ORDER BY count ASC'
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

    public function viewDefectSheets($id) {
        $this->db->query(
            "SELECT `pdi-defect`.`DefectNo`, 
            `pdi-defect`.`RepairDescription`, 
            `pdi-defect`.`InspectionDate`, 
            `pdi-defect`.`ChassisNo`,
            `pdi-defect`.`EmployeeID`, 
            `pdi-defect`.`ReCorrection` 
            FROM `pdi-defect`
            WHERE `pdi-defect`.`ChassisNo` = :id"
        );

        $this->db->bind(':id', $id);

        $row = $this->db->resultSet();

        if ( $row ) {
            return $row;
        } else {
            return null;
        }
    }

}