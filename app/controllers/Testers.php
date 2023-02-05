<?php



class Testers extends controller {

    private $testerModel;

    public function __construct(){
        $this->testerModel = $this->model('Tester');
    }

    public function login(){

        /* Post */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            if(!$this->testerModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->testerModel->login($data['username'],$data['password']);

                if( $loggedUser ) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('tester/index', $data);
                }

            } else {
                $this->view('tester/index', $data);
            }

        }  else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('tester/index',$data);
        }

    }

    public function createUserSession($user){
        $_SESSION['_id'] = $user->EmployeeID;
        $_SESSION['_firstname'] = $user->Firstname;
        $_SESSION['_lastname'] = $user->Lastname;
        redirect('testers/dashboard');
    }

    public function logout(){
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('testers/login');
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

}