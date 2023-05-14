<?php

class Vehicles extends Controller {

    private mixed $vehicleModel;
    private mixed $managerModel;
    private mixed $pdiModel;

    public function __construct(){
        $this->vehicleModel = $this->model('Vehicle');
        $this->managerModel = $this->model('Manager');
        $this->pdiModel = $this->model('PDI');
    }



    /* Shell Related */

    // Function to Handle Shell Request
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

    // Function to Add Shell Details to System
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

    // Function to Get Shell Details + Repair Details + Paint Details
    public function shellDetail() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo'])
            ];

            $data['shellDetail'] = $this->vehicleModel->shellDetail($data['chassisNo']);
            $data['repairDetails'] = $this->vehicleModel->repairDetail($data['chassisNo']);
            $data['paintDetails'] = $this->vehicleModel->paintDetail($data['chassisNo']);

            echo json_encode($data);

        }
    }

    // Function to Record Shell Repairs and Paints
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
                $this->vehicleModel->jobDone($data['id'], $data['job']);
            }

            if ($data['job'] === 'repair') {
                $this->vehicleModel->addRepairJob($data['chassisNo'], $data['repairDescription']);
                echo 'Successful';
            } else if ($data['job'] === 'paint') {
                $this->vehicleModel->addPaintJob($data['chassisNo']);
                echo 'Successful';
            } else {
                echo 'Error';
            }

        }
    }

    // Function to Mark Repair Job and Paint Jobs as Complete
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
                if ($this->vehicleModel->findRepairJobByChassis($this->vehicleModel->getChassisByPaintId($data['id'])->ChassisNo)) {
                    echo 'Complete The Repair Job First';
                    return;
                }
            }

            $result = $this->vehicleModel->jobDone($data['id'], $data['job']);

            if($result) {
                echo 'Successful';
            } else {
                echo "Error Completing Job";
            }
        }
    }



    /* Component Related */

    // Function to Get Component Details by Chassis No
    public function componentsByChassis() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo'])
            ];

            $data['vehicles'] = $this->vehicleModel->shellDetail($data['chassisNo']);
            $data['components'] = $this->vehicleModel->componentsReceived($data['chassisNo']);

            echo json_encode($data);
        }

    }

    // Function to Mark Component as Received
    public function changeComponentStatus() {

            if (!isLoggedIn()) {
                redirect('users/login');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'status' => $_POST['status'],
                    'chassisNo' => trim($_POST['chassisNo']),
                ];

                $data['status'] = str_replace('&#34;', '', $data['status']);

                $data['status'] = $this->strtoarray($data['status']);

                foreach ($data['status'] as $key => $value) {
                    if ($value) {
                        $this->vehicleModel->updateComponentStatus($data['chassisNo'], $key);
                    }
                }

                echo 'Successful';

            }
    }

    // Function to Request Damaged Components
    public function requestDamagedComponents() {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'components' => [
                    'M0001' => $this->vehicleModel->getDamagedComponentDetails('M0001'),
                    'M0002' => $this->vehicleModel->getDamagedComponentDetails('M0002'),
                    'M0003' => $this->vehicleModel->getDamagedComponentDetails('M0003')
                ]
            ];

            if (generateMRF($_POST, $data['components'])) {
                $data['damagedComponents'] = $this->vehicleModel->currentDamagedComponents();
                foreach ($data['damagedComponents'] as $value) {
                    $this->vehicleModel->updateComponentStatus($value->ChassisNo, $value->PartNo, 'NR');
                }
                echo 'Successful';
            } else {
                echo 'Error';
            }

        }
    }



    /* Assembly Line Related */

    // Function to Start Assembly
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
                $status = 'NR';
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

    // Function to Get Overall Assembly Details by Chassis No
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

    // Function to Get Assembly Stage Details by Chassis No
    public function assemblyStagePercentageDetail() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo']),
                'stage' => trim($_POST['stage'])
            ];

            if ($data['stage'] == 'Lstage01')
                $data['stage'] = 'S1';
            elseif ( $data['stage'] == 'Lstage02' )
                $data['stage'] = 'S2';
            elseif ( $data['stage'] == 'Lstage03' )
                $data['stage'] = 'S3';
            elseif ( $data['stage'] == 'Lstage04' )
                $data['stage'] = 'S4';


            $data['overall'] = [
                'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending', $data['stage']), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold', $data['stage']), "Weight")),
                'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed', $data['stage']), "Weight"))
            ];

            if ($data['overall']) {
                echo json_encode($data);
            }

        }

    }



    /* Search Related */

    // Function to Search by a User Selected Type
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

                $data['holdStage'] = array();

                if ($data['assemblyDetails']) {
                    foreach ($data['assemblyDetails'] as $value) {
                        $data['holdStage'][] = $this->vehicleModel->holdStage($value->ChassisNo);
                    }
                }

                echo json_encode($data);

            } else if ($data['type'] == 'pdi') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['ChassisNo' => $data['keyword']]);
                } else if ($data['searchType'] == 'model') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['ModelName' => $data['keyword']]);
                } else if ($data['searchType'] == 'tester') {
                    $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles(['Tester' => $data['keyword']]);
                }

                echo json_encode($data);

            } else if ($data['type'] == 'dispatch') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['dispatchDetails'] = $this->vehicleModel->dispatchDetails(['ChassisNo' => $data['keyword']]);
                } else if ($data['searchType'] == 'model') {
                    $data['dispatchDetails'] = $this->vehicleModel->dispatchDetails(['ModelName' => $data['keyword']]);
                } else if ($data['searchType'] == 'showroom') {
                    $data['dispatchDetails'] = $this->vehicleModel->dispatchDetails(['showRoomName' => $data['keyword']]);
                }

                echo json_encode($data);

            }

        }
    }



    /* Search Related */

    // Function to Dispatch a Vehicle
    public function dispatch() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo']),
                'showroom' => trim($_POST['showroom'])
            ];

            if($this->vehicleModel->dispatch($data['chassisNo'], $data['showroom'])) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }

}