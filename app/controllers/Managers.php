<?php

class Managers extends Controller {

    private $managerModel;

    public function __construct(){

    }

    public function dashboard(){

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view('manager/dashboard');
        }

    }


}