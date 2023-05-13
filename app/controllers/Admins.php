<?php

class Admins extends controller {

    private $adminModel;
    private $vehicleModel;
    private $pdiModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
        $this->vehicleModel = $this->model('Vehicle');
        $this->pdiModel = $this->model('Pdi');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['managerCount'] = $this->adminModel->employeeCount('Manager');
            $data['supervisorCount'] = $this->adminModel->employeeCount("Supervisor");
            $data['testerCount'] = $this->adminModel->employeeCount("Tester");
            $data['assemblerCount'] = $this->adminModel->employeeCount("Assembler");
            $data['assemblyCount'] = $this->adminModel->assemblyCount();
            $data['activityLogs'] = $this->adminModel->activityLogs();
            $this->view('admin/dashboard', $data);
        }
    }

    public function employees($action="",$id="") {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($action == 'add') {
                $data = [
                    'id' => '',
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'nic' => trim($_POST['nic']),
                    'email' => trim($_POST['email']),
                    'telephone' => trim($_POST['telephone']),
                    'position' => trim($_POST['position']),
                    'account' => $_POST['account'] === 'Yes' ? 'Yes' : 'No',
                ];

                $data['id'] = $this->adminModel->getLastId()->id + 1;

                if ($data['id'] < 10)
                    $data['id'] = '000' . strval($data['id']);
                else if ($data['id'] < 100)
                    $data['id'] = '00' . strval($data['id']);
                else
                    $data['id'] = '0' . strval($data['id']);

                if ($this->adminModel->addEmployee($data)) {
                    if ($data['account'] === 'Yes') {
                        if ($this->adminModel->createUser($data)) {
                            echo "Successful";
                        } else {
                            echo "Successful";
                        }
                    }
                } else {
                    echo "Error";/////////meka error ennoni//////////////////////
                }
            }
            else if ($action == 'edit') {
                
                $data = [
                    'id' => $id,
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'nic' => trim($_POST['nic']),
                    'email' => trim($_POST['email']),
                    'telephone' => trim($_POST['telephone']),
                    'position' => trim($_POST['position']),
                ];

                if ($this->adminModel->editEmployee($data)) {
                    echo "Successful";
                } else {
                    echo "Error";
                }
            }
            else if ($action == 'delete') {
                $data = [
                    'id' => trim($_POST['id'])
                ];

                if ($this->adminModel->deleteUser($data['id'])) {
                    echo "Successful";
                } else {
                    echo "Error";
                }
            } else {

                $data = [
                    'manager' => null,
                    'supervisor' => null,
                    'assembler' => null,
                    'tester' => null
                ];

                if (isset($_POST["manager"])){
                    $data["manager"] = trim($_POST["manager"]);
                }
                if (isset($_POST["supervisor"])){
                    $data["supervisor"] = trim($_POST["supervisor"]);
                }
                if (isset($_POST["assembler"])){
                    $data["assembler"] = trim($_POST["assembler"]);
                }
                if (isset($_POST["tester"])){
                    $data["tester"] = trim($_POST["tester"]);
                }
                


                if($data["manager"] != null) {
                    $data['managerDetail'] = $this->adminModel->employeeDetails("Manager");
                } else {
                    $data['managerDetail'] = null;
                }
    
                if($data["supervisor"] != null) {
                    $data['supervisorDetail'] = $this->adminModel->employeeDetails("Supervisor");
                } else {
                    $data['supervisorDetail'] = null;
                }
    
                if($data["assembler"] != null) {
                    $data['assemblerDetail'] = $this->adminModel->employeeDetails("Assembler");
                } else {
                    $data['assemblerDetail'] = null;
                }
    
                if($data["tester"] != null) {
                    $data['testerDetail'] = $this->adminModel->employeeDetails("Tester");
                } else {
                    $data['testerDetail'] = null;
                }
                
                $this->view('admin/employees', $data );
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if ($action == 'add') {
                $this->view('admin/addEmployee');
            }
            else if ($action == 'edit') { 
                $data['employee'] = $this->adminModel->employeeDetailsById($id);
                $this->view('admin/editEmployee',$data);
            }
            /*else if($action == 'delete'){
                $data['managerDetail'] = $this->adminModel->employeeDetails("manager");
                $data['supervisorDetail'] = $this->adminModel->employeeDetails("Supervisor");
                $data['assemblerDetail'] = $this->adminModel->employeeDetails("Assembler");
                $this->view('admin/employees', $data );

            }*/
            else {
                $data['managerDetail'] = $this->adminModel->employeeDetails("manager");
                $data['supervisorDetail'] = $this->adminModel->employeeDetails("Supervisor");
                $data['assemblerDetail'] = $this->adminModel->employeeDetails("Assembler");
                $data['testerDetail'] = $this->adminModel->employeeDetails("Tester");
                $this->view('admin/employees', $data );
            }
        }
    }

    public function assembly($chassisNo = null, $stage = null) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['assemblyDetails'] = $this->vehicleModel->assemblyDetails();
                $data['holdStage'] = array();

                if ($data['assemblyDetails']) {
                    foreach ($data['assemblyDetails'] as $value) {
                        $data['holdStage'][] = $this->vehicleModel->holdStage($value->ChassisNo);
                    }
                }
                $this->view('admin/assembly', $data);
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
                $this->view('admin/progress',$data);
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

                $this->view('admin/'.$stage, $data);
            }
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

            $this->view('admin/'.$data['stage'], $data);
        }
    }

    public function pdi($chassisNo = null) {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles();
                $this->view('admin/pdi', $data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['ChassisNo'] = $chassisNo;
                $data['onPDIVehicles'] = $this->pdiModel->onPDIVehicles();
                $data['onPDIVehicle'] = $this->pdiModel->onPDIVehicles(['chassisNo' => $chassisNo], false);
                $data['pdiCheckCategories'] = $this->pdiModel->pdiCheckCategories();
                $data['pdiCheckList'] = $this->pdiModel->pdiCheckList($chassisNo);
                $this->view('admin/pdidetails',$data);
            }
        }

    }

    public function dispatch() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['dispatchDetails'] = $this->adminModel->dispatchDetails();
            $this->view('admin/dispatch', $data);
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
                'email' => trim($_POST['email'])
            ];

            if (isset($_FILES['image'])) {

                $profile = strval($data['firstname']) . '.jpg';
                $to = '../public/images/profile/' . $profile;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->adminModel->updateProfile($data['id'], $data['firstname'], $data['email'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            } else {
                if ($this->adminModel->updateProfileValues($data['id'], $data['firstname'], $data['email']))
                    echo 'Successful';
                else
                    echo 'Error';
            }

        } else {
            $data['userDetails'] = $this->adminModel->userDetails($_SESSION['_id']);
            $this->view('admin/settings',$data);
        }
    }


}