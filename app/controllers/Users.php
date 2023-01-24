<?php

    class Users extends Controller {

        public function __construct(){

        }

        public function index() {
            $this->view('index');
        }

//        public function login(){
//
//            /* Post */
//            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//
//                $data = [
//                    'username' => trim($_POST['username']),
//                    'password' => trim($_POST['password']),
//                    'username_err' => '',
//                    'password_err' => ''
//                ];
//
//                if(!$this->userModel->findUserByUsername($data['username'])) {
//                    $data['username_err'] = 'Incorrect Username';
//                }
//
//
//                if (empty($data['username_err']) && empty($data['password_err'])) {
//
//                    $loggedUser = $this->userModel->login($data['username'],$data['password']);
//
//                    if( $loggedUser ) {
//                        $_SESSION = $loggedUser;
//                        $this->redirect($loggedUser->Position . 's/dashboard');
//                    } else {
//                        $data['password_err'] = 'Incorrect Password';
//                        $this->view('login/index', $data);
//                    }
//
//                } else {
//                    $this->view('login/index', $data);
//                }
//
//            }  else {
//                $data = [
//                    'username' => '',
//                    'password' => '',
//                    'username_err' => '',
//                    'password_err' => ''
//                ];
//                $this->view('login/index',$data);
//            }
//
//        }
//
//        public function logout() {
//            unset($_SESSION);
//            session_destroy();
//            $this->redirect('users/login');
//        }
//
//        public function viewReturnDefectSheet() {
//
//        }
//
//        public function Progress() {
//
//        }
//
//        public function PDIResult() {
//
//        }


    }