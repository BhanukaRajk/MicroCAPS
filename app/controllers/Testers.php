<?php

class Testers extends controller {

    private $testerModel;

    public function __construct(){
        $this->testerModel = $this->model('Tester');
    }

    public function Sum($data, $str) : int {
        $sum = 0;
        if (empty($data)) {
            return $sum;
        }
        foreach ($data as $value) {
            $sum += $value->$str;
        }
        return $sum;
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['vehicles'] = $this->testerModel->selectVehicle();
            $data['counts'] = $this->testerModel->vehicleCount();
            $this->view('tester/dashboard', $data);
        }
    }

    public function defect_sheet($id) {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['id'] = $id;
            $data['defects'] = $this->testerModel->viewDefectSheets($id);
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($id);

            $this->view('tester/defect_sheet', $data);
        }
    }

    public function select_view($id) {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        $data = [
            'ChassisNo' => $id
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('tester/select_view', $data);
        }
    }

    public function add_defect() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'DefectNo' => trim($_POST['DefectNo']),
                'RepairDescription' => trim($_POST['RepairDescription']),
                'InspectionDate' => trim($_POST['InspectionDate']),
                'ChassisNo' => trim($_POST['ChassisNo']),
                'EmployeeID' => trim($_POST['EmployeeID']),
                'ReCorrection' => trim($_POST['ReCorrection']),
                'defect_err' => '',
                'defect_id_err' => '',
                'user_err' => '',
            ];
            $data['url'] = getUrl();
            

            if(!$this->testerModel->findUserByID($data['EmployeeID'])) {
                $data['user_err'] = 'Incorrect Employee ID';
            }
            // else if(!$this->testerModel->findDefectByID($data['DefectNo'])) {
            //     $data['defect_id_err'] = 'Incorrect Defect Number';
            // }
            else if($this->testerModel->findDefectExists($data['DefectNo'], $data['ChassisNo'])) {
                $data['defect_err'] = 'Defect Already Recorded';
            }
            else if(!$this->testerModel->findPDIvehicles($data['ChassisNo'])) {
                $data['chassis_err'] = 'Invalid Chassis Number';
            }

            if(empty($data['user_err']) && empty($data['defect_err']) && empty($data['chassis_err'])){
                if($this->testerModel->addDefect($data)){
                    redirect('testers/defect_sheet/'. $data['ChassisNo']);
                } else {
                    die("Something went wrong");
                }
            } else {
                $this->view('tester/add_defect', $data);
            }
        } else {
            $data = [
                'DefectNo' => '',
                'RepairDescription' => '',
                'InspectionDate' => '',
                'ChassisNo' => '',
                'EmployeeID' => '',
                'ReCorrection' => '',
            ];
            $data['url'] = getUrl();

            $this->view('tester/add_defect', $data);
        }
    }

    public function edit_defect($ChassisNo, $DefectNo) {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'DefectNo' => $DefectNo,
                'RepairDescription' => trim($_POST['RepairDescription']),
                'InspectionDate' => trim($_POST['InspectionDate']),
                'ChassisNo' => $ChassisNo,
                'EmployeeID' => trim($_POST['EmployeeID']),
                'ReCorrection' => trim($_POST['ReCorrection']),
                'defect_err' => '',
                'chassis_err' => '',
                'user_err' => ''
            ];
            $data['url'] = getUrl();
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($ChassisNo);

            if(!$this->testerModel->findUserByID($data['EmployeeID'])) {
                $data['user_err'] = 'Incorrect Employee ID';
            }
            // else if(!$this->testerModel->findDefectByID($data['DefectNo'])) {
            //     $data['defect_id_err'] = 'Incorrect Defect Number';
            // }

            if(empty($data['user_err'])){
                if($this->testerModel->editDefect($data)){
                    redirect('testers/defect_sheet/'.$data['ChassisNo']);
                } else {
                    die("Something went wrong");
                }
            } else {
                $this->view('tester/edit_defect', $data);
            }
        } else {
            
            $defect = $this->testerModel->getDefect($ChassisNo, $DefectNo);

            $data = [
                'DefectNo' => $DefectNo,
                'RepairDescription' => $defect->RepairDescription,
                'InspectionDate' => $defect->InspectionDate,
                'ChassisNo' => $ChassisNo,
                'EmployeeID' => $defect->EmployeeId,
                'ReCorrection' => $defect->ReCorrection
            ];
            $data['url'] = getUrl();
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($ChassisNo);

            $this->view('tester/edit_defect', $data);
        }
    }

    public function delete_defect($ChassisNo, $DefectNo){
        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($this->testerModel->deleteDefect($ChassisNo, $DefectNo)){
                redirect('testers/defect_sheet/'. $ChassisNo);
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('testers/defect_sheet/'. $ChassisNo);
        }
    }

    public function pdi($id) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($id);
            $data['pdiCheckCategories'] = $this->testerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->testerModel->pdiCheckList($id);
            $this->view('tester/pdi',$data);
        }
    }

    public function pdi_results($id) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($id);
            $data['pdiCheckCategories'] = $this->testerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->testerModel->pdiCheckList($id);
            $this->view('tester/pdi_results',$data);
        }
    }

    public function record_pdi($id){
        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['pdi_tests'] = $this->testerModel->viewPDI($id);
            $this->view('tester/record_pdi', $data);
        }
    }

    public function addPDI() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo']),
                'CheckId' => trim($_POST['CheckId']),
                'Status' => trim($_POST['Status'])
            ];

            $result = $this->testerModel->addPDI($data['ChassisNo'], $data['CheckId'], $data['Status']);

            if($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
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
                    if ($this->testerModel->updateProfile($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            } else {
                if ($this->testerModel->updateProfileValues($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic']))
                    echo 'Successful';
                else
                    echo 'Error';
            }

        } else {
            $data['userDetails'] = $this->testerModel->userDetails($_SESSION['_id']);
            $this->view('tester/settings',$data);
        }
    }

    public function assembly() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['assemblyDetails'] = $this->testerModel->assemblyDetails();
            $this->view('tester/assembly', $data);
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
                    'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold'), "Weight")),
                    'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected'), "Weight"))
                ],
                'stage01' => [
                    'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                    'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected', 'S1'), "Weight"))
                ],
                'stage02' => [
                    'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                    'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected', 'S2'), "Weight"))
                ],
                'stage03' => [
                    'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                    'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected', 'S3'), "Weight"))
                ],
                'stage04' => [
                    'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
                    'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected', 'S4'), "Weight"))
                ],
                'assemblyDetails' => $this->testerModel->assemblyDetails()
            ];
            $this->view('tester/progress',$data);
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
                'pending' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Pending', $stage), "Weight") + $this->Sum($this->testerModel->getComponentStatus($chassisNo, 'OnHold', $stage), "Weight")),
                'connected' => json_encode($this->Sum($this->testerModel->getComponentStatus($chassisNo, 'Connected', $stage), "Weight"))
            ];
            $data['stageDetails'] = [
                'pending' => $this->testerModel->getComponentStatus($chassisNo, 'Pending', $stage),
                'connected' => $this->testerModel->getComponentStatus($chassisNo, 'Connected', $stage),
                'hold' => $this->testerModel->getComponentStatus($chassisNo, 'OnHold', $stage)
            ];

            $this->view('tester/'.$data['stage'], $data);
        }
    }

    // public function selectpdi($chassisNo) {

    //     if(!isLoggedIn()){
    //         redirect('users/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $data['ChassisNo'] = $chassisNo;
    //         $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles();
    //         $data['onPDIVehicle'] = $this->testerModel->shellDetail($chassisNo);
    //         $data['pdiCheckCategories'] = $this->testerModel->pdiCheckCategories();
    //         $data['pdiCheckList'] = $this->testerModel->pdiCheckList($chassisNo);
    //         $this->view('manager/pdidetails',$data);
    //     }
    // }

    public function selectpdi()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles();
            $this->view('tester/selectpdi', $data);
        }
    }

    public function selectdefect()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles();
            $this->view('tester/selectdefect', $data);
        }
    }

}