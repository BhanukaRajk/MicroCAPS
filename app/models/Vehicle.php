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

    public function getComponents($color, $model) {
        $this->db->query(
            'SELECT `component`.PartNo, `component`.Qty
            FROM `component`
            WHERE `component`.ModelNo = :model AND (`component`.Color = :color OR `component`.Color = :none)'
        );

        $this->db->bind(':model', $model);
        $this->db->bind(':color', $color);
        $this->db->bind(':none', 'None');

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return false;
        }
    }

    public function addVehicleComponent($chassisNo, $partNo, $status): bool {
        $this->db->query(
            'INSERT INTO `stage-vehicle-process`
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

    public function getComponentStatus($chassisNo, $status = '%', $stage = '%') {
        $this->db->query(
            'SELECT `stage-vehicle-process`.Status, component.PartName, component.StageNo, component.Weight
                    FROM `stage-vehicle-process`
                    INNER JOIN component
                    ON `stage-vehicle-process`.PartNo = component.PartNo
                    WHERE `stage-vehicle-process`.ChassisNo = :chassisNo AND `stage-vehicle-process`.Status = :status AND component.StageNo LIKE :stage;'
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
                    FROM `stage-vehicle-process`
                    INNER JOIN component
                    ON `stage-vehicle-process`.PartNo = component.PartNo
                    WHERE `stage-vehicle-process`.Status = :status
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

    public function addComponentRequest($modelNo, $color): bool {
        $this->db->query(
            'INSERT INTO `component-request`(ModelNo, Color) VALUES (:modelNo, :color)'
        );

        $this->db->bind(':modelNo', $modelNo);
        $this->db->bind(':color', $color);

        if ( $this->db->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    public function getComponentRequest($Model = '%', $Color = '%') {
        $this->db->query(
            '
            SELECT `vehicle-model`.ModelName, `component-request`.ModelNo, `component-request`.Color, COUNT(*) AS Qty 
            FROM `component-request` 
            INNER  JOIN `vehicle-model` 
            ON `component-request`.ModelNo = `vehicle-model`.ModelNo 
            WHERE Status = :status AND `component-request`.ModelNo LIKE :model AND `component-request`.Color LIKE :color
            GROUP BY `component-request`.ModelNo,`component-request`.Color
            '
        );

        $this->db->bind(':status', 'Pending');
        $this->db->bind(':model', $Model);
        $this->db->bind(':color', $Color);

        $results = $this->db->resultSet();

        if ( $results ) {
            return $results;
        } else {
            return [];
        }
    }
}