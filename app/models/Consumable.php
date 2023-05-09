<?php
class Consumable
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    // THIS FUNCTION IS USED TO FETCH DATA FOR FILTERING CONSUMABLES IN CARD VIEWS
    public function viewConsumables($consumeType = null, $cstatus = null)
    {
        $sql = 'SELECT `ConsumableId`, `ConsumableName`, 
                    `Volume`, `Weight`, 
                    DATE(`LastUpdate`) AS `UDate`,
                    TIME(`LastUpdate`) AS `UTime`, 
                    `LastUpdateBy`, `Image` 
                    FROM `consumable`, `employee`
                    WHERE `ConsumableId` IS NOT NULL';


        if (isset($consumeType)) {
            if ($consumeType == 'Lubricants') {
                $sql .= ' AND `Volume` IS NOT NULL';
            } elseif ($consumeType == 'Grease') {
                $sql .= ' AND `Weight` IS NOT NULL';
            }
        }

        if (isset($cstatus)) {
            if ($cstatus == 'Available') {
                $sql .= ' AND (`Volume` >= 60 OR `Weight` >= 60)';
            } elseif ($cstatus == 'Low') {
                $sql .= ' AND (`Volume` < 60 OR `Weight` < 60)';
            }
        }

        $sql .= ';';

        // DO NOT SWAP THE ORDER OF QUERY AND BIND
        $this->db->query($sql);

        $consumables = $this->db->resultSet();


        if ($consumables) {
            return $consumables;
        } else {
            return false;
        }
    }


    // UPDATING CONSUMABLE QUANTITY
    public function updateConsumableQuantity($consume_id, $quantity, $consume_type, $user): bool
    {
        if($consume_type == "Liters") {
            $this->db->query(
                'UPDATE `consumable` SET `Volume` = :quantity, 
                        `LastUpdate` = CURRENT_TIMESTAMP, 
                        `LastUpdateBy` = :user 
                WHERE `ConsumableId` = :consume;'
            );
        } else {
            $this->db->query(
                'UPDATE `consumable` SET `Weight` = :quantity, 
                        `LastUpdate` = CURRENT_TIMESTAMP, 
                        `LastUpdateBy` = :user 
                WHERE `ConsumableId` = :consume;'
            );
        }
        

        $this->db->bind(':consume', $consume_id);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':user', $user);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // CHECK THIS CONSUMABLE USING IN FACTORY
    public function checkConsumeById($consume_id): bool
    {
        $this->db->query(
            'SELECT `ConsumableId` FROM `consumable` WHERE `ConsumableId` = :consumable;'
        );

        $this->db->bind(':consumable', $consume_id);

        $row = $this->db->resultSet();

        if (!isset($row)) {
            return true;
        } else {
            return false;
        }
    
    }

    // public function removeleave($ID, $leavedate) {
    public function removeConsume($consume_id): bool
    {
        $this->db->query(
            'DELETE FROM `consumable` WHERE `ConsumableId` = :consumable;'
        );

        $this->db->bind(':consumable', $consume_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}

?>