<?php

class Supervisors extends controller
{

    private $supervisorModel;

    private $vehicleModel;

    private $consumableModel;


    public function __construct()
    {
        $this->supervisorModel = $this->model('Supervisor');
        $this->vehicleModel = $this->model('Vehicle');
        $this->consumableModel = $this->model('Consumable');
    }



    // SUPERVISOR /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function settings()
    {

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

            $data['assemblyDetails'] = $this->vehicleModel->assemblyDetails(null,'ASC');
            $data['counts'] = $this->supervisorModel->statusCounters();
            $data['assemblyLine'] = $this->supervisorModel->ViewS4Finishers();
            $data['activities'] = $this->supervisorModel->activityLogs();
            $data['damagedParts'] = $this->supervisorModel->viewDamagedParts();

            if ($data['assemblyDetails'] !== false) {
                $chassisNo = $data['assemblyDetails'][0]->ChassisNo;
                $data['overall'] = [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed'), "Weight"))
                ];
            } else {
                $data['overall'] = null;
            }

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



    public function viewVehiclesByStage()
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






























































    // LEAVE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
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

                    $_SESSION['error_message'] = 'Current employee already requested a leave on this date!';
                    $data['url'] = getUrl();
                    // $this->view('supervisor/leaves/addleave', $data);
                    $this->view('supervisor/leaves/leaves', $data);
                } else {

                    $ldate = strtotime($data['leavedate']);
                    $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                    if ($diff <= 1) {

                        $_SESSION['error_message'] = 'Please enter a valid date! ';

                        $data['url'] = getUrl();
                        // $this->view('supervisor/leaves/addleave', $data);
                        $this->view('supervisor/leaves/leaves', $data);
                    } else {


                        if ($this->supervisorModel->addleave($data['employeeId'], $data['leavedate'], $data['reason'])) {
                            $_SESSION['success_message'] = 'Success! New record saved';
                        } else {
                            $_SESSION['error_message'] = 'Error! record saving failed!';
                        }

                        redirect('Supervisors/leaves');
                    }
                }
            } else {


                $_SESSION['error_message'] = 'Oops! An employee with employee Id ' . $data["employeeId"] . ' could not be found';

                $data['url'] = getUrl();
                // $this->view('supervisor/leaves/addleave', $data);
                $this->view('supervisor/leaves/leaves', $data);
            }
        } else {
            $data['url'] = getUrl();
            // $this->view('supervisor/leaves/addleave', $data);
            $this->view('supervisor/leaves/leaves', $data);
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


    public function updateThisLeave()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'leaveId' => trim($_POST['timeoffId']),
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

                        $_SESSION['error_message'] = 'Current employee already requested a leave on this date!';
                        $data['url'] = getUrl();
                        $this->view('supervisor/leaves/editleave', $data);

                    }

                }

                $ldate = strtotime($data['leavedate']);
                $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                if ($diff <= 1) {

                    $_SESSION['error_message'] = 'Please enter a valid date! ';
                    $data['url'] = getUrl();
                    $this->view('supervisor/leaves/editleave', $data);

                } else {

                    if ($this->supervisorModel->EditLeave($data['employeeId'], $data['leavedate'], $data['reason'], $data['leaveId'])) {
                        $_SESSION['success_message'] = 'Changes saved!';
                    } else {
                        $_SESSION['error_message'] = 'Error! Could not save changes..';
                    }

                    redirect('Supervisors/leaves');

                }
                    
            } else {

                $_SESSION['error_message'] = 'Oops! An employee with employee Id ' . $data["employeeId"] . ' could not be found';
                $data['url'] = getUrl();
                $this->view('supervisor/leaves/editleave', $data);

            }

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                $data['url'] = getUrl();
                $this->view('supervisor/leaves/editleave', $data);

        }
        
    }


    // public function getEditingData()
    // {

    //     if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
    //         redirect('Users/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'leaveId' => trim($_POST['leave_id'])
    //         ];

    //         $data['EditorDetails'] = $this->supervisorModel->getLeaveByID($data['leaveId']);

    //         if ($data['EditorDetails']) {

    //             $data['url'] = getUrl();
    //             $this->view('supervisor/leaves/editleave', $data);
    //         } else {

    //             $_SESSION['error_message'] = 'Oops! requested leave details could not be found';
    //             $data['url'] = getUrl();
    //             $this->view('supervisor/leaves/leaves', $data);
    //         }
    //     } else {

    //         $_SESSION['error_message'] = 'Request failed!';
    //         $data['url'] = getUrl();
    //         $this->view('supervisor/leaves/leaves', $data);
    //     }
    // }


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
                    // $_SESSION['return_message'] = 'Record deletion Success!';
                    $_SESSION['success_message'] = 'Record deletion Success!';
                } else {
                    // $_SESSION['return_message'] = 'Error! record deletion failed!';
                    $_SESSION['error_message'] = 'Error! record deletion failed!';
                }
                redirect('Supervisors/leaves');
                // $this->view('supervisor/leaves/leaves', $data);

            } else {

                // $_SESSION['return_message'] = 'Record has been already deleted!';
                $_SESSION['error_message'] = 'Record has been already deleted!';

                // $data['url'] = getUrl();
                // $this->view('supervisor/leaves/leaves', $data);
                redirect('Supervisors/leaves');
            }
        } else {

            // $_SESSION['return_message'] = 'Request failed!';
            $_SESSION['error_message'] = 'Request failed!';

            redirect('Supervisors/leaves');

            // $data['url'] = getUrl();
            // $this->view('supervisor/leaves/leaves', $data);
        }
    }









































































    // SCHEDULE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function recordScheduleStatus()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $car_id = $_POST['car_id'];
            $process_id = $_POST['process_id'];
            $status = $_POST['status'];

            // check before update
            $data['success'] = $this->supervisorModel->recordTaskStatus($car_id, $process_id, $status);
            // echo $data['success'];
            // header('Content-Type: application/json');
            echo json_encode($data['success']);

        } else {
            $_SESSION['error_message'] = 'Request failed! :(';
            $data['url'] = getUrl();
            $data['taskList'] = $this->supervisorModel->ViewTaskSchedule();
            $this->view('supervisor/scheduler/scheduletasks', $data);
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


    public function updateThisTask() {

    }


    public function removeThisTask()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassis_no' => trim($_POST['vehicle_id']),
                'process_no' => trim($_POST['process_id'])
            ];

            if ($this->supervisorModel->checkTaskById($data['chassis_no'], $data['process_no'])) {

                if ($this->supervisorModel->removeTask($data['chassis_no'], $data['process_no'])) {
                    // $_SESSION['return_message'] = 'Record deletion Success!';
                    $_SESSION['success_message'] = 'Record deletion Success!';
                } else {
                    // $_SESSION['return_message'] = 'Error! record deletion failed!';
                    $_SESSION['error_message'] = 'Error! record deletion failed!';
                }
                redirect('Supervisors/taskSchedule');
                // $this->view('supervisor/leaves/leaves', $data);

            } else {

                // $_SESSION['return_message'] = 'Record has been already deleted!';
                $_SESSION['error_message'] = 'Record couldn\'t found!';

                // $data['url'] = getUrl();
                // $this->view('supervisor/leaves/leaves', $data);
                redirect('Supervisors/taskSchedule');
            }

        }
    }








































































    
    // COMPONENT /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function componentsView()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        // FOR FETCHING DATA
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedValue'])) {

            $data['chassis_no'] = $_POST['selectedValue'];

            $data['url'] = getUrl();
            $data['components'] = $this->supervisorModel->viewCarComponents($data['chassis_no']);
            $data['car_selection'] = $this->supervisorModel->viewCarList(['S1','S2','S3','S4']);

            header('Content-Type: application/json');
            echo json_encode(array('carz' => $data['car_selection'], 'componentz' => $data['components'], 'search' => $data['chassis_no']));

        // FOR NORMAL POST REQUESTS
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassis_no' => trim($_POST['form-car-id'])
            ];

            $data['url'] = getUrl();
            $data['components'] = $this->supervisorModel->viewCarComponents($data['chassis_no']);
            $data['car_selection'] = $this->supervisorModel->viewCarList(['S1','S2','S3','S4']);
            $this->view('supervisor/parts/vehicleparts', $data);

            
        }
    }


    // public function componentsView()
    // {
    //     if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
    //         redirect('Users/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'chassis_no' => trim($_POST['form-car-id'])
    //         ];


    //         $selectedValue = $_POST['selectedValue'];

    //         $data['url'] = getUrl();
    //         $data['components'] = $this->supervisorModel->viewCarComponents($data['chassis_no']);
    //         $data['car_selection'] = $this->supervisorModel->viewCarList(['S1','S2','S3','S4']);
    //         $this->view('supervisor/parts/vehicleparts', $data);
    //     }
    // }




    public function viewCarComponent()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['CarComp'] = $this->supervisorModel->viewVehicleList("S2");
            $this->view('supervisor/parts/com_vehicle_list', $data);
        }
    }









































































    // TASK /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addTask()
    {
    }
    public function taskSchedule()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['taskList'] = $this->supervisorModel->ViewTaskSchedule();
            $this->view('supervisor/scheduler/scheduletasks', $data);
        }
    }









































































    // PAQ RESULT SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    // RECORD POST ASSEMBLY QUALITY INSPECTION RESULTS
    public function recordPAQInspectionResults()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['chassis_no']),
                'BrakeBleed' => trim($_POST['brake_bleed']),
                'GearOil' => trim($_POST['gear_oil']),
                'RackEnd' => trim($_POST['rack_end']),
                'ClutchAdjust' => trim($_POST['clutch_adjust']),
                'RearAxel' => trim($_POST['rear_axel_check']),
                'VisualIns' => trim($_POST['visual_inspect']),
                'FinalResult' => trim($_POST['final_result'])
            ];

            if ($this->supervisorModel->checkVehicle($data['ChassisNo'])) {

                if (FALSE) {
                // if ($this->supervisorModel->checkLeaves($data['employeeId'], $data['leavedate'])) {

                //     $_SESSION['error_message'] = 'Current employee already requested a leave on this date!';
                //     $data['url'] = getUrl();
                //     $this->view('supervisor/leaves/addleave', $data);

                } else {

                    if (($data['BrakeBleed'] == 'NA' OR 
                        $data['GearOil'] == 'NA' OR 
                        $data['RackEnd'] == 'NA' OR 
                        $data['ClutchAdjust'] == 'NA' OR 
                        $data['RearAxel'] == 'NA') AND 
                        $data['FinalResult'] == 'Passed')
                    {

                        $_SESSION['error_message'] = 'All criteria must be passed to complete the assembly line!';
                        $data['url'] = getUrl();
                        $this->view('supervisor/inspection/paqrecord', $data);

                    } else {

                        if ($this->supervisorModel->recordPAQ($data['chassis_no'], 
                                                                $data['BrakeBleed'], 
                                                                $data['GearOil'], 
                                                                $data['RackEnd'], 
                                                                $data['ClutchAdjust'], 
                                                                $data['RearAxel'], 
                                                                $data['VisualIns'], 
                                                                $data['FinalResult']))
                        {
                            $_SESSION['success_message'] = 'Success! New record saved';
                        } else {
                            $_SESSION['error_message'] = 'Error! record saving failed!';
                        }
                        redirect('Supervisors/S4vehicles');
                    }
                }

            } else {


                $_SESSION['error_message'] = 'Oops! The vehicle could not be found';

                $data['url'] = getUrl();
                $this->view('supervisor/inspection/paqrecord', $data);
            }
        } else {

            $_SESSION['error_message'] = 'Request failed!';

            $data['url'] = getUrl();
            $this->view('supervisor/inspection/paqrecord', $data);

        }
    
    }



    // GET CAR INFO TO POST ASSEMBLY QUALITY INSPECTION FORM
    public function getCarInfo()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'CarID' => trim($_POST['form-car-id'])
            ];

            if ($this->supervisorModel->checkCarById($data['CarID'], "S4")) {

                if ($this->supervisorModel->createPAQForm($data['CarID'])) {
                    $data['FormCarData'] = $this->supervisorModel->createPAQForm($data['CarID']);
                    $this->view('supervisor/inspection/paq-record', $data);
                } else {
                    $_SESSION['error_message'] = 'Error! Could not get information..';
                }
                    
            } else {
                $_SESSION['error_message'] = 'Oops! The car you are searching could not be found.';
            }

        } else {
                $_SESSION['error_message'] = 'Request failed! :(';
                // $data['url'] = getUrl();
        }

        redirect('Supervisors/testRunQueue');

    }









































































    // PDI RESULT SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    public function testRunQueue()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewVehicleList('S4');
            $this->view('supervisor/inspection/vehiclelist', $data);
            // print_r($data);
        }
    }









































































    // VEHICLE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
























































    // RETURN DEFECT SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function viewDefectSheet()
    {
    }





















































    // UPDATE PROGRESS SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    public function updateProgress()
    {
    }






































































    // CONSUMABLE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function insertConsumablee()
    {


    }


    
    // public function viewConsumables()
    // {
    //     if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
    //         redirect('Users/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $data['url'] = getUrl();
    //         $data['consumableset'] = $this->supervisorModel->ViewAllConsumables();
    //         $this->view('supervisor/consumables/consumablelist', $data);
    //     }
    // }


    public function updateThisConsumable()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ConsumeId' => trim($_POST['formConId']),
                'ConsumeType' => trim($_POST['formConType']),
                'Stock' => trim($_POST['stock'])
            ];

            if ($this->supervisorModel->checkConsumeById($data['ConsumeId'])) {

                if ($this->supervisorModel->updateConsumableQuantity($data['ConsumeId'], $data['Stock'], $data['ConsumeType'])) {
                    $_SESSION['success_message'] = 'Consumable quantity updated!';
                } else {
                    $_SESSION['error_message'] = 'Error! Could not update information..';
                }
                    
            } else {

                $_SESSION['error_message'] = 'Oops! The consumable you are trying to update could not be found.';

            }

            redirect('Supervisors/viewConsumables');

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                // $data['url'] = getUrl();
                redirect('Supervisors/viewConsumables');
                // $this->view('supervisor/consumables/consumablelist', $data);

        }
    }

    public function removeThisConsumable()
    {
    }  









































































    // TOOL ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function insertTool()
    {
    }
    public function viewTools()
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
    public function updateThisTool()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'toolId' => trim($_POST['tool_id_status']),
                'toolStatus' => trim($_POST['tool-status'])
            ];

            if ($this->supervisorModel->checkToolById($data['toolId'])) {

                if ($this->supervisorModel->updateToolStatus($data['toolId'], $data['toolStatus'])) {
                    $_SESSION['success_message'] = 'Tool status updated!';
                } else {
                    $_SESSION['error_message'] = 'Error! Could not update information..';
                }
                    
            } else {
                $_SESSION['error_message'] = 'Oops! The tool you are trying to update could not be found.';
            }

            redirect('Supervisors/viewTools');

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                // $data['url'] = getUrl();
                redirect('Supervisors/viewTools');
                // $this->view('supervisor/consumables/consumablelist', $data);

        }
    }
    public function removeThisTool()
    {
    }
















































    public function pdi($id)
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->supervisorModel->pdiVehicle($id);
            $data['pdiCheckCategories'] = $this->supervisorModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->supervisorModel->pdiCheckList($id);
            $data['id'] = $id;
            $data['defects'] = $this->supervisorModel->viewDefectSheets($id);
            $this->view('tester/pdi', $data);
        }
    }

    public function pdi_results($id)
    {

        echo $id;

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->supervisorModel->pdiVehicle($id);
            $data['pdiCheckCategories'] = $this->supervisorModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->supervisorModel->pdiCheckList($id);
            $data['id'] = $id;
            //$data['defects'] = $this->supervisorModel->viewDefectSheets($id);
            $this->view('supervisor/pdi/pdiresults', $data);
        }
    }


    public function getOverallProgress($chassis_no = null)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['onPDIVehicles'] = $this->supervisorModel->onPDIVehicles();
            $this->view('supervisor/assembling/overall', $data);
        }
    }

    public function pdilinevehicleview()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewVehicleList("S4");
            $this->view('supervisor/pdi/vehiclelist', $data);
        }
    }



    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function getProcess()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = [
                'chassisNo' => trim($_POST['form-car-id']),
                'stage' => trim($_POST['form-car-stage'])
            ];

            // $vehicleTypes = json_decode($_POST['vehicleTypes']);
            // $completeness = $_POST['completeness'];
            // $acceptance = $_POST['acceptance'];

            

            if ($this->supervisorModel->checkCarById($data['chassisNo'], $data['stage'])) {

                $data['url'] = getUrl();
                $data['FormCarData'] = $this->supervisorModel->getProcessData($data['chassisNo'], $data['stage']);

                
                // USED TO DIRECT THE VEHICLES CURRENT ASSEMBLING STAGE
                if($data['stage'] == 'S1') {
                    $this->view('supervisor/assembling/stage-one', $data);
                } elseif($data['stage'] == 'S2') {
                    $this->view('supervisor/assembling/stage-two', $data);
                } elseif($data['stage'] == 'S3') {
                    $this->view('supervisor/assembling/stage-three', $data);
                } elseif($data['stage'] == 'S4') {
                    $this->view('supervisor/assembling/stage-four', $data);
                }
                    
            } else {
                $_SESSION['error_message'] = 'Oops! The car you are searching could not be found.';
            }

        } else {
                $_SESSION['error_message'] = 'Request failed! :(';
                // $data['url'] = getUrl();
        }

            // print_r($data['url']);
            // echo 'Data = '.$data['stage'];
            redirect('Supervisors/linevehicleview');



            // header('Content-Type: application/json');
            // echo json_encode($data['LineCarsSet']);

        
        // else {
        //     $data['url'] = getUrl();
        //     $data['LineCarsSet'] = $this->supervisorModel->viewCars();
        //     $this->view('supervisor/assembling/vehiclelist', $data);
        // }
    }

    public function recordIssuedComponents()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // $vehicleTypes = json_decode($_POST['vehicleTypes']);
            $completeness = $_POST['completeness'];
            $acceptance = $_POST['acceptance'];

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewDamages($completeness, $acceptance);

            header('Content-Type: application/json');
            echo json_encode($data['LineCarsSet']);

        } else {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewCars();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }

    
    public function recordComponentDefects()
    {
    }






























































































    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function findCars()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewCars();
            $this->view('supervisor/assembling/vehiclelist', $data);

        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vehicleTypes = json_decode($_POST['vehicleTypes']);
            $completeness = $_POST['completeness'];
            $acceptance = $_POST['acceptance'];

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewCars($vehicleTypes, $completeness, $acceptance);

            header('Content-Type: application/json');
            echo json_encode($data['LineCarsSet']);

        } else {

            $_SESSION['error_message'] = 'Request failed!';

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewCars();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }



    // CONTROLLER FUNCTION TO VIEW CONSUMABLES + FILTERS (WORKING)
    public function findConsumables()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data['url'] = getUrl();
            $data['consumableset'] = $this->supervisorModel->viewConsumables();
            $this->view('supervisor/consumables/consumablelist', $data);

        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $typeOfConsume = $_POST['typeOfConsume'];
            $stateOfConsume = $_POST['stateOfConsume'];

            $data['url'] = getUrl();
            $data['consumableset'] = $this->supervisorModel->viewConsumables($typeOfConsume, $stateOfConsume);

            header('Content-Type: application/json');
            echo json_encode($data['consumableset']);

        } else {

            $_SESSION['error_message'] = 'Request failed!';

            $data['url'] = getUrl();
            $data['consumableset'] = $this->supervisorModel->viewConsumables();
            $this->view('supervisor/consumables/consumablelist', $data);

        }
    }

    // CONTROLLER FUNCTION TO VIEW TOOLS + FILTERS (WORKING)
    public function findToolz()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $typeOfTool = $_POST['typeOfTool'];
            $stateOfTool = $_POST['stateOfTool'];

            $data['url'] = getUrl();
            $data['toolset'] = $this->supervisorModel->viewToolz($typeOfTool, $stateOfTool);

            header('Content-Type: application/json');
            echo json_encode($data['toolset']);

        } else {
        
        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['toolset'] = $this->supervisorModel->viewToolz();
            $this->view('supervisor/consumables/consumablelist', $data);
        }
    }


    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function searchProcesses()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // $vehicleTypes = json_decode($_POST['vehicleTypes']);
            $search_process = $_POST['searchingTask'];
            $car_no = $_POST['selectedCar'];

            $data['url'] = getUrl();
            $data['CaughtProcesses'] = $this->supervisorModel->findProcessByName($search_process, $car_no);

            header('Content-Type: application/json');
            echo json_encode($data['CaughtProcesses']);

        } else { echo "searchProcesses()"; }
        // else {
        //     $data['url'] = getUrl();
        //     $data['LineCarsSet'] = $this->supervisorModel->viewCars();
        //     $this->view('supervisor/assembling/vehiclelist', $data);
        // }
    }


    public function recordUpdateProcess()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vehicleID = $_POST['vehicleID'];
            $proID = $_POST['proID'];
            $completeness = $_POST['completeness'];
            $holding = $_POST['holding'];

            $data['url'] = getUrl();
            $data['proUpdate'] = $this->supervisorModel->updateProgress($vehicleID, $proID, $completeness, $holding);

            header('Content-Type: application/json');
            echo json_encode($data['proUpdate']);

        } 
        // else {
        //     // $data['url'] = getUrl();
        //     // $data['LineCarsSet'] = $this->supervisorModel->viewCars();
        //     // $this->view('supervisor/assembling/vehiclelist', $data);
        // }
    }


}