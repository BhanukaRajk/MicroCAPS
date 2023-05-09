<?php
class Consumable
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

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

}

