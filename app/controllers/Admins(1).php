<?php

class Admins extends controller {

    private $adminModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
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

            if(!$this->adminModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->adminModel->login($data['username'],$data['password']);

                if( $loggedUser ) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('admin/index', $data);
                }

            } else {
                $this->view('admin/index', $data);
            }

        }  else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('admin/index',$data);
        }

    }

    public function createUserSession($user){
        $_SESSION['_id'] = 'admin';
        $_SESSION['_username'] = $user->Username;
        redirect('admins/dashboard');
    }

    public function logout(){
        unset($_SESSION['_id']);
        unset($_SESSION['_username']);
        session_destroy();
        redirect('admins/login');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/dash');
        }
    }


    public function add() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/add');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/add');
        }
    }

    public function edit() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/edit');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/edit');
        }
    }

    public function just() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/just');
        }
    }

    public function insertadd() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //     $url = getUrl();
        //     $this->view('admin/insertadd');
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/insertadd');
        }
    }

}