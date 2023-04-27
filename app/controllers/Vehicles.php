<?php

class Vehicles extends Controller {

    private $vehicleModel;

    public function __construct(){
        $this->vehicleModel = $this->model('Vehicle');
    }

    public function shellDetail() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo'])
            ];

            $data['shellDetails'] = $this->vehicleModel->shellDetail($data['chassisNo']);
            $data['repairDetails'] = $this->vehicleModel->repairDetail($data['chassisNo']);
            $data['paintDetails'] = $this->vehicleModel->paintDetail($data['chassisNo']);

            echo json_encode($data);

        }
    }

    public function startAssembly() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo'])
            ];

            $details = $this->vehicleModel->shellDetail($data['chassisNo']);

            $components = $this->vehicleModel->getComponents($details->Color, $details->ModelNo);

            foreach ($components as $component) {
                $status = 'Not Requested';
                $this->vehicleModel->addVehicleComponent($data['chassisNo'], $component->PartNo, $status);
            }

            if ( $this->vehicleModel->updateCurrentStatus($data['chassisNo']) ) {
                echo 'Successful';
            } else {
                echo 'Error';
            }

        }
    }

    public function assemblyPercentageDetail() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo'])
            ];

            $data['overall'] = [
                'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($data['chassisNo'], 'Pending'), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($data['chassisNo'], 'Connected'), "Weight"))
            ];

            if ($data['overall']) {
                echo json_encode($data);
            }

        }

    }

}