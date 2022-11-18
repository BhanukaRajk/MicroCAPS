<?php

class Supervisors extends controller {

    private $supervisorModel;

    public function __construct(){
        $this->supervisorModel = $this->model('Supervisor');
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

            if(!$this->supervisorModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->supervisorModel->login($data['username'],$data['password']);

                if( $loggedUser ) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('supervisor/index', $data);
                }

            } else {
                $this->view('supervisor/index', $data);
            }

        }  else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('supervisor/index',$data);
        }

    }

    public function createUserSession($user){
        $_SESSION['_id'] = $user->EmployeeID;
        $_SESSION['_firstname'] = $user->Firstname;
        $_SESSION['_lastname'] = $user->Lastname;
        redirect('supervisors/dashboard');
    }

    public function logout(){
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('supervisors/login');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/dashboard',$data);
        }
    }

    public function addleave() {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'employeeId' => trim($_POST['employeeId']),
                'leavedate' => trim($_POST['leavedate']),
                'reason' => trim($_POST['reason'])
            ];

            if($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                $_SESSION['addleave_Message'] = 'Successful';
            } else {
                $_SESSION['addleave_Message'] = 'Error';
            }

            redirect('supervisors/leaves');
        }
        else {
            $data['url'] = getUrl();
            $this->view('supervisor/addleave', $data);
        }
    }


    public function leaves() {

        if(!isLoggedIn()){
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LeaveDetails'] = $this->supervisorModel->ViewLeaves();
            $this->view('supervisor/leaves', $data);
        }
    }
}