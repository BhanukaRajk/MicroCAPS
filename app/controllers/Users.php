<?php

    class Users extends Controller {

        private $userModel;

        public function __construct(){
            $this->userModel = $this->model('User');
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

                if(!$this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Incorrect Username';
                }


                if (empty($data['username_err']) && empty($data['password_err'])) {

                    $loggedUser = $this->userModel->login($data['username'],$data['password']);

                    if( $loggedUser ) {
                        $this->createUserSession($loggedUser);
                    } else {
                        $data['password_err'] = 'Incorrect Password';
                        $this->view('user/index', $data);
                    }

                } else {
                    $this->view('user/index', $data);
                }

            }  else {
                $data = [
                    'username' => '',
                    'password' => '',
                    'username_err' => '',
                    'password_err' => ''
                ];

                $this->view('user/index',$data);
            }

        }

        public function createUserSession($user){
            $_SESSION['_id'] = $user->EmployeeID;
            $_SESSION['_firstname'] = $user->Firstname;
            $_SESSION['_lastname'] = $user->Lastname;
            $_SESSION['_position'] = $user->Position;
            $_SESSION['_profile'] = $user->Image;

            $this->userModel->markActivity($_SESSION['_id']);

            redirect($_SESSION['_position'].'s/dashboard');
        }

        public function search() {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'username_err' => '',
                ];

                if (!$this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Username Not Found ';
                    $this->view('user/search', $data);
                } else {

                    $token = [
                        'username' => $data['username'],
                        'verificationCode' => ''
                    ];

                    $_SESSION['resetPassword'] = $token;
                    redirect('users/authUser');
                }

            } else {

                $data = [
                    'username' => '',
                    'username_err' => ''
                ];

                $this->view('user/search',$data);

            }
        }

        public function authUser() {

            if(empty($_SESSION['resetPassword'])) {
                redirect('users/login');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'vCode' => trim($_POST['vCode']),
                    'vCode_err' => ''
                ];

                if ($data['vCode'] == $_SESSION['resetPassword']['verificationCode']) {
                    unset($_SESSION['resetPassword']['verificationCode']);
                    redirect('users/resetPassword');
                } else {
                    $data['vCode_err'] = 'Incorrect Verification Code';
                    $this->view('user/auth', $data);
                }


            } else {

                $data = [
                    'vCode' => '',
                    'vCode_err' => ''
                ];

                if (empty($_SESSION['resetPassword']['verificationCode'])) {
                    $_SESSION['resetPassword']['verificationCode'] = rand(1000000, 9999999);
                    $body = file_get_contents("../app/views/templates/resetpassword.html", "r");
                    $body = str_replace("-- code --", $_SESSION['resetPassword']['verificationCode'], $body);
                    authCodeEmail($body, $_SESSION['resetPassword']['username']);
                }

                $this->view('user/auth',$data);
            }

        }

        public function resetPassword() {

            if(empty($_SESSION['resetPassword'])) {
                redirect('users/login');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                $data = [
                    'password' => trim($_POST['newPassword']),
                    'password_err' => ''
                ];

                $reset = $this->userModel->resetPassword($_SESSION['resetPassword']['username'], $data['password']);

                if ($reset) {
                    unset($_SESSION['resetPassword']);
                    $_SESSION['resetPassword_Message'] = 'Successful';
                    redirect('users/login');
                } else {
                    die('Error');
                }

            } else {

                $data = [
                    'password' => '',
                    'password_err' => ''
                ];

                $this->view('user/resetpassword',$data);
            }
        }

        public function logout(){
            unset($_SESSION['_id']);
            unset($_SESSION['_email']);
            unset($_SESSION['_name']);
            unset($_SESSION['_position']);
            unset($_SESSION['_profile']);
            session_destroy();
            redirect('users/login');
        }

        public function viewReturnDefectSheet() {

        }

        public function Progress() {

        }

        public function PDIResult() {

        }


    }
    