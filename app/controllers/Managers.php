<?php

class Managers extends Controller {

    private $managerModel;
    private $vehicleModel;

    public function __construct(){
        $this->managerModel = $this->model('Manager');
        $this->vehicleModel = $this->model('Vehicle');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'assemblyDetails' => $this->managerModel->assemblyDetails('ASC'),
                'onAssembly' => $this->vehicleModel->vehicleCount('S1','S2','S3','S4'),
                'onHold' => $this->vehicleModel->vehicleCount('H'),
                'dispatched' => $this->vehicleModel->vehicleCount('D'),
            ];

            $chassisNo = $data['assemblyDetails'][0]->ChassisNo;

            $data['overall'] = [
                'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending'), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected'), "Weight"))
            ];
            
            $this->view('manager/dashboard', $data);
        }
    }

    public function bodyshell() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['shellDetails'] = $this->managerModel->shellDetails();
            $data['repairDetails'] = $this->managerModel->repairDetails();
            $data['paintDetails'] = $this->managerModel->paintDetails();
            $this->view('manager/bodyshell', $data);
        }
    }

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

            if($this->managerModel->addShell($data['chassisNo'], $data['chassisType'], $data['color'])) {
                if ($data['repair'] === 'Yes') {
                    $this->managerModel->addRepairJob($data['chassisNo'], $data['repairDescription']);
                    $this->managerModel->addPaintJob($data['chassisNo']);
                } else {
                    if ($data['paint'] === 'Yes') {
                        $this->managerModel->addPaintJob($data['chassisNo']);
                    }
                }

                echo 'Successful';

            } else {
                echo 'Error';
            }
        }
    }

    public function RequestJobs() {

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

    public function dispatch() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['dispatchDetails'] = $this->managerModel->dispatchDetails();
            $this->view('manager/dispatch', $data);
        }
    }

    public function settings() {

        if(!isLoggedIn()){
            redirect('users/login');
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

    public function assembly() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['assemblyDetails'] = $this->managerModel->assemblyDetails();
            $this->view('manager/assembly', $data);
        }

    }

    public function progress($chassisNo) {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'ChassisNo' => $chassisNo,
                'overall' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected'), "Weight"))
                ],
                'stage01' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S1'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S1'), "Weight"))
                ],
                'stage02' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S2'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S2'), "Weight"))
                ],
                'stage03' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S3'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S3'), "Weight"))
                ],
                'stage04' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S4'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S4'), "Weight"))
                ],
                'assemblyDetails' => $this->managerModel->assemblyDetails()
            ];
            $this->view('manager/progress',$data);
        }
    }

    public function assemblystage($chassisNo) {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'ChassisNo' => $chassisNo,
                'stage' => trim($_GET['stage'])
            ];

            $stage = '';

            if ($data['stage'] == 'stageone')
                $stage = 'S1';
            else if ($data['stage'] == 'stagetwo')
                $stage = 'S2';
            else if ($data['stage'] == 'stagethree')
                $stage = 'S3';
            else if ($data['stage'] == 'stagefour')
                $stage = 'S4';

            $data['stageSum'] = [
                'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', $stage), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', $stage), "Weight"))
            ];
            $data['stageDetails'] = [
                'pending' => $this->vehicleModel->getComponentStatus($chassisNo, 'Pending', $stage),
                'connected' => $this->vehicleModel->getComponentStatus($chassisNo, 'Connected', $stage)
            ];

            $this->view('manager/'.$data['stage'], $data);
        }
    }

    public function pdi() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->managerModel->onPDIVehicles();
            $data['pdiCheckCategories'] = $this->managerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->managerModel->pdiCheckList($data['onPDIVehicles'][0]->ChassisNo);
            $this->view('manager/pdi',$data);
        }
    }



}