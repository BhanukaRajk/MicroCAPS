<?php

class Admins extends controller {

    private $adminModel;
    private $vehicleModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
        $this->vehicleModel = $this->model('Vehicle');
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

    public function assembly() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['assemblyDetails'] = $this->adminModel->assemblyDetails();
            $this->view('admin/assembly', $data);
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
                'assemblyDetails' => $this->adminModel->assemblyDetails()
            ];
            $this->view('admin/progress',$data);
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

    public function pdi() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->adminModel->onPDIVehicles();
            $data['pdiCheckCategories'] = $this->adminModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->adminModel->pdiCheckList($data['onPDIVehicles'][0]->ChassisNo);
            $this->view('admin/pdi',$data);
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