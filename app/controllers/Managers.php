<?php

class Managers extends Controller {

    private $managerModel;
    private $vehicleModel;
    private $pdiModel;

    public function __construct(){
        $this->managerModel = $this->model('Manager');
        $this->vehicleModel = $this->model('Vehicle');
        $this->pdiModel = $this->model('PDI');
    }

    // Page : Dashboard
    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'assemblyDetails' => $this->vehicleModel->assemblyDetails(null,'ASC'),
                'onAssembly' => $this->vehicleModel->vehicleCount('S1','S2','S3','S4'),
                'onHold' => $this->vehicleModel->vehicleCount('%H'),
                'dispatched' => $this->vehicleModel->vehicleCount('D'),
                'activityLogs' => $this->managerModel->activityLogs()
            ];

            if ($data['assemblyDetails'] !== false) {
                $chassisNo = $data['assemblyDetails'][0]->ChassisNo;
                $data['overall'] = [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed'), "Weight"))
                ];
            } else {
                $data['overall'] = null;
            }

            $data['onHoldComponents'] = $this->vehicleModel->componentQty('D');

            $this->view('manager/dashboard', $data);
        }
    }

    // Page : Body Shell
    public function bodyshell() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['shellDetails'] = $this->vehicleModel->shellDetails();
            $data['repairDetails'] = $this->vehicleModel->repairDetails();
            $data['paintDetails'] = $this->vehicleModel->paintDetails();
            $this->view('manager/bodyshell', $data);
        }
    }

    // Page : Component
    public function component() {

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
                    'M0001' => $this->vehicleModel->getComponentDetails('M0001'),
                    'M0002' => $this->vehicleModel->getComponentDetails('M0002'),
                    'M0003' => $this->vehicleModel->getComponentDetails('M0003')
                ]
            ];

            if (generateMRF($_POST, $data['components'])) {
                echo 'Successful';
            } else {
                echo 'Error';
            }

        } else {

            $data['chassis'] = $this->vehicleModel->componentChassis();
            if ($data['chassis'] !== false)
                $data['components'] = $this->vehicleModel->componentsReceived($data['chassis'][0]->ChassisNo);

            $this->view('manager/component',$data);
        }

    }

    // Page : Assembly Process
    public function assembly($chassisNo = null, $stage = null) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['assemblyDetails'] = $this->vehicleModel->assemblyDetails();
                $data['holdStage'] = array();

                foreach ($data['assemblyDetails'] as $value) {
                    $data['holdStage'][] = $this->vehicleModel->holdStage($value->ChassisNo);
                }

                $this->view('manager/assembly', $data);
            }
        } else if ($stage == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                $data = [
                    'ChassisNo' => $chassisNo,
                    'overall' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed'), "Weight"))
                    ],
                    'stage01' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S1'), "Weight"))
                    ],
                    'stage02' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S2'), "Weight"))
                    ],
                    'stage03' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S3'), "Weight"))
                    ],
                    'stage04' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S4'), "Weight"))
                    ],
                    'assemblyDetails' => $this->vehicleModel->assemblyDetails()
                ];
                $this->view('manager/progress',$data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                $data = [
                    'ChassisNo' => $chassisNo,
                    'stage' => $stage
                ];

                $stageId = '';

                if ($stage == 'stageone')
                    $stageId = 'S1';
                else if ($stage == 'stagetwo')
                    $stageId = 'S2';
                else if ($stage == 'stagethree')
                    $stageId = 'S3';
                else if ($stage == 'stagefour')
                    $stageId = 'S4';

                $data['stageSum'] = [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', $stageId), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', $stageId), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', $stageId), "Weight"))
                ];
                $data['stageDetails'] = [
                    'pending' => $this->vehicleModel->getProcessStatus($chassisNo, 'Pending', $stageId),
                    'completed' => $this->vehicleModel->getProcessStatus($chassisNo, 'completed', $stageId),
                    'hold' => $this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', $stageId)
                ];

                $this->view('manager/'.$stage, $data);
            }
        }
    }

    // Page : Pre Delivery Inspection Results
    public function pdi($chassisNo = null) {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles();
                $this->view('manager/pdi', $data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['ChassisNo'] = $chassisNo;
                $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles();
                $data['onPDIVehicle'] = $this->pdiModel->onPDIVehicles(['chassisNo' => $chassisNo], false);
                $data['pdiCheckCategories'] = $this->pdiModel->pdiCheckCategories();
                $data['pdiCheckList'] = $this->pdiModel->pdiCheckList($chassisNo);
                $data['defects'] = $this->pdiModel->viewDefectSheets($chassisNo);
                $this->view('manager/pdidetails',$data);
            }
        }

    }

    // Page : Dispatch
    public function dispatch($chassisNo = null) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['toBeDispatched'] = $this->vehicleModel->getVehiclesByStatus('RR', 'C');
                $data['dispatchDetails'] = $this->vehicleModel->dispatchDetails();
                $this->view('manager/dispatch', $data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['vehicle'] = $this->vehicleModel->shellDetail($chassisNo);
                $data['repairDetails'] = $this->vehicleModel->repairDetail($chassisNo);
                $data['paintDetails'] = $this->vehicleModel->paintDetail($chassisNo);
                $data['defects'] = $this->pdiModel->viewDefectSheets($chassisNo);
                $this->view('manager/dispatchdetails',$data);
            }
        }
    }

    // Page : Settings
    public function settings() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if (!checkPosition('Manager')) {
            redirect($_SESSION['_position'] . 's/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_SESSION['_id'],
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'mobile' => trim($_POST['mobile']),
                'nic' => trim($_POST['nic'])
            ];

            if (isset($_FILES['image'])) {

                $profile = strval($data['nic']) . '.jpg';
                $to = '../public/images/profile/' . $profile;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->managerModel->updateProfile($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            } else {
                if ($this->managerModel->updateProfileValues($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic']))
                    echo 'Successful';
                else
                    echo 'Error';
            }

        } else {
            $data['userDetails'] = $this->managerModel->userDetails($_SESSION['_id']);
            $this->view('manager/settings',$data);
        }
    }

}