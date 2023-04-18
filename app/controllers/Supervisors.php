<?php

class Supervisors extends controller
{

    private $supervisorModel;




    public function __construct()
    {
        $this->supervisorModel = $this->model('Supervisor');
    }



    public function updateProgress()
    {
    }
    public function recordSpecialTaskList()
    {
    }
    public function recordLeaves()
    {
    }
    public function recordIssuedComponents()
    {
    }
    public function recordComponentDefects()
    {
    }
    public function scheduleFutureTasks()
    {
    }
    public function assignForFutureTasks()
    {
    }
    public function toolsView()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['toolset'] = $this->supervisorModel->ViewAllTools();
            $this->view('supervisor/toolset/tools', $data);
        }
    }
    public function updateToolStatus()
    {
    }
    public function recordPAQInspectionResults()
    {
    }



    public function settings()
    {
        // Hello world 

        if (!isLoggedIn()) {
            redirect('Users/login');
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
            } else {
                if ($this->supervisorModel->updateProfileValues($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic']))
                    echo 'Successful';
                else
                    echo 'Error';
            }
        } else {
            $data['userDetails'] = $this->supervisorModel->userDetails($_SESSION['_id']);
            $this->view('supervisor/profile/editprofile', $data);
        }
    }



    public function dashboard()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();

            $data['counts'] = $this->supervisorModel->statusCounters();
            $data['assemblyLine'] = $this->supervisorModel->viewAssemblyLineVehicleNos();
            $data['activities'] = $this->supervisorModel->activityLogs();
            // $data['damagedParts'] = $this->supervisorModel->viewDamagedParts();

            $this->view('supervisor/landing/dashboard', $data);
        }
    }



    public function linevehicleview()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewAssemblyLineVehicles();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }



    public function PAQrecord()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/pdi/defectsheet', $data);
        }
    }



    public function taskSchedule()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/scheduler/scheduletasks', $data);
        }
    }




    public function consumableview()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/inspection/vehiclelist', $data);
        }
    }

    public function testRunQueue()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/pdi/vehiclelist', $data);
        }
    }

    public function lineVehicles()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewAssemblyLineVehicles();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }

    public function componentsView()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/parts/vehicleparts', $data);
        }
    }


    public function addleave()
    {

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

            if ($this->supervisorModel->checkEmployee($data['employeeId'])) {

                if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                    $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';
                    $data['url'] = getUrl();
                    $this->view('supervisor/leaves/addleave', $data);
                } else {

                    $ldate = strtotime($data['leavedate']);
                    $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                    if ($diff <= 1) {

                        $_SESSION['return_message'] = 'Please enter a valid date! ';

                        $data['url'] = getUrl();
                        $this->view('supervisor/leaves/addleave', $data);
                    } else {


                        if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                            $_SESSION['return_message'] = 'Success! New record saved';
                        } else {
                            $_SESSION['return_message'] = 'Error! record saving failed!';
                        }

                        redirect('Supervisors/leaves');
                    }
                }
            } else {


                $_SESSION['return_message'] = 'Oops! An employee with employee Id ' . $data["employeeId"] . ' could not be found';

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
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LeaveDetails'] = $this->supervisorModel->ViewLeaves();
            $this->view('supervisor/leaves/leaves', $data);
        }
    }




    public function updateLeave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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

                $data['EditorDetails'] = $this->supervisorModel->getLeaveByID($data['leaveId']);
                $leave_id = $data['EditorDetails']->LeaveId;


                if ($data['leaveId'] != $leave_id) {
                // if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                    if (($data['employeeId'] == $data['EditorDetails']->EmployeeId) && 
                        ($data['leavedate'] == $data['EditorDetails']->LeaveDate)) {

                        $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';
                        $data['url'] = getUrl();
                        $this->view('supervisor/leaves/editleave', $data);

                    }

                }

                $ldate = strtotime($data['leavedate']);
                $diff = ceil(($ldate - time()) / 60 / 60 / 24);

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

                    redirect('Supervisors/leaves');

                }
                    
            } else {

                $_SESSION['return_message'] = 'Oops! An employee with employee Id ' . $data["employeeId"] . ' could not be found';
                $data['url'] = getUrl();
                $this->view('supervisor/leaves/editleave', $data);

            }

        } else {

                $_SESSION['return_message'] = 'Request failed! :(';
                $data['url'] = getUrl();
                $this->view('supervisor/leaves/editleave', $data);

        }
        
    }






    public function getEditingData()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'leaveId' => trim($_POST['leave_id'])
            ];

            $data['EditorDetails'] = $this->supervisorModel->getLeaveByID($data['leaveId']);

            if ($data['EditorDetails']) {

                $data['url'] = getUrl();
                $this->view('supervisor/leaves/editleave', $data);
            } else {

                $_SESSION['return_message'] = 'Oops! requested leave details could not be found';
                $data['url'] = getUrl();
                $this->view('supervisor/leaves/leaves', $data);
            }
        } else {

            $_SESSION['return_message'] = 'Request failed!';
            $data['url'] = getUrl();
            $this->view('supervisor/leaves/leaves', $data);
        }
    }


    public function editLeave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
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

                $data['EditorDetails'] = $this->supervisorModel->getLeaveByID($data['leaveId']);
                $leave_id = $data['EditorDetails']->LeaveId;


                if (($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) && ($leave_id != $data['leaveId'])) {

                    $_SESSION['return_message'] = 'Current employee already requested a leave on this date!';
                    $data['url'] = getUrl();
                    // $this->view('supervisor/leaves/editleave', $data);

                } else {

                    $ldate = strtotime($data['leavedate']);
                    $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                    if ($diff <= 1) {

                        $_SESSION['return_message'] = 'Please enter a valid date! ';

                        $data['url'] = getUrl();
                        // $this->view('supervisor/leaves/editleave', $data);

                    } else {

                        if ($this->supervisorModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leaveId'])) {
                            $_SESSION['return_message'] = 'Changes saved!';
                        } else {
                            $_SESSION['return_message'] = 'Error! Could not save changes..';
                        }

                        // redirect('Supervisors/leaves');
                    }
                }
            } else {

                $_SESSION['return_message'] = 'Oops! An employee with employee Id ' . $data["employeeId"] . ' could not be found';
                $data['url'] = getUrl();
                // $this->view('supervisor/leaves/editleave', $data);

            }
        } else {

            $data['url'] = getUrl();
            // $this->view('supervisor/leaves/editleave', $data);

        }
    }





    public function removeleave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'LeaveID' => trim($_POST['leave_id'])
            ];

            if ($this->supervisorModel->getLeaveByID($data['LeaveID'])) {

                if ($this->supervisorModel->removeleave($data['LeaveID'])) {
                    $_SESSION['return_message'] = 'Record deletion Success!';
                    // $_SESSION['success_msg'] = 'New record saved!';
                } else {
                    $_SESSION['return_message'] = 'Error! record deletion failed!';
                    // $_SESSION['err_msg'] = 'Error! record saving failed!';
                }
                redirect('Supervisors/leaves');
                // $this->view('supervisor/leaves/leaves', $data);

            } else {

                $_SESSION['return_message'] = 'Record has been already deleted!';
                // $_SESSION['err_msg'] = 'Record has been already deleted!';

                // $data['url'] = getUrl();
                // $this->view('supervisor/leaves/leaves', $data);
                redirect('Supervisors/leaves');
            }
        } else {

            $_SESSION['return_message'] = 'Request failed!';
            // $_SESSION['err_msg'] = 'Request failed!';

            redirect('Supervisors/leaves');

            // $data['url'] = getUrl();
            // $this->view('supervisor/leaves/leaves', $data);
        }
    }




    public function removeleave2()
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

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('Supervisor/parts/componentlist', $data);
        }
    }




    public function editprofile()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['ProfileDetails'] = $this->supervisorModel->viewProfile($_SESSION['_id']);
            $this->view('supervisor/editprofile', $data);
        }
    }




    public function scheduletasks()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/scheduletasks', $data);
        }
    }



    public function S4vehicles()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['S4Details'] = $this->supervisorModel->ViewS4Vehicles();
            $this->view('supervisor/inspection/vehiclelist', $data);
        }
    }
}
