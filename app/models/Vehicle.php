<?php

class Vehicle {

    private Database $db;

    public function __construct(){
        $this->db = new Database;
    }



    /* Vehicle */

    // Retrieve Query : Vehicles count according to the status
    public function vehicleCount($status): int {
        $this->db->query(
            'SELECT count(`vehicle`.ChassisNo) AS Count
                FROM `vehicle` 
                WHERE `vehicle`.CurrentStatus LIKE :status'
        );

        $this->db->bind(':status', $status);

        $results = $this->db->single();

        if ( $results ) {
            return $results->Count;
        } else {
            return 0;
        }
    }

    // Insert Query : Add a new vehicle
    public function addShell($chassisNo, $chassisType, $color): bool
    {
        $this->db->query(
            'INSERT INTO vehicle(ChassisNo, EngineNo, ModelNo, Color, ArrivalDate) 
            VALUES (:chassisNo, :engineNo, :chassisType, :color, :arrivalDate)'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':engineNo', 'E'.substr($chassisNo, 1));
        $this->db->bind(':chassisType', $chassisType);
        $this->db->bind(':color', $color);
        $this->db->bind(':arrivalDate', date("Y-m-d"));

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of vehicles according to the Chassis Number
    public function shellDetail($chassisNo)
    {
        $this->db->query(
            'SELECT `vehicle`.*, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.ChassisNo = :chassisNo'
        );

        $this->db->bind(':chassisNo', $chassisNo);

        $results = $this->db->single();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of vehicles in Pre Assembly
    public function shellDetails()
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ArrivalDate, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :released
                ORDER BY `vehicle`.ChassisNo DESC;'
        );

        $this->db->bind(':released', 'Init');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Update Query : Update the status of the vehicle to 'S1' (Start Assembly)
    public function updateCurrentStatus($chassisNo): bool {
        $this->db->query(
            'UPDATE `vehicle`
            SET `vehicle`.CurrentStatus = :state
            WHERE `vehicle`.ChassisNo = :chassisNo'
        );

        $this->db->bind(':state', 'S1');
        $this->db->bind(':chassisNo', $chassisNo);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of vehicles according to the status and PDI status
    public function getVehiclesByStatus($status, $pdiStatus = 'NC')
    {
        $this->db->query(
            'SELECT `vehicle`.*, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :status AND `vehicle`.PDIStatus = :pdiStatus
                ORDER BY `vehicle`.ChassisNo DESC;'
        );

        $this->db->bind(':status', $status);
        $this->db->bind(':pdiStatus', $pdiStatus);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Insert Query : Add a new repair job
    public function addRepairJob($chassisNo, $repairDescription): bool
    {
        $this->db->query(
            'INSERT INTO `vehicle-repair-job`(`RepairId`, `ChassisNo`, `RepairDescription`, `RequestDate`, `Status`) 
            VALUES (:repairId, :chassisNo, :repairDescription, :requestDate, :status)'
        );

        $this->db->bind(':repairId', 'R00' . ($chassisNo[8] + random_int(1000,10000)));
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

    // Retrieve Query : Details of repair jobs according to the Chassis Number
    public function repairDetail($chassisNo) {
        $this->db->query(
            'SELECT `vehicle-repair-job`.RepairId, `vehicle-repair-job`.RepairDescription, `vehicle-repair-job`.RequestDate, `vehicle-repair-job`.Status
            FROM `vehicle-repair-job`
            WHERE `vehicle-repair-job`.ChassisNo = :chassisNo
            ORDER BY `vehicle-repair-job`.RequestDate DESC'
        );

        $this->db->bind(':chassisNo', $chassisNo);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of Not Completed repair jobs
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

    // Retrieve Query : Details of repair jobs according to the chassis number and status
    public function findRepairJobByChassis($ChassisNo): bool {
        $this->db->query(
            'SELECT *
            FROM `vehicle-repair-job`
            WHERE `vehicle-repair-job`.ChassisNo = :chassisNo AND `vehicle-repair-job`.Status = :status'
        );

        $this->db->bind(':chassisNo', $ChassisNo);
        $this->db->bind(':status', 'NC');

        if ( $this->db->single() ) {
            return true;
        } else {
            return false;
        }
    }

    // Insert Query : Add a new paint job
    public function addPaintJob($chassisNo): bool
    {
        $this->db->query(
            'INSERT INTO `vehicle-paint-job`(`PaintId`, `ChassisNo`, `RequestDate`, `Status`)
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

    // Retrieve Query : Details of paint jobs according to the Chassis Number
    public function paintDetail($chassisNo) {
        $this->db->query(
            'SELECT `vehicle-paint-job`.PaintId, `vehicle-paint-job`.RequestDate, `vehicle-paint-job`.Status 
            FROM `vehicle-paint-job`
            WHERE `vehicle-paint-job`.ChassisNo = :chassisNo
            ORDER BY `vehicle-paint-job`.RequestDate DESC'
        );

        $this->db->bind(':chassisNo', $chassisNo);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of Not Completed paint jobs
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

    // Retrieve Query : Get the chassis number of the vehicle according to the paint job id
    public function getChassisByPaintId($paintId) {
        $this->db->query(
            'SELECT `vehicle-paint-job`.ChassisNo
            FROM `vehicle-paint-job`
            WHERE `vehicle-paint-job`.PaintId = :paintid'
        );

        $this->db->bind(':paintid', $paintId);

        $results = $this->db->single();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Update Query : Update the status of the paint job or repair job to 'C' (Completed)
    public function jobDone($id,$job): bool {

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



    /* Components & Processes */

    // Retrieve Query : Details of all components according to the model
    public function getComponents($model) {
        $this->db->query(
            'SELECT `component`.PartNo, `component`.Qty
            FROM `component`
            WHERE `component`.ModelNo = :model'
        );

        $this->db->bind(':model', $model);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all processes according to the model
    public function getProcesses($model) {
        $this->db->query(
            'SELECT `stage-process`.ProcessId
            FROM `stage-process`
            WHERE `stage-process`.ModelNo = :model'
        );

        $this->db->bind(':model', $model);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Insert Query : Add Components to Vehicles added to Assembly Line
    public function initComponent($chassisNo, $partNo, $status): bool {
        $this->db->query(
            'INSERT INTO `component-release`
            VALUE (:chassisNo, :partNo, :status)'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':partNo', $partNo);
        $this->db->bind(':status', $status);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Insert Query : Add Process to Vehicles added to Assembly Line
    public function initProcess($chassisNo, $processId, $status): bool {
        $this->db->query(
            'INSERT INTO `stage-vehicle-process`
            VALUE (:chassisNo, :processId, :status)'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':processId', $processId);
        $this->db->bind(':status', $status);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Update Query : Update the status of the component according to the chassis number
    public function updateProcessStatus($chassisNo, $status): bool {
        $this->db->query(
            'UPDATE `stage-vehicle-process`
            SET `stage-vehicle-process`.Status = :status
            WHERE `stage-vehicle-process`.ChassisNo = :chassisNo'
        );

        $this->db->bind(':status', $status);
        $this->db->bind(':chassisNo', $chassisNo);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all components according to the model number
    public function getComponentDetails($ModelNo) {
        $this->db->query(
            'SELECT *
                    FROM component
                    WHERE component.ModelNo = :model;'
        );

        $this->db->bind(':model', $ModelNo);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

    // Retrieve Query : Details of damaged components according to the model number
    public function getDamagedComponentDetails($ModelNo) {
        $this->db->query(
            'SELECT *
                FROM `component`
                WHERE PartNo IN (SELECT PartNo FROM `component-release` WHERE Status IN ("D","ID")) AND component.ModelNo = :model;'
        );

        $this->db->bind(':model', $ModelNo);
        $this->db->bind(':status', 'D');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

    // Retrieve Query : Details of all processes according to Chassis Number, Status and Stage Number
    public function getProcessStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, `stage-process`.ProcessName, `stage-process`.StageNo, `stage-process`.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN `stage-process`
                    ON `stage-vehicle-process`.ProcessId = `stage-process`.ProcessId
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND `stage-process`.StageNo LIKE :stage;'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':status', $status);
        $this->db->bind(':stage', $stage);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

    // Retrieve Query : Details of all components according to Chassis Number
    public function componentsReceived($chassisNo) {
        $this->db->query(
            'SELECT `component`.PartNo, `component`.PartName, `component-release`.Status
                FROM `component` 
                INNER JOIN `component-release`
                ON `component`.PartNo = `component-release`.PartNo
                WHERE `component-release`.ChassisNo = :chassisNo'
        );

        $this->db->bind(':chassisNo', $chassisNo);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of Chassis Numbers according which did not receive some components
    public function componentChassis() {

        $this->db->query(
            'SELECT `component-release`.ChassisNo, `component-release`.Status, `vehicle`.Color
                FROM `component-release`
                INNER JOIN `vehicle`
                ON `component-release`.ChassisNo = `vehicle`.ChassisNo
                GROUP BY `component-release`.ChassisNo, `component-release`.Status
                HAVING `component-release`.Status = :status'
        );

        $this->db->bind(':status', 'NR');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Update Query : Update the status of the component according to the chassis number and part number
    public function updateComponentStatus($chassisNo, $partNo, $status = 'R'): bool
    {
        $this->db->query(
            'UPDATE `component-release`
            SET Status = :status
            WHERE ChassisNo = :chassisNo AND PartNo = :partNo'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':partNo', $partNo);
        $this->db->bind(':status', $status);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all Damaged components
    public function currentDamagedComponents() {

        $this->db->query('SELECT ChassisNo, PartNo FROM `component-release` WHERE Status = :status;');

        $this->db->bind(':status', 'D');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all Damaged components
    public function componentQty() {
        $this->db->query(
            'SELECT component.PartName, COUNT(component.PartName) AS Qty, component.Color, component.ModelNo , vehicle.Color AS VehicleColor 
                    FROM `component-release`
                    INNER JOIN component
                    ON `component-release`.PartNo = component.PartNo
                    INNER JOIN `vehicle`
                    ON `component-release`.ChassisNo = vehicle.ChassisNo
                    WHERE `component-release`.Status IN ("D","ID")
                    GROUP BY component.PartNo, VehicleColor;'
        );

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }



    /* Assembly Stages */

    // Retrieve Query : Details of all assembly vehicles according to the chassis number
    public function assemblyDetails($chassisNo = "%", $order = 'DESC')
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE (`vehicle`.CurrentStatus IN ("S1","S2","S3","S4","H") OR `vehicle`.CurrentStatus LIKE :status) AND `vehicle`.ChassisNo LIKE :chassisNo
                ORDER BY `vehicle`.ChassisNo '.$order.';'
        );

        $this->db->bind(':chassisNo', '%'.$chassisNo . '%');
        $this->db->bind(':status', '%H');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all assembly vehicles according to the model
    public function assemblyDetailsByModel($model, $order = 'DESC')
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.CurrentStatus, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus IN ("S1","S2","S3","S4","H") AND `vehicle-model`.ModelName LIKE :ModelNo
                ORDER BY `vehicle`.ChassisNo '.$order.';'
        );

        $this->db->bind(':ModelNo', $model . '%');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    // Retrieve Query : Holding Stage of a vehicle
    public function holdStage($chassisNo) {

        $this->db->query(
            'SELECT ProcessId, StageNo
                    FROM `stage-process`
                    WHERE ProcessId IN (SELECT ProcessId FROM `stage-vehicle-process` WHERE ChassisNo = :chassisNo AND Status = :status);'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':status', 'OnHold');

        $result = $this->db->single();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }



    /* Dispatch */

    // Update Query : Dispatch a vehicle
    public function dispatch($chassisNo, $showroom) : bool {
        $this->db->query(
            'UPDATE `vehicle`
            SET CurrentStatus = :status, ShowRoomName = :showroom, ReleaseDate = :date
            WHERE ChassisNo = :chassisNo'
        );

        $this->db->bind(':chassisNo', $chassisNo);
        $this->db->bind(':status', 'D');
        $this->db->bind(':showroom', $showroom);
        $this->db->bind(':date', date("Y-m-d"));

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve Query : Details of all dispatched vehicles according to the chassis number
    public function dispatchDetails($parameters = null) {

        $condition = '';
        $array = [];

        if ( $parameters != null) {
            foreach ($parameters as $key => $value) {
                switch ($key) {
                    case 'ModelName':
                        $condition .= 'AND `vehicle-model`.'.$key.' LIKE :'.$key.' ';
                        break;
                    default:
                        $condition .= 'AND `vehicle`.'.$key.' LIKE :'.$key.' ';
                        break;
                }
                $array[] = [ 'key' => ':'.$key, 'parameter' => $value ];
            }
        }

        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ReleaseDate, `vehicle`.ShowRoomName, `vehicle-model`.ModelName
                FROM `vehicle` 
                INNER JOIN `vehicle-model`
                ON `vehicle`.ModelNo = `vehicle-model`.ModelNo
                WHERE `vehicle`.CurrentStatus = :released '.$condition.'
                ORDER BY `vehicle`.ChassisNo DESC
                LIMIT 10;'
        );

        $this->db->bind(':released', 'D');
        foreach ($array as $item) {
            $this->db->bind($item['key'], '%'.$item['parameter'].'%');
        }

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }










 }