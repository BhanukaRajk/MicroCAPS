<?php



class Testers extends controller {

    private $testerModel;

    public function __construct(){
        $this->testerModel = $this->model('Tester');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['vehicles'] = $this->testerModel->selectVehicle();
            $this->view('tester/dashboard', $data);
        }
    }

    public function defect_sheet($id) {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['defects'] = $this->testerModel->viewDefectSheets($id);
            $this->view('tester/defect_sheet', $data);
        }
    }

    public function select_vehicle() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['vehicles'] = $this->testerModel->selectVehicle();
            $this->view('tester/select_vehicle', $data);
        }
    }

    public function select_vehicle_2() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['vehicles'] = $this->testerModel->selectVehicle();
            $this->view('tester/select_vehicle_2', $data);
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
            else if(!$this->testerModel->findDefectByID($data['DefectNo'])) {
                $data['defect_id_err'] = 'Incorrect Defect Number';
            }
            else if($this->testerModel->findDefectExists($data['DefectNo'], $data['ChassisNo'])) {
                $data['defect_err'] = 'Defect Already Recorded';
            }

            if(empty($data['user_err']) && empty($data['defect_id_err']) && empty($data['defect_err'])){
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
                'InspectionDate' => trim($_POST['InspectionDate']),
                'ChassisNo' => $ChassisNo,
                'EmployeeID' => trim($_POST['EmployeeID']),
                'ReCorrection' => trim($_POST['ReCorrection']),
                'defect_err' => '',
                'defect_id_err' => '',
                'user_err' => ''
            ];
            $data['url'] = getUrl();

            if(!$this->testerModel->findUserByID($data['EmployeeID'])) {
                $data['user_err'] = 'Incorrect Employee ID';
            }
            else if(!$this->testerModel->findDefectByID($data['DefectNo'])) {
                $data['defect_id_err'] = 'Incorrect Defect Number';
            }

            if(empty($data['user_err']) && empty($data['defect_id_err'])){
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
                'InspectionDate' => $defect->InspectionDate,
                'ChassisNo' => $ChassisNo,
                'EmployeeID' => $defect->EmployeeID,
                'ReCorrection' => $defect->ReCorrection
            ];
            $data['url'] = getUrl();

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

    // public function record_pdi($ChassisNo, $CheckId) {

    //     if(!isLoggedIn()){
    //         redirect('testers/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
    //         $data = [
    //             'ChassisNo' => trim($_POST['ChassisNo']),
    //             'CheckId' => trim($_POST['CheckId']),
    //             'Status' => trim($_POST['Status']),
    //             'EmployeeID' => trim($_POST['EmployeeID']),
    //             'user_err' => '',
    //             'chassis_err' => '',
    //             'pdi_err' => ''
    //         ];
    //         $data['url'] = getUrl();

    //         if(!$this->testerModel->findUserByID($data['EmployeeID'])) {
    //             $data['user_err'] = 'Incorrect Employee ID';
    //         }

    //         if(empty($data['user_err']) && empty($data['chassis_err']) && empty($data['pdi_err'])){
    //             if($this->testerModel->recordPDI($data)){
    //                 redirect('testers/dashboard');
    //             } else {
    //                 die("Something went wrong");
    //             }
    //         } else {
    //             $this->view('tester/record_pdi', $data);
    //         }
    //     } else {
    //         $data = [
    //             'ChassisNo' => '',
    //             'CheckId' => '',
    //             'Status' => '',
    //             'EmployeeID' => '',
    //             'user_err' => '',
    //             'chassis_err' => '',
    //             'pdi_err' => ''
    //         ];
    //         $data['url'] = getUrl();

    //         $this->view('tester/record_pdi', $data);
    //     }
    // }

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
                'Status' => trim($_POST['Status']),
                'EmployeeID' => trim($_POST['EmployeeID'])
            ];

            $result = $this->testerModel->addPDI($data);

            if($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }

}