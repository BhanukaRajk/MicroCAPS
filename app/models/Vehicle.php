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
                WHERE `vehicle`.CurrentStatus = :status'
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
            'SELECT component.PartName, COUNT(component.PartName) AS Qty, component.Color  
                    FROM `component-release`
                    INNER JOIN component
                    ON `component-release`.PartNo = component.PartNo
                    WHERE `component-release`.Status = :status
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

}