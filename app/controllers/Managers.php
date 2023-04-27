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
                'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold'), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected'), "Weight"))
            ];

            $data['onHoldComponents'] = $this->vehicleModel->componentQty('OnHold');
            
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

                if ($this->vehicleModel->addComponentRequest($data['chassisType'], $data['color'])) {
                    echo 'Successful';
                } else {
                    echo 'Error';
                }
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

    public function component() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $array1 = array();
            $array2 = array();
            $array3 = array();
            $type = '';

            foreach ($_POST as $key => $value) {
                if(strpos($key, 'type') !== false) {
                    if ($value === 'M0001') {
                        $array1[] = new stdClass();
                        $array1[count($array1)-1]->ModelNo = $value;
                        $type = 'M0001';
                    } else if ($value === 'M0002') {
                        $array2[] = new stdClass();
                        $array2[count($array2)-1]->ModelNo = $value;
                        $type = 'M0002';
                    } else if ($value === 'M0003') {
                        $array3[] = new stdClass();
                        $array3[count($array3)-1]->ModelNo = $value;
                        $type = 'M0003';
                    }
                }
                if(strpos($key, 'color') !== false) {
                    if ($type === 'M0001') {
                        $array1[count($array1)-1]->Color = $value;
                    } else if ($type === 'M0002') {
                        $array2[count($array2)-1]->Color = $value;
                    } else if ($type === 'M0003') {
                        $array3[count($array3)-1]->Color = $value;
                    }
                }
                if(strpos($key, 'qty') !== false) {
                    if ($type === 'M0001') {
                        $array1[count($array1)-1]->Qty = $value;
                    } else if ($type === 'M0002') {
                        $array2[count($array2)-1]->Qty = $value;
                    } else if ($type === 'M0003') {
                        $array3[count($array3)-1]->Qty = $value;
                    }
                }
            }

            $data = [
                'componentRequestDetails' => [
                    'M0001' => $array1,
                    'M0002' => $array2,
                    'M0003' => $array3
                ],
                'components' => [
                    'M0001' => $this->vehicleModel->getComponentDetails('M0001'),
                    //'M0002' => $this->vehicleModel->getComponentDetails('M0002'),
                    //'M0003' => $this->vehicleModel->getComponentDetails('M0003')
                ]
            ];

//            print_r($data);

//            print_r($_POST);//, $data['componentRequestDetails']['M0001']);
//
            $white = '-';
            $black = '-';
            $red = '-';
            $green = '-';
            $blue = '-';
            $yellow = '-';
            $none = 0;

            foreach ($data['componentRequestDetails']['M0001'] as $value) {
                switch ($value->Color) {
                    case 'White':
                        $white = $value->Qty;
                        break;
                    case 'Black':
                        $black = $value->Qty;
                        break;
                    case 'Red':
                        $red = $value->Qty;
                        break;
                    case 'Green':
                        $green = $value->Qty;
                        break;
                    case 'Blue':
                        $blue = $value->Qty;
                        break;
                    case 'Yellow':
                        $yellow = $value->Qty;
                        break;
                }
                $none = $none + $value->Qty;
            }

            $body = '';
            foreach ($data['components']['M0001'] as $value) {
                $body .= '<tr>';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">1000</td>
                          <td valign="bottom" class="td col-right txt txt-nowrap bold">'.$value->PartName.'</td>';
                $qty = $value->Color != 'None' ? $white : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color != 'None' ? $black : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color != 'None' ? $red : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color != 'None' ? $green : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color != 'None' ? $blue : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color != 'None' ? $yellow : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $qty = $value->Color == 'None' ? $none : '-';
                $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
                $body .= '</tr>';
            }

            $file = file_get_contents(APP_ROOT . '\views\templates\mrf.html');
            $position = strpos($file, '<!-- Date -->');
            if ($position !== false) {
                $file = substr_replace($file, date('Y-m-d'), $position, 0);
            }
            $position = strpos($file, '<!-- Model -->');
            if ($position !== false) {
                $file = substr_replace($file, 'Micro Panda', $position, 0);
            }
            $position = strpos($file, '<!-- Insert Point -->');
            if ($position !== false) {
                $file = substr_replace($file, $body, $position, 0);
            }
            file_put_contents(APP_ROOT . '\views\templates\mrfCreated.html', $file);

            echo 'Successful';

        } else {
            $data['componentRequestDetails'] = $this->vehicleModel->getComponentRequest();
            $this->view('manager/component', $data);
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
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected'), "Weight"))
                ],
                'stage01' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S1'), "Weight"))
                ],
                'stage02' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S2'), "Weight"))
                ],
                'stage03' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                    'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', 'S3'), "Weight"))
                ],
                'stage04' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
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
                'pending' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Pending', $stage), "Weight") + $this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', $stage), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getComponentStatus($chassisNo, 'Connected', $stage), "Weight"))
            ];
            $data['stageDetails'] = [
                'pending' => $this->vehicleModel->getComponentStatus($chassisNo, 'Pending', $stage),
                'connected' => $this->vehicleModel->getComponentStatus($chassisNo, 'Connected', $stage),
                'hold' => $this->vehicleModel->getComponentStatus($chassisNo, 'OnHold', $stage)
            ];

            $this->view('manager/'.$data['stage'], $data);
        }
    }

    public function pdi()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->managerModel->onPDIVehicles();
            $this->view('manager/pdi', $data);
        }
    }

    public function pdidetails($chassisNo) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['ChassisNo'] = $chassisNo;
            $data['onPDIVehicles'] = $this->managerModel->onPDIVehicles();
            $data['onPDIVehicle'] = $this->vehicleModel->shellDetail($chassisNo);
            $data['pdiCheckCategories'] = $this->managerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->managerModel->pdiCheckList($chassisNo);
            $this->view('manager/pdidetails',$data);
        }
    }



}