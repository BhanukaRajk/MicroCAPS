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
                        $_SESSION['success_message'] = 'Success! Saved Changes';
                    else
                        $_SESSION['error_message'] = 'Error! Could not save changes';
                } else {
                    $_SESSION['error_message'] = 'Error! Could not save changes';
                }
            } else {
                if ($this->supervisorModel->updateProfileValues($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic']))
                    $_SESSION['success_message'] = 'Success! Saved Changes';
                else
                    $_SESSION['error_message'] = 'Error! Could not save changes';
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

    // ASSEMBLY LINE VEHICLES
    public function linevehicleview()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['AssemblyLineCars'] = $this->supervisorModel->viewAssemblyLineVehicles();
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
                    redirect('Supervisors/leaves');
                    // $this->view('supervisor/leaves/leaves', $data);

                } else {

                    $ldate = strtotime($data['leavedate']);
                    $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                    if ($diff <= 1) {

                        $_SESSION['error_message'] = 'Please enter a valid date! ';

                        $data['url'] = getUrl();
                        // $this->view('supervisor/leaves/addleave', $data);
                        // $this->view('supervisor/leaves/leaves', $data);
                        redirect('Supervisors/leaves');

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
                redirect('Supervisors/leaves');
                // $this->view('supervisor/leaves/leaves', $data);
            }

        } else {
            $data['url'] = getUrl();
            // $this->view('supervisor/leaves/addleave', $data);
            redirect('Supervisors/leaves');
            // $this->view('supervisor/leaves/leaves', $data);
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
                    redirect('Supervisors/leaves');
                    // $this->view('supervisor/leaves/editleave', $data);

                    }

                }

                $ldate = strtotime($data['leavedate']);
                $diff = ceil(($ldate - time()) / 60 / 60 / 24);

                if ($diff <= 1) {

                    $_SESSION['error_message'] = 'Please enter a valid date! ';
                    $data['url'] = getUrl();
                    redirect('Supervisors/leaves');
                    // $this->view('supervisor/leaves/editleave', $data);

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
                    redirect('Supervisors/leaves');
                    // $this->view('supervisor/leaves/editleave', $data);

            }

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                $data['url'] = getUrl();
                    redirect('Supervisors/leaves');
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
                    $_SESSION['success_message'] = 'Record deletion Success!';
                } else {
                    $_SESSION['error_message'] = 'Error! record deletion failed!';
                }
                redirect('Supervisors/leaves');

            } else {

                $_SESSION['error_message'] = 'Record has been already deleted!';

                // $data['url'] = getUrl();
                // $this->view('supervisor/leaves/leaves', $data);
                redirect('Supervisors/leaves');
            }
        } else {

            $_SESSION['error_message'] = 'Request failed!';
            redirect('Supervisors/leaves');

        }
    }






    // SCHEDULE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // THIS IS THE FUNCTION USED TO RECORD TASK STATUS (DONE OR NOT ?)
    public function recordScheduleStatus() // WORKING
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $car_id = $_POST['car_id'];
            $process_id = $_POST['process_id'];
            $status = $_POST['status'];

            $data['success'] = $this->supervisorModel->recordTaskStatus($car_id, $process_id, $status);
            // header('Content-Type: application/json');
            echo json_encode($data['success']);

        }
    }

    // THIS IS THE FUNCTION USED TO ASSIGN ASSEMBLER TO A TASK---------------------------------------------------------------------
    public function updateThisTask()
    {
    }

    // TO REMOVE THE REQUESTED TASK
    public function removeThisTask() // WORKING
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
                    $_SESSION['success_message'] = 'Record deletion Success!';
                } else {
                    $_SESSION['error_message'] = 'Error! record deletion failed!';
                }
                redirect('Supervisors/taskSchedule');
                // $this->view('supervisor/leaves/leaves', $data);

            } else {

                $_SESSION['error_message'] = 'Record couldn\'t found!';

                // $this->view('supervisor/leaves/leaves', $data);
                redirect('Supervisors/taskSchedule');
            }

        }
    }

    // TO SCHEDULE NEW TASKS
    public function addTask() // WORKING
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $task = $_POST['task'];
            $car_no = $_POST['selectedCar'];
            $assembler = $_POST['assembler'];

            header('Content-Type: application/json');
            if ($this->supervisorModel->addNewTask($car_no, $task, $assembler)) {
                $_SESSION['success_message'] = 'Task added successfully!';
                echo json_encode(true);
            } else {
                $_SESSION['error_message'] = 'Task couldn\'t be added!';
                echo json_encode(false);
            }

        }

    }

    // TO FIND AND ASSIGN ASSEMBLER FOR THE TASK
    public function searchAssembler() // WORKING
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $task = $_POST['task'];
            $car_no = $_POST['selectedCar'];

            $data['url'] = getUrl();
            $data['Assembler'] = $this->supervisorModel->assemblerForProcess($car_no, $task);

            header('Content-Type: application/json');
            echo json_encode($data['Assembler']);

        }
    }


    public function taskSchedule()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['assemblyDetails'] = $this->vehicleModel->assemblyDetails(null,'ASC');
            $data['taskList'] = $this->supervisorModel->ViewTaskSchedule();
            $this->view('supervisor/scheduler/scheduletasks', $data);
        }
    }









    
    // COMPONENT /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function componentsView() // WORKING
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
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

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


    public function viewCarComponent() // WORKING (WHEN PRESSED MANAGE PARTS)
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['CarComp'] = $this->supervisorModel->viewVehicleList(['S1','S2','S3','S4']);
            $this->view('supervisor/parts/vehiclelist', $data);
        }
    }


    public function recordUpdateComponent()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $car_id = $_POST['vehicle'];
            $part_id = $_POST['part'];
            $status = $_POST['status'];

            $data['part_update'] = $this->supervisorModel->recordComponentDetails($car_id, $part_id, $status);
            echo json_encode($data['part_update']);

        }
    
    }











    // PAQ RESULT SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // RECORD POST ASSEMBLY QUALITY INSPECTION RESULTS
    public function recordPAQInspectionResults()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['chassisNo']),
                'BrakeBleed' => trim($_POST['bbs']),
                'GearOil' => trim($_POST['gos']),
                'RackEnd' => trim($_POST['res']),
                'ClutchAdjust' => trim($_POST['cs']),
                'RearAxel' => trim($_POST['as']),
                'VisualIns' => trim($_POST['visual']),
                'FinalResult' => trim($_POST['final'])
            ];

            if ($this->supervisorModel->recordPAQresults($data['ChassisNo'],
                $data['BrakeBleed'],
                $data['GearOil'],
                $data['RackEnd'],
                $data['ClutchAdjust'],
                $data['RearAxel'],
                $data['VisualIns'],
                $data['FinalResult'],
                $_SESSION['_id'])) {

                if($data['FinalResult'] == "Pass") {

                    $PDIChecks = $this->vehicleModel->getPDIChecklist();

                    foreach ($PDIChecks as $PDIcase) {
                        $this->vehicleModel->sendtoRR($data['ChassisNo'], $PDIcase->CheckId);
                    }

                    if($this->supervisorModel->stageChanger($data['ChassisNo'], "RR")) {
                        $_SESSION['success_message'] = 'Success! Vehicle sent to test run';
                    }

                } else {

                    if($this->supervisorModel->stageChanger($data['ChassisNo'], "PA")) {
                        $_SESSION['success_message'] = 'Success! Vehicle has to be rechecked';
                    }

                }

            } else {

                $_SESSION['error_message'] = 'Error! record saving failed!';

            }

        } else {

            $_SESSION['error_message'] = 'Request failed!';

        }

        redirect('Supervisor/testRunQueue');

    }

    public function recordPAQInspectionResultsUpdate()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['chassisNo']),
                'BrakeBleed' => trim($_POST['bbs']),
                'GearOil' => trim($_POST['gos']),
                'RackEnd' => trim($_POST['res']),
                'ClutchAdjust' => trim($_POST['cs']),
                'RearAxel' => trim($_POST['as']),
                'VisualIns' => trim($_POST['visual']),
                'FinalResult' => trim($_POST['final'])
            ];

            if ($this->supervisorModel->recordPAQresultsUpdate($data['ChassisNo'],
                $data['BrakeBleed'],
                $data['GearOil'],
                $data['RackEnd'],
                $data['ClutchAdjust'],
                $data['RearAxel'],
                $data['VisualIns'],
                $data['FinalResult'],
                $_SESSION['_id'])) {

                if($data['FinalResult'] == "Pass") {

                    $PDIChecks = $this->supervisorModel->getPDIChecklist();

                    foreach ($PDIChecks as $PDIcase) {
                        $this->supervisorModel->sendtoRR($data['ChassisNo'], $PDIcase->CheckId);
                    }

                    if($this->supervisorModel->stageChanger($data['ChassisNo'], "RR")) {
                        $_SESSION['success_message'] = 'Success! Vehicle sent to test run';
                    }

                }

            } else {

                $_SESSION['error_message'] = 'Error! record saving failed!';

            }

        } else {

            $_SESSION['error_message'] = 'Request failed!';

        }

        redirect('Supervisor/testRunQueue');

    }

    // THIS FUNCTION SENDS UPDATING PAQ DATA TO THE MODEL
    public function updatePAQInspectionResults()
    {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['chassis_no']),
                'BrakeBleed' => trim($_POST['brake-bleed-selection']),
                'GearOil' => trim($_POST['gear-oil-selection']),
                'RackEnd' => trim($_POST['rack-end-selection']),
                'ClutchAdjust' => trim($_POST['clutch-selection']),
                'RearAxel' => trim($_POST['axel-selection']),
                'VisualIns' => trim($_POST['visual']),
                'FinalResult' => trim($_POST['final_result'])
            ];

            if ($this->supervisorModel->checkCarById($data['ChassisNo'], 'AC')) {

                if ($this->supervisorModel->updatePAQresults($data['ChassisNo'], 
                                                    $data['BrakeBleed'], 
                                                    $data['GearOil'], 
                                                    $data['RackEnd'], 
                                                    $data['ClutchAdjust'], 
                                                    $data['RearAxel'], 
                                                    $data['VisualIns'], 
                                                    $data['FinalResult'],
                                                    $_SESSION['_id']))
                {
                    if($data['FinalResult'] == "Passed") {
                        $PDIChecks = $this->vehicleModel->getPDIChecklist();
                        
                        foreach ($PDIChecks as $PDIcase) {
                            $this->vehicleModel->sendtoRR($data['chassis_no'], $PDIcase->CheckId);
                        }

                        if($this->supervisorModel->stageChanger($data['chassis_no'], "RR")) {
                            $_SESSION['success_message'] = 'Success! Vehicle sent to test run';
                        }

                    } else {

                        if($this->supervisorModel->stageChanger($data['chassis_no'], "PA")) {
                            $_SESSION['success_message'] = 'Success! Vehicle has to be rechecked';
                        }

                    }

                } else {

                    $_SESSION['error_message'] = 'Error! record saving failed!';
                    
                }

                redirect('Supervisors/testRunQueue');

            } else {

                $_SESSION['error_message'] = 'Oops! The vehicle could not be found';
                redirect('Supervisors/testRunQueue');

                // $data['url'] = getUrl();
                // $this->view('supervisor/inspection/paqrecord', $data);

            }

        } else {

            $_SESSION['error_message'] = 'Request failed!';
            redirect('Supervisors/testRunQueue');

            // $data['url'] = getUrl();
            // $this->view('supervisor/inspection/paqrecord', $data);

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

            // CHECK THAT THE VEHICLE FAILED THE PAQ
            if ($this->supervisorModel->checkCarById($data['CarID'], "PA")) {

                // IF VEHICLE FAILED RETRIEVE OLD DATA FROM DATABASE
                $data['PAQdata'] = $this->supervisorModel->retrievePAQdata($data['CarID']);

                if ($data['PAQdata'] != null) {
                    $this->view('supervisor/inspection/paqupdate', $data);
                } else {
                    $_SESSION['error_message'] = 'Error! Could not get information..';
                }

            // CHECK THE VEHICLE IS NEW TO PAQ TEST
            } else if ($this->supervisorModel->checkCarById($data['CarID'], "AC")) {
                
                // IF IT IS NEW GET THE REQUIRED DATA TO THE FORM
                $data['FormCarData'] = $this->supervisorModel->createPAQForm($data['CarID']);
                
                if ($data['FormCarData'] != null) {
                    $this->view('supervisor/inspection/paq-record', $data);
                } else {
                    $_SESSION['error_message'] = 'Error! Could not get information..';
                }

            } else {
                $_SESSION['error_message'] = 'Oops! The car you are searching could not be found.';
            }

        } else {
                $_SESSION['error_message'] = 'Request failed! :(';
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
            $data['LineCarsSet'] = $this->supervisorModel->viewVehicleList(['AC','PA']);
            $this->view('supervisor/inspection/vehiclelist', $data);
            // print_r($data);
        }
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

    // TEST RUN VEHICLE LIST SHOWS
    public function pdilinevehicleview()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewVehicleList(['RR']);
            $this->view('supervisor/pdi/vehiclelist', $data);
        }
    }



    // RETURN DEFECT SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function viewDefectSheet()
    {
    }













    //ASSEMBLY LINE AND UPDATE PROGRESS SHEET /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function findAssemblyLineCars()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data['url'] = getUrl();
            $data['AssemblyLineCars'] = $this->supervisorModel->viewCarsOnFactory();
            $this->view('supervisor/assembling/vehiclelist', $data);

        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $Models = json_decode($_POST['model_set']);
            $Stages = json_decode($_POST['stage_set']);
            $Progress = $_POST['current_progress'];

            $data['url'] = getUrl();
            $data['AssemblyLineCars'] = $this->supervisorModel->viewCarsOnFactory($Models, $Stages, $Progress);

            header('Content-Type: application/json');
            echo json_encode($data['AssemblyLineCars']);

        } else {

            $_SESSION['error_message'] = 'Request failed!';
            $data['url'] = getUrl();
            $data['AssemblyLineCars'] = $this->supervisorModel->viewCarsOnFactory();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
    }

    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS ON ASSEMBLY LINE FOR PROCESSES AND COMPONENT DETAILS (WORKING)
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

                if ($data['stage'] == 'H') {
                    $data['stage'] = $this->vehicleModel->holdStage($data['chassisNo'])->StageNo;
                }

                $data['FormCarData'] = $this->supervisorModel->getProcessData($data['chassisNo'], $data['stage']);

                
                // USED TO DIRECT THE VEHICLES CURRENT ASSEMBLING STAGE
                if($data['stage'] == 'S1') {
                    $data['stageSum'] = [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending', 'S1'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold', 'S1'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed', 'S1'), "Weight"))
                    ];
                    $this->view('supervisor/assembling/stage-one', $data);
                } elseif($data['stage'] == 'S2') {
                    $data['stageSum'] = [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending', 'S2'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold', 'S2'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed', 'S2'), "Weight"))
                    ];
                    $this->view('supervisor/assembling/stage-two', $data);
                } elseif($data['stage'] == 'S3') {
                    $data['stageSum'] = [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending', 'S3'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold', 'S3'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed', 'S3'), "Weight"))
                    ];
                    $this->view('supervisor/assembling/stage-three', $data);
                } elseif($data['stage'] == 'S4') {
                    $data['stageSum'] = [
                        'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'Pending', 'S4'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'OnHold', 'S4'), "Weight")),
                        'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($data['chassisNo'], 'completed', 'S4'), "Weight"))
                    ];
                    $this->view('supervisor/assembling/stage-four', $data);
                }
                    
            } else {
                $_SESSION['error_message'] = 'Oops! The car you are searching could not be found.';
            }

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                redirect('Supervisors/linevehicleview');
                // $data['url'] = getUrl();
        }

            // print_r($data['url']);
            // echo 'Data = '.$data['stage'];



            // header('Content-Type: application/json');
            // echo json_encode($data['LineCarsSet']);

        
        // else {
        //     $data['url'] = getUrl();
        //     $data['LineCarsSet'] = $this->supervisorModel->viewCars();
        //     $this->view('supervisor/assembling/vehiclelist', $data);
        // }
    }
    
    // public function recordIssuedComponents()
    // {
    //     if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
    //         redirect('Users/login');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $completeness = $_POST['completeness'];
    //         $acceptance = $_POST['acceptance'];

    //         $data['url'] = getUrl();
    //         $data['LineCarsSet'] = $this->supervisorModel->viewDamages($completeness, $acceptance);

    //         header('Content-Type: application/json');
    //         echo json_encode($data['LineCarsSet']);

    //     } else {
    //         $data['url'] = getUrl();
    //         $data['LineCarsSet'] = $this->supervisorModel->viewCars();
    //         $this->view('supervisor/assembling/vehiclelist', $data);
    //     }
    // }


    // TO SEND CAR INTO THE NEXT STAGE
    public function proceed() {

        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = [
                'chassisNo' => trim($_POST['form-car-id']),
                'stage' => trim($_POST['form-car-stage'])
            ];

            if ($this->supervisorModel->updateStage($data['chassisNo'], $data['stage'])) {
                $_SESSION['success_message'] = 'New Stage Started!';
                redirect('Supervisors/getProcess/'.$data['chassisNo'].'/'.$data['stage']);
            } else {
                $_SESSION['error_message'] = 'Oops! Something went wrong.';
            }

            redirect('Supervisors/findAssemblyLineCars');

        }

    }










    // CONSUMABLE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function addNewConsumables() {

        if (!isLoggedIn()) {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'type' => trim($_POST['type']),
                'status' => trim($_POST['status'])
            ];

            if (isset($_FILES['image'])) {

                $profile = strval($data['name']) . '.jpg';
                $to = '../public/images/consumables/' . $profile;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->consumableModel->addConsumable($data['name'], $data['type'], $data['status'], $profile))
                        $_SESSION['success_message'] = 'Success! Saved Changes';
                    else
                        $_SESSION['error_message'] = 'Error! Could not save changes';
                } else {
                    $_SESSION['error_message'] = 'Error! Could not save changes';
                }
            } else {
                $_SESSION['error_message'] = 'Error! Upload an image';
            }

        }

    }


    public function viewConsumables()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['consumableset'] = $this->supervisorModel->ViewAllConsumables();
            $this->view('supervisor/consumables/consumablelist', $data);
        }
    }


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

            if (!$this->supervisorModel->checkConsumeById($data['ConsumeId'])) {

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
    
    public function addNewTools() {

        if (!isLoggedIn()) {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'type' => trim($_POST['type']),
                'quantity' => trim($_POST['quantity']),
                'status' => trim($_POST['status'])
            ];

            if (isset($_FILES['image'])) {

                $toolpic = strval($data['name']) . '.jpg';
                $to = '../public/images/tools/' . $toolpic;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->supervisorModel->addNewTool($data['name'], $data['type'], $data['quantity'], $data['status'], $toolpic))
                        $_SESSION['success_message'] = 'Success! Saved Changes';
                    else
                        $_SESSION['error_message'] = 'Error! Could not save changes';
                } else {
                    $_SESSION['error_message'] = 'Error! Could not save changes';
                }
            } else {
                $_SESSION['error_message'] = 'Error! Upload an image';
            }

        }

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

        } else {

                $_SESSION['error_message'] = 'Request failed! :(';
                // $data['url'] = getUrl();
                // $this->view('supervisor/consumables/consumablelist', $data);

        }
        redirect('Supervisors/viewTools');
    }

    public function removeThisTool()
    {
    }








    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function findPDICars()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewPDICars();
            $this->view('supervisor/assembling/vehiclelist', $data);

        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vehicleTypes = json_decode($_POST['vehicleTypes']);
            $completeness = json_decode($_POST['vehicleTypes']);

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewPDICars($vehicleTypes, $completeness);

            header('Content-Type: application/json');
            echo json_encode($data['LineCarsSet']);

        } else {

            $_SESSION['error_message'] = 'Request failed!';

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewPDICars();
            $this->view('supervisor/assembling/vehiclelist', $data);
        }
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
            // $acceptance = $_POST['acceptance'];

            $data['url'] = getUrl();
            $data['LineCarsSet'] = $this->supervisorModel->viewCars($vehicleTypes, $completeness);

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

            // $data['url'] = getUrl();
            $data['toolset'] = $this->supervisorModel->viewToolz($typeOfTool, $stateOfTool);

            header('Content-Type: application/json');
            echo json_encode($data['toolset']);

        } else {
        
        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['toolset'] = $this->supervisorModel->viewToolz();
            $this->view('supervisor/toolset/tools', $data);
        }
    }


    // CONTROLLER FUNCTION TO VIEW CARS + FILTERS (WORKING)
    public function searchProcesses()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $search_process = $_POST['searchingTask'];
            $car_no = $_POST['selectedCar'];

            $data['url'] = getUrl();
            $data['CaughtProcesses'] = $this->supervisorModel->findProcessByName($search_process, $car_no);

            header('Content-Type: application/json');
            echo json_encode($data['CaughtProcesses']);

        } 
    }


    // THIS IS THE FUNCTION USED TO UPGRADE PROCESS COMPLETION DETAILS
    public function recordUpdateProcess()
    {
        if (!isLoggedIn() || $_SESSION['_position'] != 'Supervisor') {
            redirect('Users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vehicleID = $_POST['vehicleID'];
            $proID = $_POST['proID'];
            $status = $_POST['status'];

            $data['url'] = getUrl();
            $data['proUpdate'] = $this->supervisorModel->updateProgress($vehicleID, $proID, $status);

            if ($status == 'completed' || $status == 'Pending') {
                $data['holdingCars'] = $this->supervisorModel->checkHoldingCars($vehicleID);

                if($data['holdingCars']->holdCounter == 0){

                    $HoldedStage = $this->supervisorModel->stageOfThisProcess($proID);

                    if($HoldedStage != false) {
                        $this->supervisorModel->stageChanger($vehicleID, $HoldedStage->StageNo);
                    }

                }
            } elseif ($status == 'OnHold') {
                $this->supervisorModel->stageChanger($vehicleID, 'H');
            }


            header('Content-Type: application/json');
            echo json_encode($data['proUpdate']);

        } 

    }

    public function overall($chassisNo) {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'ChassisNo' => $chassisNo,
                'overall' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed'), "Weight"))
                ],
                'stage01' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S1'), "Weight"))
                ],
                'stage02' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S2'), "Weight"))
                ],
                'stage03' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S3'), "Weight"))
                ],
                'stage04' => [
                    'pending' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
                    'completed' => json_encode($this->Sum($this->vehicleModel->getProcessStatus($chassisNo, 'completed', 'S4'), "Weight"))
                ],
                'assemblyDetails' => $this->vehicleModel->assemblyDetails()
            ];
            $this->view('supervisor/assembling/overall', $data);
        }


    }


}
