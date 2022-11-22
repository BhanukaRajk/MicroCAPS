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
            $data['url'] = getUrl();
            $this->view('manager/dashboard',$data);
        }
    }

    public function bodyshell() {

        if(!isLoggedIn()){
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['shellDetails'] = $this->managerModel->shellDetails();
            $data['repairDetails'] = $this->managerModel->repairDetails();
            $data['paintDetails'] = $this->managerModel->paintDetails();
            $this->view('manager/bodyshell', $data);
        }
    }

    public function shellRequest() {

        if (!isLoggedIn()) {
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'suvQty' => trim($_POST['suvQty']),
                'normalQty' => trim($_POST['normalQty']),
            ];
            $body = "<table border='1'>
                        <th>
                            <td>
                                Chassis Type
                            </td>
                            <td>
                                Quantity
                            </td>
                        </th>
                        <tr>
                            <td></td>
                            <td>
                                SUV
                            </td>
                            <td>
                                " . $data['suvQty'] . "
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                Normal
                            </td>
                            <td>
                                " . $data['normalQty'] . "
                            </td>
                        </tr>
                      </table>";
            sendmail($body);
            redirect('managers/bodyshell');
        }
    }

    public function addShell() {

        if (!isLoggedIn()) {
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo']),
                'color' => trim($_POST['color']),
                'chassisType' => trim($_POST['chassisType']),
                'repair' => isset($_POST['repair']) ? trim($_POST['repair']) : 'No',
                'paint' => isset($_POST['paint']) ? trim($_POST['paint']) : 'No'
            ];

            if($this->managerModel->addShell($data['chassisNo'], $data['chassisType'], $data['color'], $data['repair'], $data['paint'])) {
                $_SESSION['addShell_Message'] = 'Successful';
            } else {
                $_SESSION['addShell_Message'] = 'Error';
            }

            redirect('managers/bodyshell');
        }
    }

    public function search() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'username_err' => '',
            ];

            if (!$this->managerModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Username Not Found ';
                $this->view('manager/search', $data);
            } else {

                $token = [
                    'username' => $data['username'],
                    'verificationCode' => ''
                ];

                $_SESSION['resetPassword'] = $token;
                redirect('managers/authUser');
            }

        } else {

            $data = [
                'username' => '',
                'username_err' => ''
            ];

            $this->view('manager/search',$data);

        }
    }

    public function authUser() {

        if(empty($_SESSION['resetPassword'])) {
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'vCode' => trim($_POST['vCode']),
                'vCode_err' => ''
            ];

            if ($data['vCode'] == $_SESSION['resetPassword']['verificationCode']) {
                unset($_SESSION['resetPassword']['verificationCode']);
                redirect('managers/resetPassword');
            } else {
                $data['vCode_err'] = 'Incorrect Verification Code';
                $this->view('manager/auth', $data);
            }


        } else {

            $data = [
                'vCode' => '',
                'vCode_err' => ''
            ];

            if (empty($_SESSION['resetPassword']['verificationCode'])) {
                $_SESSION['resetPassword']['verificationCode'] = rand(1000000, 9999999);
                authCodeEmail($_SESSION['resetPassword']['verificationCode'], $_SESSION['resetPassword']['username']);
            }

            $this->view('manager/auth',$data);
        }

    }

    public function resetPassword() {

        if(empty($_SESSION['resetPassword'])) {
            redirect('managers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'password' => trim($_POST['newPassword']),
                'password_err' => ''
            ];

            $reset = $this->managerModel->resetPassword($_SESSION['resetPassword']['username'], $data['password']);

            if ($reset) {
                unset($_SESSION['resetPassword']);
                $_SESSION['resetPassword_Message'] = 'Successful';
                redirect('managers/login');
            } else {
                die('Error');
            }

        } else {

            $data = [
                'password' => '',
                'password_err' => ''
            ];

            $this->view('manager/resetpassword',$data);
        }
    }

}