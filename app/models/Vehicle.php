<?php

class Vehicle {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function vehicleCount($status): int {
        $this->db->query(
            'SELECT count(`vehicle`.ChassisNo) AS Count
                FROM `vehicle` 
<<<<<<< HEAD
                WHERE `vehicle`.CurrentStatus LIKE :status'
=======
                WHERE `vehicle`.CurrentStatus = :status'
>>>>>>> dddilmi
        );

        $this->db->bind(':status', $status);

        $results = $this->db->single();

        if ( $results ) {
            return $results->Count;
        } else {
            return 0;
        }
    }

    public function shellDetail($chassisNo)
    {
        $this->db->query(
            'SELECT `vehicle`.ChassisNo, `vehicle`.Color, `vehicle`.ArrivalDate, `vehicle`.EngineNo, `vehicle`.ModelNo, `vehicle-model`.ModelName
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

<<<<<<< HEAD
    public function getComponents($model) {
        $this->db->query(
            'SELECT `component`.PartNo, `component`.Qty
            FROM `component`
            WHERE `component`.ModelNo = :model'
        );

        $this->db->bind(':model', $model);
=======
    public function getComponents($color, $model) {
        $this->db->query(
            'SELECT `component`.PartNo, `component`.Qty
            FROM `component`
            WHERE `component`.ModelNo = :model AND (`component`.Color = :color OR `component`.Color = :none)'
        );

        $this->db->bind(':model', $model);
        $this->db->bind(':color', $color);
        $this->db->bind(':none', 'None');
>>>>>>> dddilmi

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

<<<<<<< HEAD
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

    public function initComponent($chassisNo, $partNo, $status): bool {
        $this->db->query(
            'INSERT INTO `component-release`
=======
    public function addVehicleComponent($chassisNo, $partNo, $status): bool {
        $this->db->query(
            'INSERT INTO `stage-vehicle-process`
>>>>>>> dddilmi
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

<<<<<<< HEAD
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

    public function updateComponentStatus($chassisNo, $status): bool {
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

    public function getComponentDetails($ModelNo) {
        $this->db->query(
            'SELECT component.PartName, component.Color
                    FROM component
                    WHERE component.ModelNo = :model AND (component.Color = :color1 OR component.Color = :color2);'
        );

        $this->db->bind(':model', $ModelNo);
        $this->db->bind(':color1', 'Black');
        $this->db->bind(':color2', 'None');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

    public function getProcessStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, `stage-process`.ProcessName, `stage-process`.StageNo, `stage-process`.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN `stage-process`
                    ON `stage-vehicle-process`.ProcessId = `stage-process`.ProcessId
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND `stage-process`.StageNo LIKE :stage;'
=======
    public function getComponentStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, component.PartName, component.StageNo, component.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN component
                    ON `stage-vehicle-process`.PartNo = component.PartNo
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND component.StageNo LIKE :stage;'
>>>>>>> dddilmi
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

    public function componentQty($status) {
        $this->db->query(
<<<<<<< HEAD
            'SELECT component.PartName, COUNT(component.PartName) AS Qty, component.Color , vehicle.Color AS VehicleColor 
                    FROM `component-release`
                    INNER JOIN component
                    ON `component-release`.PartNo = component.PartNo
                    INNER JOIN `vehicle`
                    ON `component-release`.ChassisNo = vehicle.ChassisNo
                    WHERE `component-release`.Status = :status
=======
            'SELECT component.PartName, COUNT(component.PartName) AS Qty, component.Color  
                    FROM `stage-vehicle-process`
                    INNER JOIN component
                    ON `stage-vehicle-process`.PartNo = component.PartNo
                    WHERE `stage-vehicle-process`.Status = :status
>>>>>>> dddilmi
                    GROUP BY component.PartNo;'
        );

        $this->db->bind(':status', $status);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }

<<<<<<< HEAD
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

    // Vehicles According to the Status
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

=======
>>>>>>> dddilmi
}