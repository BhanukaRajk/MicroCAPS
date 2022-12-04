<?php

class Supervisors extends controller
{

    private $supervisorModel;

    public function __construct()
    {
        $this->supervisorModel = $this->model('Supervisor');
    }

    public function login()
    {

        /* Post */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            if (!$this->supervisorModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->supervisorModel->login($data['username'], $data['password']);

                if ($loggedUser) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('supervisor/index', $data);
                }
            } else {
                $this->view('supervisor/index', $data);
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('supervisor/index', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['_id'] = $user->EmployeeID;
        $_SESSION['_firstname'] = $user->Firstname;
        $_SESSION['_lastname'] = $user->Lastname;
        $_SESSION['return_message'] = '';    

        redirect('supervisors/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('supervisors/login');
    }

    public function dashboard()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['count'] = $this->supervisorModel->dashdetails();

            $this->view('supervisor/dashboard', $data);
        }
    }

    public function addleave()
    {

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

            if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                $_SESSION['return_message'] = 'New record saved!';
            } else {
                $_SESSION['return_message'] = 'Error! record saving failed!';
            }

            redirect('supervisors/leaves');
        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/addleave', $data);
        }
    }


    public function leaves()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LeaveDetails'] = $this->supervisorModel->ViewLeaves();
            // echo "-------------";
            //print_r($data);
            $this->view('supervisor/leaves', $data);
        }

    }

    public function editleave()
    {   

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //     $data['url'] = getUrl();
        //     $data['EditorDetails'] = $this->supervisorModel->SendEditLeave();
        //     $EMPLOYEE = $data['EmployeeId'];
        //     $LDATE = $data['LeaveDate'];

        //     $this->view('supervisor/editleave', $data);
        // }

        if (isset($_GET['id'])) {
            $key = $_GET['id'];

            $data['url'] = getUrl();
            $data['EditorDetails'] = $this->supervisorModel->SendEditLeave($key);

            // $EMPLOYEE = $data['EmployeeId'];
            // $LDATE = $data['LeaveDate'];

            $this->view('supervisor/editleave', $data);

        // if (isset($_GET['id']) && isset($GET_['ldate'])) {
        //     $id = $_GET['id'];
        //     $ldate = $_GET['ldate'];

            //echo "ttttttttttttt".$id."gggggggg".$ldate."uuuuuuuu";

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        //     $_GET = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // $data = [
            //     'employeeId' => trim($_GET['EmployeeId']),
            //     'leavedate' => trim($_GET['LeaveDate'])
            // ];

            // if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'])) {
            // if ($this->supervisorModel->removeleave($id, $ldate)) {
            // if ($this->supervisorModel->removeleave($key)) {
            //     $_SESSION['removeleave_Message'] = 'Successful';
            // } else {
            //     $_SESSION['removeleave_Message'] = 'Error';
            // }
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'leave_id' => trim($_POST['leaveId']),
                'employeeId' => trim($_POST['employeeId']),
                'leavedate' => trim($_POST['leavedate']),
                'reason' => trim($_POST['reason'])
            ];

            if ($this->supervisorModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leave_id'])) {
                $_SESSION['return_message'] = 'Changes saved!';
            } else {
                $_SESSION['return_message'] = 'Error! Could not save changes..';
            }

            redirect('supervisors/leaves');

        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/editleave', $data);
        }

    }






    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function removeleave()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if (isset($_GET['id'])) {
            $key = $_GET['id'];

        // if (isset($_GET['id']) && isset($GET_['ldate'])) {
        //     $id = $_GET['id'];
        //     $ldate = $_GET['ldate'];

            //echo "ttttttttttttt".$id."gggggggg".$ldate."uuuuuuuu";

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        //     $_GET = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // $data = [
            //     'employeeId' => trim($_GET['EmployeeId']),
            //     'leavedate' => trim($_GET['LeaveDate'])
            // ];

            // if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'])) {
            // if ($this->supervisorModel->removeleave($id, $ldate)) {
            if ($this->supervisorModel->removeleave($key)) {
                $_SESSION['return_message'] = 'Record deletion success!';
            } else {
                $_SESSION['return_message'] = 'Error! Could not delete record..';
            }

            redirect('supervisors/leaves');
        }
    }
    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////







    public function editprofile()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['ProfileDetails'] = $this->supervisorModel->viewProfile($_SESSION['_id']);
            $this->view('supervisor/editprofile', $data);

        }
    }




    public function scheduletasks()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/scheduletasks', $data);
        }
    }
}
