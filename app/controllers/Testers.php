<?php

class Testers extends controller
{

    private $testerModel;

    private $vehicleModel;

    public function __construct()
    {
        $this->testerModel = $this->model('Tester');
        $this->vehicleModel = $this->model('Vehicle');
    }

    public function Sum($data, $str): int
    {
        $sum = 0;
        if (empty($data)) {
            return $sum;
        }
        foreach ($data as $value) {
            $sum += $value->$str;
        }
        return $sum;
    }


    // FOR DASHBOARD

    public function dashboard()
    {

        if (!isLoggedIn()) {
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['vehicles'] = $this->testerModel->vehiclesReadyToTest();
            $data['counts'] = $this->testerModel->vehicleCount();
            $data['activityLogs'] = $this->testerModel->activityLogs();
            $this->view('tester/dashboard', $data);
        }
    }


    // FOR DEFECT SHEET & ADD DEFECT

    public function defect_sheet($chassisno)
    {

        if (!isLoggedIn()) {
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $data['id'] = $chassisno;
            $data['defects'] = $this->testerModel->viewDefectSheets($chassisno);
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($chassisno);

            $data['DefectNo'] = '';
            $data['RepairDescription'] = '';
            $data['InspectionDate'] = '';
            $data['ChassisNo'] = '';
            $data['EmployeeID'] = '';
            $data['ReCorrection'] = '';

            $data['url'] = getUrl();

            $this->view('tester/defect_sheet', $data);
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'DefectNo' => trim($_POST['DefectNo']),
                'RepairDescription' => trim($_POST['RepairDescription']),
                'InspectionDate' => trim($_POST['InspectionDate']),
                'ChassisNo' => trim($_POST['ChassisNo']),
                'EmployeeID' => trim($_POST['EmployeeID']),
                'ReCorrection' => trim($_POST['ReCorrection']),
                'defect_err' => '',
                'defect_id_err' => '',
                'user_err' => '',
                'date_err' => ''
            ];
            $data['url'] = getUrl();

            $date_1 = date_create($data['InspectionDate']);
            $date_2 = date_create(date('Y-m-d'));
            $diff = date_diff($date_1, $date_2);

            $str_diff = $diff->format('%R%a');


            if ($this->testerModel->findDefectExists($data['DefectNo'], $data['ChassisNo'])) {
                $data['defect_err'] = 'Defect Already Recorded';
                echo 'defectexists';
            }
            
            if (intval($str_diff) > 7) {
                $data['date_err'] = 'Invalid Date';
                echo 'olderdate';
            } else if (intval($str_diff) < 0) {
                $data['date_err'] = 'Invalid Date';
                echo 'futuredate';
            } else if ($data['InspectionDate'] == "") {
                $data['date_err'] = 'Invalid Date';
                echo 'invaliddate';
            }

            if ($data['DefectNo'] == ""){
                $data['defect_err'] = 'Defect No. is Required';
                echo 'emptydefectno';
            }

            if ($data['RepairDescription'] == ""){
                $data['defect_err'] = 'Repair Description is Required';
                echo 'emptydefectdesc';
            }

            if (empty($data['defect_err']) && empty($data['date_err'])) {
                if ($this->testerModel->addDefect($data)) {
                    echo 'Successful';
                } else {
                    echo 'Error';
                }
            }
        }
    }


    // FOR EDIT DEFECT

    public function edit_defect($chassisno, $defectno)
    {

        if (!isLoggedIn()) {
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'DefectNo' => $defectno,
                'RepairDescription' => trim($_POST['RepairDescription']),
                'InspectionDate' => trim($_POST['InspectionDate']),
                'ChassisNo' => $chassisno,
                'EmployeeID' => trim($_POST['EmployeeID']),
                'ReCorrection' => trim($_POST['ReCorrection']),
                'defect_err' => '',
                'chassis_err' => '',
                'user_err' => ''
            ];
            $data['url'] = getUrl();
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($chassisno);

            $date_1 = date_create($data['InspectionDate']);
            $date_2 = date_create(date('Y-m-d'));
            $diff = date_diff($date_1, $date_2);

            $str_diff = $diff->format('%R%a');


            if (intval($str_diff) > 7) {
                $data['date_err'] = 'Invalid Date';
                echo 'olderdate';
            } else if (intval($str_diff) < 0) {
                $data['date_err'] = 'Invalid Date';
                echo 'futuredate';
            } else if ($data['InspectionDate'] == "") {
                $data['date_err'] = 'Invalid Date';
                echo 'invaliddate';
            }

            if ($data['RepairDescription'] == ""){
                $data['defect_err'] = 'Repair Description is Required';
                echo 'emptydefectdesc';
            }

            if (empty($data['date_err']) && empty($data['defect_err'])) {
                if ($this->testerModel->editDefect($data)) {
                    echo 'Successful';
                } else {
                    echo 'Error';
                }
            }
        } else {

            $defect = $this->testerModel->getDefect($chassisno, $defectno);

            $data = [
                'DefectNo' => $defectno,
                'RepairDescription' => $defect->RepairDescription,
                'InspectionDate' => $defect->InspectionDate,
                'ChassisNo' => $chassisno,
                'EmployeeID' => $defect->EmployeeId,
                'ReCorrection' => $defect->ReCorrection
            ];
            $data['url'] = getUrl();
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($chassisno);

            $this->view('tester/edit_defect', $data);
        }
    }


    // FOR DELETE DEFECT

    public function delete_defect($chassisno, $DefectNo)
    {
        if (!isLoggedIn()) {
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            if ($this->testerModel->deleteDefect($chassisno, $DefectNo)) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        } else {
            echo 'Error';
        }
    }


    // FOR VIEW PDI CHECKLIST

    public function pdi($chassisno)
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($chassisno);
            $data['pdiCheckCategories'] = $this->testerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->testerModel->pdiCheckList($chassisno);
            $data['id'] = $chassisno;
            $data['defects'] = $this->testerModel->viewDefectSheets($chassisno);
            $data['completeStatus'] = true;

            foreach ($data['pdiCheckList'] as $pdiCheck) {
                if ($pdiCheck->Result != 'OK') {
                    $data['completeStatus'] = false;
                    break;
                }
            }

            $this->view('tester/pdi', $data);
        }
    }


    // FOR VIEW PDI RESULTS

    public function pdiresults($chassisno)
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['pdiVehicle'] = $this->testerModel->pdiVehicle($chassisno);
            $data['pdiCheckCategories'] = $this->testerModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->testerModel->pdiCheckList($chassisno);
            $data['id'] = $chassisno;
            $data['defects'] = $this->testerModel->viewDefectSheets($chassisno);
            $this->view('tester/pdiresults', $data);
        }
    }


    // FOR ADD PDI CHECKLIST

    public function addPDI()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo']),
                'CheckId' => trim($_POST['CheckId']),
                'Result' => trim($_POST['Result'])
            ];

            $result = $this->testerModel->addPDI($data['ChassisNo'], $data['CheckId'], $data['Result']);

            if ($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }


    // FOR SELECT ALL PDI CHECKLIST

    public function selectAllPDI()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo']),
                'CategoryId' => trim($_POST['CategoryId']),
                'Result' => trim($_POST['Result'])
            ];

            $result = $this->testerModel->selectAllPDI($data['ChassisNo'], $data['CategoryId'], $data['Result']);

            if ($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }


    // FOR PROFILE SETTINGS

    public function settings()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
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
                    if ($this->testerModel->updateProfile($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }
            } else {
                if ($this->testerModel->updateProfileValues($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic']))
                    echo 'Successful';
                else
                    echo 'Error';
            }
        } else {
            $data['userDetails'] = $this->testerModel->userDetails($_SESSION['_id']);
            $this->view('tester/settings', $data);
        }
    }


    // FOR FIND PDI VEHICLES

    public function selectpdi()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->testerModel->vehiclesReadyToTest();
            $this->view('tester/selectpdi', $data);
        }
    }


    // FOR VIEW VEHCILES ADDED BY TESTER

    public function mytasks($id)
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->testerModel->PDIVehiclesByTester($id);
            $this->view('tester/mytasks', $data);
        }
    }


    // FOR ADD A VEHICLE TO TASKS

    public function taskmanager()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->testerModel->vehiclesReadyToTest();
            $data['testers'] = $this->testerModel->getTesterNames();
            $this->view('tester/taskmanager', $data);
        }
    }


    // FOR ADD A VEHICLE TO TASKS

    public function addTask()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo']),
                'TesterId' => trim($_POST['TesterId'])
            ];

            $result = $this->testerModel->addTask($data['ChassisNo'], $data['TesterId']);

            if ($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }


    // FOR REMOVE A VEHICLE FROM TASKS

    public function removeTask()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo'])
            ];

            $result = $this->testerModel->removeTask($data['ChassisNo']);

            if ($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }


    // FOR MARK A VEHICLE AS COMPLETED

    public function completeTask()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ChassisNo' => trim($_POST['ChassisNo']),
                'pdi_err' => '',
                'defect_err' => ''
            ];

            if ($this->testerModel->notCompletedPDI($data['ChassisNo'])) {
                $data['pdi_err'] = 'PDI not completed';
                echo 'pdinotcompleted';
            } else if ($this->testerModel->notCompletedDefect($data['ChassisNo'])) {
                $data['defect_err'] = 'Defects not completed';
                echo 'defectnotcompleted';
            }
            

            if (empty($data['defect_err']) && empty($data['pdi_err'])) {
                if ($this->testerModel->completeTask($data['ChassisNo'])) {
                    echo 'Successful';
                } else {
                    echo 'Error';
                }
            }
        }
    }


    // FOR SEARCH A VEHICLE IN PDI LIST

    public function searchPDI(){
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'keyword' => trim($_POST['keyword']),
            ];

            $data['onPDIVehicles'] = $this->testerModel->searchVehiclesReadyToTest($data['keyword']);

            echo json_encode($data);
        }

    }


     // FOR SEARCH A VEHICLE IN TASK MANAGER

     public function searchTaskM(){
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'keyword' => trim($_POST['keyword']),
            ];

            $data['onPDIVehicles'] = $this->testerModel->searchVehiclesReadyToTest($data['keyword']);
            $data['testers'] = $this->testerModel->getTesterNames();

            echo json_encode($data);
        }

    }


    // FOR SEARCH A VEHICLE IN MY TASKS

    public function searchTask(){
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'keyword' => trim($_POST['keyword']),
                'id' => trim($_POST['id'])
            ];

            $data['onPDIVehicles'] = $this->testerModel->searchVehiclesByTester($data['id'] ,$data['keyword']);

            echo json_encode($data);
        }

    }


    // FOR VIEW VEHCILE ASSEMBLY DETAILS

    public function assembly($chassisNo = null, $stage = null) {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($chassisNo == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $data['assemblyDetails'] = $this->testerModel->assemblyDetails();
                $data['holdStage'] = array();

                if ($data['assemblyDetails']) {
                    foreach ($data['assemblyDetails'] as $value) {
                        $data['holdStage'][] = $this->vehicleModel->holdStage($value->ChassisNo);
                    }
                }
                $this->view('tester/assembly', $data);
            }
        } else if ($stage == null) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                $data = [
                    'ChassisNo' => $chassisNo,
                    'overall' => [
                        'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending'), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold'), "Weight")),
                        'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed'), "Weight"))
                    ],
                    'stage01' => [
                        'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending', 'S1'), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold', 'S1'), "Weight")),
                        'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed', 'S1'), "Weight"))
                    ],
                    'stage02' => [
                        'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending', 'S2'), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold', 'S2'), "Weight")),
                        'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed', 'S2'), "Weight"))
                    ],
                    'stage03' => [
                        'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending', 'S3'), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold', 'S3'), "Weight")),
                        'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed', 'S3'), "Weight"))
                    ],
                    'stage04' => [
                        'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending', 'S4'), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold', 'S4'), "Weight")),
                        'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed', 'S4'), "Weight"))
                    ],
                    'assemblyDetails' => $this->testerModel->assemblyDetails()
                ];
                $this->view('tester/progress',$data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                $data = [
                    'ChassisNo' => $chassisNo,
                    'stage' => $stage
                ];

                $stageId = '';

                if ($stage == 'stageone')
                    $stageId = 'S1';
                else if ($stage == 'stagetwo')
                    $stageId = 'S2';
                else if ($stage == 'stagethree')
                    $stageId = 'S3';
                else if ($stage == 'stagefour')
                    $stageId = 'S4';

                $data['stageSum'] = [
                    'pending' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'Pending', $stageId), "Weight") + $this->Sum($this->testerModel->getProcessStatus($chassisNo, 'OnHold', $stageId), "Weight")),
                    'completed' => json_encode($this->Sum($this->testerModel->getProcessStatus($chassisNo, 'completed', $stageId), "Weight"))
                ];
                $data['stageDetails'] = [
                    'pending' => $this->testerModel->getProcessStatus($chassisNo, 'Pending', $stageId),
                    'completed' => $this->testerModel->getProcessStatus($chassisNo, 'completed', $stageId),
                    'hold' => $this->testerModel->getProcessStatus($chassisNo, 'OnHold', $stageId)
                ];

                $this->view('tester/'.$stage, $data);
            }
        }



    }

    // Search Related
    public function searchByKey() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'keyword' => trim($_POST['keyword']),
                'searchType' => trim($_POST['searchType']),
                'type' => trim($_POST['type'])
            ];

            if ($data['type'] == 'assembly') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['assemblyDetails'] = $this->testerModel->assemblyDetails($data['keyword']);
                } else if ($data['searchType'] == 'model') {
                    $data['assemblyDetails'] = $this->testerModel->assemblyDetailsByModel($data['keyword']);
                }

                $data['holdStage'] = array();

                if ($data['assemblyDetails']) {
                    foreach ($data['assemblyDetails'] as $value) {
                        $data['holdStage'][] = $this->vehicleModel->holdStage($value->ChassisNo);
                    }
                }

                echo json_encode($data);

            } else if ($data['type'] == 'pdi') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles(['ChassisNo' => $data['keyword']]);
                } else if ($data['searchType'] == 'model') {
                    $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles(['ModelName' => $data['keyword']]);
                } else if ($data['searchType'] == 'tester') {
                    $data['onPDIVehicles'] = $this->testerModel->onPDIVehicles(['Tester' => $data['keyword']]);
                }

                echo json_encode($data);

            } else if ($data['type'] == 'dispatch') {

                if ($data['searchType'] == 'chassisNo') {
                    $data['dispatchDetails'] = $this->testerModel->dispatchDetails(['ChassisNo' => $data['keyword']]);
                } else if ($data['searchType'] == 'model') {
                    $data['dispatchDetails'] = $this->testerModel->dispatchDetails(['ModelName' => $data['keyword']]);
                } else if ($data['searchType'] == 'showroom') {
                    $data['dispatchDetails'] = $this->testerModel->dispatchDetails(['showRoomName' => $data['keyword']]);
                }

                echo json_encode($data);

            }

        }
    }
}
