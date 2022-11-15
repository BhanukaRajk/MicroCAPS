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
            $url = getUrl();
            $this->view('supervisors/dashboard',$url);
        }
    }

    // public function bodyshell() {
    public function home() {

        if(!isLoggedIn()){
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('supervisor/home', $url);
            // $this->view('supervisor/bodyshell', $url);
        }
    }


}