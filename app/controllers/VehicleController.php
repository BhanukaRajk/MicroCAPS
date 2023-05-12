<?php

class VehicleController extends Controller {

    private $supervisorModel;
    private $vehicleModel;
    private $pdiModel;
    private $paqModel;
    private $componentModel;
    private $comsumeModel;
    private $toolModel;
    private $taskModel;
    private $leaveModel;

    public function __construct(){
        $this->supervisorModel = $this->model('Manager');
        $this->vehicleModel = $this->model('Vehicle');
        $this->pdiModel = $this->model('PDIsheet');
        $this->paqModel = $this->model('PAQsheet');
        $this->componentModel = $this->model('Component');
        $this->comsumeModel = $this->model('Consumable');
        $this->toolModel = $this->model('Tool');
        $this->taskModel = $this->model('Task');
        $this->leaveModel = $this->model('Leave');
    }



}

?>