<?php

class Vehicles extends Controller {

    private $vehicleModel;
    private $managerModel;

    private $pdiModel;

    public function __construct(){
        $this->vehicleModel = $this->model('Vehicle');
        $this->managerModel = $this->model('Manager');
        $this->pdiModel = $this->model('PDI');
    }

    // Shell Related
    public function shellRequest() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [];

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }

            $cnt = 0;
            $body = '';
            foreach ($data as $value) {
                if ($cnt == 0) {
                    $body .= '<tr>';
                }
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$value.'</td>';
                $cnt++;
                if ($cnt == 2) {
                    $body .= '</tr>';
                    $cnt = 0;
                }
            }

            $file = file_get_contents("../app/views/templates/shellRequest.html");
            $position = strpos($file, '<!-- Insert Point -->');
            if ($position !== false) {
                $file = substr_replace($file, $body, $position, 0);
            }

            if (sendmail($file)) {
                echo 'Successful';
            } else {
                echo 'Failed';
            }
        }
    }

    public function addShell() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo']),
                'color' => trim($_POST['color']),
                'chassisType' => trim($_POST['chassisType']),
                'repair' => $_POST['repair'] === 'true' ? 'Yes' : 'No',
                'paint' => $_POST['paint'] === 'true' ? 'Yes' : 'No',
                'repairDescription' => trim($_POST['repairDescription'])
            ];

            if($this->vehicleModel->addShell($data['chassisNo'], $data['chassisType'], $data['color'])) {
                if ($data['repair'] === 'Yes') {
                    $this->vehicleModel->addRepairJob($data['chassisNo'], $data['repairDescription']);
                    $this->vehicleModel->addPaintJob($data['chassisNo']);
                } else {
                    if ($data['paint'] === 'Yes') {
                        $this->vehicleModel->addPaintJob($data['chassisNo']);
                    }
                }
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
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

    public function requestJobs() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => trim($_POST['id']),
                'job' => trim($_POST['job']),
                'chassisNo' => trim($_POST['chassisNo']),
                'previous' => $_POST['previous'] === 'true' ? 'Yes' : 'No',
                'repairDescription' => trim($_POST['repairDescription'])
            ];

            if ($data['previous'] === 'Yes') {
                $this->managerModel->jobDone($data['id'], $data['job']);
            }

            if ($data['job'] === 'repair') {
                $this->managerModel->addRepairJob($data['chassisNo'], $data['repairDescription']);
                echo 'Successful';
            } else if ($data['job'] === 'paint') {
                $this->managerModel->addPaintJob($data['chassisNo']);
                echo 'Successful';
            } else {
                echo 'Error';
            }

        }
    }

    public function jobDone() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => trim($_POST['id']),
                'job' => trim($_POST['job'])
            ];

            if ($data['job'] === 'paint') {
                if ($this->managerModel->findRepairJobByChassis($this->managerModel->getChassisByPaintId($data['id'])->ChassisNo)) {
                    echo 'Complete The Repair Job First';
                    return;
                }
            }

            $result = $this->managerModel->jobDone($data['id'], $data['job']);

            if($result) {
                echo 'Successful';
            } else {
                echo "Error Completing Job";
            }
        }
    }


    // Assembly Line Related
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

            $components = $this->vehicleModel->getComponents($details->ModelNo);

            foreach ($components as $component) {
                $status = 'NotReceived';
                $this->vehicleModel->initComponent($data['chassisNo'], $component->PartNo, $status);
            }

            $processes = $this->vehicleModel->getProcesses($details->ModelNo);

            foreach ($processes as $process) {
                $status = 'Pending';
                $this->vehicleModel->initProcess($data['chassisNo'], $process->ProcessId, $status);
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
                'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold'), "Weight")),
                'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed'), "Weight"))
            ];

            if ($data['overall']) {
                echo json_encode($data);
            }

        }

    }


    // Search Related
    public function searchByKey() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'keyword' => trim($_POST['keyword']),
                'searchType' => trim($_POST['searchType']),
                'type' => trim($_POST['type'])
            ];

            if ($data['type'] == 'assembly') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['assemblyDetails'] = $this->vehicleModel->assemblyDetails($data['keyword']);
                } else if ($data['searchType'] == 'model') {
                    $data['assemblyDetails'] = $this->vehicleModel->assemblyDetailsByModel($data['keyword']);
                }

                echo json_encode($data);

            } else if ($data['type'] == 'pdi') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['chassisNo' => $data['keyword']]);
                } else if ($data['searchType'] == 'model') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['ModelName' => $data['keyword']]);
                } else if ($data['searchType'] == 'tester') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['Tester' => $data['keyword']]);
                }

                echo json_encode($data);

            }

        }
    }

}