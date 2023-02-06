<?php

class Supervisors extends controller
{








    private $supervisorModel;

    public function __construct()
    {
        $this->supervisorModel = $this->model('Supervisor');
    }





    public function settings() {

        if(!isLoggedIn()){
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_SESSION['_id'],
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'mobile' => trim($_POST['mobile']),
                'nic' => trim($_POST['nic'])
            ];

            if (isset($_FILES['image'])) {

                $profile = strval($data['nic']) . '.jpg';
                $to = '../public/images/profile/' . $profile;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->supervisorModel->updateProfile($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            }

        } else {
            $data['url'] = getUrl();
            $data['userDetails'] = $this->supervisorModel->userDetails($_SESSION['_id']);
            $this->view('supervisor/profile/editprofile', $data);
        }
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

        redirect('Supervisors/dashboard');
    }

    public function logout()
    {
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('Supervisors/login');
    }

    public function dashboard()
    {

        if (!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['count'] = $this->supervisorModel->dashdetails();

            $this->view('supervisor/landing/dashboard', $data);
        }
    }



    public function linevehicleview()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }

    public function PAQrecord()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/pdi/defectsheet', $data);
        }
    }

    public function taskSchedule()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/scheduler/scheduletasks', $data);
        }
    }


    // public function consumableview()
    // {
    //     if(!isLoggedIn()) {
    //         redirect('Supervisors/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $this->view('supervisor/consumables/consumablelist');
    //     }
    // }



    public function consumableview()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['consumableset'] = $this->supervisorModel->ViewAllConsumables();
            // echo "\n\n\n\n\n";
            // print_r($data);
            $this->view('supervisor/consumables/consumablelist', $data);
        }
    }

    // public function toolview()
    // {
    //     if(!isLoggedIn()) {
    //         redirect('Supervisors/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $data['url'] = getUrl();
    //         $data['consumableset'] = $this->supervisorModel->ViewAllConsumables();
    //         // echo "\n\n\n\n\n";
    //         // print_r($data);
    //         $this->view('supervisor/consumables/consumablelist', $data);
    //     }
    // }

    public function pdiresults()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            // $data['consumableset'] = $this->supervisorModel->ViewAllConsumables();
            // echo "\n\n\n\n\n";
            // print_r($data);
            $this->view('supervisor/pdi/pdiresults', $data);
        }
    }





    public function vehicleview()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/inspection/vehiclelist', $data);
        }
    }

    public function lineVehicles()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/parts/linevehiclelist', $data);
        }
    }

    public function componentsView()
    {
        if(!isLoggedIn()) {
            redirect('Supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/parts/vehicleparts', $data);
        }
    }

    // public function addleave()
    // {

    //     if (!isLoggedIn()) {
    //         redirect('supervisors/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'employeeId' => trim($_POST['employeeId']),
    //             'leavedate' => trim($_POST['leavedate']),
    //             'reason' => trim($_POST['reason'])
    //         ];

    //         if ($this->supervisorModel->checkEmployee($data['employeeId'])) {

    //             if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

    //                 $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';

    //                 $data['url'] = getUrl();
    //                 $this->view('supervisor/addleave', $data);

    //             } else {

    //                 if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
    //                     $_SESSION['return_message'] = 'New record saved!';
    //                 } else {
    //                     $_SESSION['return_message'] = 'Error! record saving failed!';
    //                 }

    //                 redirect('supervisors/leaves');
    //             }

    //         } else {

    //             $_SESSION['return_message'] = 'Oops! An employee with employee Id '.$data["employeeId"].' could not be found';

    //             $data['url'] = getUrl();
    //             $this->view('supervisor/addleave', $data);

    //         }
    //     } else {
    //         $data['url'] = getUrl();
    //         $this->view('supervisor/addleave', $data);
    //     }
    // }



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

            if ($this->supervisorModel->checkEmployee($data['employeeId'])) {

                if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

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

                        if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                            $_SESSION['return_message'] = 'New record saved!';
                        } else {
                            $_SESSION['return_message'] = 'Error! record saving failed!';
                        }

                        redirect('supervisor/leaves/leaves');
                    }
                }

            } else {

                $_SESSION['return_message'] = 'Oops! An employee with employee Id '.$data["employeeId"].' could not be found';

                $data['url'] = getUrl();
                $this->view('supervisor/leaves/addleave', $data);

            }
        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/leaves/addleave', $data);
        }
    }




    public function leaves()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
            // echo "-------------";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LeaveDetails'] = $this->supervisorModel->ViewLeaves();
            // echo "------00-----";
            // print_r($data);
            $this->view('supervisor/leaves/leaves', $data);
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

            $this->view('supervisor/leaves/editleave', $data);

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

            if ($this->supervisorModel->checkEmployee($data['employeeId'])) {

                if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                    $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';
                    $data['url'] = getUrl();
                    $this->view('supervisor/leaves/editleave', $data);

                } else {



                    $ldate=strtotime($data['leavedate']);
                    $diff=ceil(($ldate-time())/60/60/24);

                    if ($diff <= 1) {

                        $_SESSION['return_message'] = 'Please enter a valid date! ';
    
                        $data['url'] = getUrl();
                        $this->view('supervisor/leaves/editleave', $data);
    
                    } else {

                        if ($this->supervisorModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leaveId'])) {
                            $_SESSION['return_message'] = 'Changes saved!';
                        } else {
                            $_SESSION['return_message'] = 'Error! Could not save changes..';
                        }
    
                        redirect('supervisors/leaves/leaves');
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
                $this->view('supervisor/leaves/editleave', $data);
            }
        } else {
            $data['url'] = getUrl();
            $this->view('supervisor/leaves/editleave', $data);
        }
    }






    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function removeleave()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'LeaveID' => trim($_POST['leave_id'])
            ];

            if ($this->supervisorModel->checkLeaveByID($data['LeaveID'])) {

                if ($this->supervisorModel->removeleave($data['LeaveID'])) {
                    $_SESSION['return_message'] = 'New record saved!';
                    // $_SESSION['success_msg'] = 'New record saved!';
                } else {
                    $_SESSION['return_message'] = 'Error! record saving failed!';
                    // $_SESSION['err_msg'] = 'Error! record saving failed!';
                }

                redirect('supervisor/leaves/leaves');

            } else {

                    $_SESSION['return_message'] = 'Record has been already deleted!';
                    // $_SESSION['err_msg'] = 'Record has been already deleted!';
    
                    $data['url'] = getUrl();
                    $this->view('supervisor/leaves/leaves', $data);
    
                    
            }

        } else {
            
            $_SESSION['return_message'] = 'Request failed!';
            // $_SESSION['err_msg'] = 'Request failed!';

            redirect('supervisor/leaves/leaves');

            // $data['url'] = getUrl();
            // $this->view('supervisor/leaves/leaves', $data);
        }

    }
    
    
    
    
    public function removeleave2()
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

            redirect('supervisors/leaves/leaves');
        }
    }
    // NO CONFIRMATION INCLUDED ////////////////////////////////////////////////////////////////////////////////////////////////////


    public function viewComponents()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('Supervisor/parts/componentlist', $data);
        }
    }




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



    public function S4vehicles()
    {

        if (!isLoggedIn()) {
            redirect('supervisors/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['S4Details'] = $this->supervisorModel->ViewS4Vehicles();
            $this->view('supervisor/inspection/vehiclelist', $data);
        }
    }


}