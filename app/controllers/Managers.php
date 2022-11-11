<?php

class Managers extends controller {

    private $managerModel;

    public function __construct(){
        $this->managerModel = $this->model('Manager');
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

            if(!$this->managerModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->managerModel->login($data['username'],$data['password']);

                if( $loggedUser ) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('manager/index', $data);
                }

            } else {
                $this->view('manager/index', $data);
            }

        }  else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('manager/index',$data);
        }

    }

    public function createUserSession($user){
        $_SESSION['_id'] = $user->EmployeeID;
        $_SESSION['_firstname'] = $user->Firstname;
        $_SESSION['_lastname'] = $user->Lastname;
        redirect('managers/dashboard');
    }

    public function logout(){
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('managers/login');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = $this->getUrl();
            $this->view('manager/dashboard',$url);
        }
    }

    public function bodyshell() {

        if(!isLoggedIn()){
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = $this->getUrl();
            $this->view('manager/bodyshell', $url);
        }
    }

    public function getUrl(){

        if(isset($_GET['url'])){

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;

        }

    }

}