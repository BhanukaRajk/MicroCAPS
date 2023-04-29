<?php

class Managers extends Controller {

    private $managerModel;
    private $vehicleModel;

    public function __construct(){
        $this->managerModel = $this->model('Manager');
        $this->vehicleModel = $this->model('Vehicle');
    }

    // Page : Dashboard
    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'assemblyDetails' => $this->managerModel->assemblyDetails(null,'ASC'),
                'onAssembly' => $this->vehicleModel->vehicleCount('S1','S2','S3','S4'),
                'onHold' => $this->vehicleModel->vehicleCount('H'),
                'dispatched' => $this->vehicleModel->vehicleCount('D'),
                'activityLogs' => $this->managerModel->activityLogs()
            ];

            $chassisNo = $data['assemblyDetails'][0]->ChassisNo;

            $data['overall'] = [
                'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected'), "Weight"))
            ];
//
            $data['onHoldComponents'] = $this->vehicleModel->componentQty('Damaged');
            
            $this->view('manager/dashboard', $data);
        }
    }

    // Page : Body Shell
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

    // Page : Component
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
            $this->view('manager/component');
        }
    }

    // Page : Assembly Process
    public function assembly($chassisNo = null, $stage = null) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['assemblyDetails'] = $this->managerModel->assemblyDetails();
                $this->view('manager/assembly', $data);
            }
        } else if ($stage == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                $data = [
                    'ChassisNo' => $chassisNo,
                    'overall' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                        'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected'), "Weight"))
                    ],
                    'stage01' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                        'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected', 'S1'), "Weight"))
                    ],
                    'stage02' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                        'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected', 'S2'), "Weight"))
                    ],
                    'stage03' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                        'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected', 'S3'), "Weight"))
                    ],
                    'stage04' => [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
                        'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected', 'S4'), "Weight"))
                    ],
                    'assemblyDetails' => $this->managerModel->assemblyDetails()
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
                    'connected' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Connected', $stageId), "Weight"))
                ];
                $data['stageDetails'] = [
                    'pending' => $this->vehicleModel->getProcessStatus($chassisNo, 'Pending', $stageId),
                    'connected' => $this->vehicleModel->getProcessStatus($chassisNo, 'Connected', $stageId),
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

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['onPDIVehicles'] = $this->managerModel->onPDIVehicles();
                $this->view('manager/pdi', $data);
            }
        } else {
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

    // Page : Dispatch
    public function dispatch() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['dispatchDetails'] = $this->managerModel->dispatchDetails();
            $this->view('manager/dispatch', $data);
        }
    }

    // Page : Settings
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

}