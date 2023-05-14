<?php
class Consumable
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    // ADDING NEW CONSUMABLE
    public function addConsumable($name, $type, $status, $image) {

        if ($type == 'Lubricant') {
            $this->db->query(
                'INSERT INTO `consumable`(`ConsumableId`, `ConsumableName`, `Volume`, `LastUpdate`, `LastUpdateBy`, `Image`) 
                    VALUES (:id,:name,:status,CURRENT_TIMESTAMP,:by,:image);'
            );
            $this->db->bind(':status', $status);
        } else {
            $this->db->query(
                'INSERT INTO `consumable`(`ConsumableId`, `ConsumableName`, `Weight`, `LastUpdate`, `LastUpdateBy`, `Image`) 
                    VALUES (:id,:name,:status,CURRENT_TIMESTAMP,:by,:image);'
            );
            $this->db->bind(':status', $status);
        }

        $this->db->bind(':id', str_replace(" ", "", $name));
        $this->db->bind(':name', strtoupper($name));
//        $this->db->bind(':lastupdate', CURRENT_TIMESTAMP);
        $this->db->bind(':by', $_SESSION['_id']);
        $this->db->bind(':image', $image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // UPDATING CONSUMABLE QUANTITY
    // public function updateConsumableQuantity($consume_id, $quantity, $consume_type, $user): bool
    // {
    //     if($consume_type == "Liters") {
    //         $this->db->query(
    //             'UPDATE `consumable` SET `Volume` = :quantity, 
    //                     `LastUpdate` = CURRENT_TIMESTAMP, 
    //                     `LastUpdateBy` = :user 
    //             WHERE `ConsumableId` = :consume;'
    //         );
    //     } else {
    //         $this->db->query(
    //             'UPDATE `consumable` SET `Weight` = :quantity, 
    //                     `LastUpdate` = CURRENT_TIMESTAMP, 
    //                     `LastUpdateBy` = :user 
    //             WHERE `ConsumableId` = :consume;'
    //         );
    //     }
        

    //     $this->db->bind(':consume', $consume_id);
    //     $this->db->bind(':quantity', $quantity);
    //     $this->db->bind(':user', $user);


    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    // CHECK THIS CONSUMABLE USING IN FACTORY
    // public function checkConsumeById($consume_id): bool
    // {
    //     $this->db->query(
    //         'SELECT `ConsumableId` FROM `consumable` WHERE `ConsumableId` = :consumable;'
    //     );

    //     $this->db->bind(':consumable', $consume_id);

    //     $row = $this->db->resultSet();

    //     if (!isset($row)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    
    // }

    // public function removeleave($ID, $leavedate) {
    // public function removeConsume($consume_id): bool
    // {
    //     $this->db->query(
    //         'DELETE FROM `consumable` WHERE `ConsumableId` = :consumable;'
    //     );

    //     $this->db->bind(':consumable', $consume_id);

    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


}

?>