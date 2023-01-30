<?php

class Supervisor
{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
}