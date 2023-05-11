<?php

class Common {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function apiKey() {
        $this->db->query(
            'SELECT `key` FROM `pdf-generator` WHERE `test-docs` != 0 ORDER BY `test-docs` LIMIT 1;'
        );

        $results = $this->db->single();

        if ( $results ) {
            return $results;
        } else {
            return null;
        }
    }

    public function apiKeyUpdate($key) {
        $this->db->query(
            'UPDATE `pdf-generator` SET `test-docs` = `test-docs` - 1 WHERE `key` = :key;'
        );

        $this->db->bind(':key', $key);

        $this->db->execute();

    }

}