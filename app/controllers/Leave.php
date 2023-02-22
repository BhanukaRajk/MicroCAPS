<?php

class Leave extends controller {




    private $leaveModel;

    public function __construct()
    {
        $this->leaveModel = $this->model('Leave');
    }




    public function recordLeave() {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'employeeId' => trim($_POST['employeeId']),
                'leavedate' => trim($_POST['leavedate']),
                'reason' => trim($_POST['reason'])
            ];

            if ($this->leaveModel->checkEmployee($data['employeeId'])) {

                if ($this->leaveModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                    $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';

                    $data['url'] = getUrl();
                    $this->view('supervisor/leaves/addleave', $data);

                } else {

                    $ldate=strtotime($data['leavedate']);
                    $diff=ceil(($ldate-time())/60/60/24);

                    if ($diff <= 1) {

                        $_SESSION['return_message'] = 'Please enter a valid date! ';
    
                        $data['url'] = getUrl();
                        $this->view('supervisor/leaves/addleave', $data);
    
                    } else {

                        if ($this->leaveModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                            $_SESSION['return_message'] = 'New record saved!';
                        } else {
                            $_SESSION['return_message'] = 'Error! record saving failed!';
                        }

                        redirect('supervisors/leaves');
                    }
                }

            } else {

                $_SESSION['return_message'] = 'Oops! An employee with employee Id '.$data["employeeId"].' could not be found';

                $data['url'] = getUrl();
                $this->view('supervisor/addleave', $data);

            }
        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/addleave', $data);
        }

    }




    public function leaves()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LeaveDetails'] = $this->leaveModel->ViewLeaves();
            // echo "-------------";
            //print_r($data);
            $this->view('supervisor/leaves', $data);
        }
    }




    public function editleave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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
            $data['EditorDetails'] = $this->leaveModel->SendEditLeave($key);

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
                'leaveId' => trim($_POST['leaveId']),
                'employeeId' => trim($_POST['employeeId']),
                'leavedate' => trim($_POST['leavedate']),
                'reason' => trim($_POST['reason'])
            ];

            if ($this->leaveModel->checkEmployee($data['employeeId'])) {

                if ($this->leaveModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                    $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';
                    $data['url'] = getUrl();
                    $this->view('supervisor/editleave', $data);

                } else {



                    $ldate=strtotime($data['leavedate']);
                    $diff=ceil(($ldate-time())/60/60/24);

                    if ($diff <= 1) {

                        $_SESSION['return_message'] = 'Please enter a valid date! ';
    
                        $data['url'] = getUrl();
                        $this->view('supervisor/editleave', $data);
    
                    } else {

                        if ($this->leaveModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leaveId'])) {
                            $_SESSION['return_message'] = 'Changes saved!';
                        } else {
                            $_SESSION['return_message'] = 'Error! Could not save changes..';
                        }
    
                        redirect('supervisors/leaves');
                    }



                    // if ($this->supervisorModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leaveId'])) {
                    //     $_SESSION['return_message'] = 'Changes saved!';
                    // } else {
                    //     $_SESSION['return_message'] = 'Error! Could not save changes..';
                    // }

                    // redirect('supervisors/leaves');
                }

            } else {
                $_SESSION['return_message'] = 'Oops! An employee with employee Id '.$data["employeeId"].' could not be found';
                $data['url'] = getUrl();
                $this->view('supervisor/editleave', $data);
            }
        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/editleave', $data);
        }
    }






    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function removeleave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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
            if ($this->leaveModel->removeleave($key)) {
                $_SESSION['return_message'] = 'Record deletion success!';
            } else {
                $_SESSION['return_message'] = 'Error! Could not delete record..';
            }

            redirect('supervisors/leaves');
        }
    }
    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////


}

?>