<?php

class Managers extends Controller {

    private $managerModel;

    public function __construct(){
        $this->managerModel = $this->model('Manager');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('manager/dashboard',$data);
        }
    }

    public function bodyshell() {

        if(!isLoggedIn()){
            redirect('users/login');
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
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'suvQty' => trim($_POST['suvQty']),
                'normalQty' => trim($_POST['normalQty']),
            ];
            $body = file_get_contents("../app/views/templates/shellRequest.html", "r");
            $body = str_replace("--suvQty--", $data['suvQty'], $body);
            $body = str_replace("--normalQty--", $data['normalQty'], $body);
            if (sendmail($body)) {
                echo 'Successful';
            } else {
                echo 'Failed';
            }
        }
    }

    public function addShell() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'chassisNo' => trim($_POST['chassisNo']),
                'color' => trim($_POST['color']),
                'chassisType' => trim($_POST['chassisType']),
                'repair' => $_POST['repair'] === 'true' ? 'Yes' : 'No',
                'paint' => $_POST['paint'] === 'true' ? 'Yes' : 'No',
                'repairDescription' => trim($_POST['repairDescription'])
            ];

            if (empty($data['chassisNo']) || empty($data['color']) || empty($data['chassisType'])) {
                echo 'Error';
                return;
            }

            if($this->managerModel->addShell($data['chassisNo'], $data['chassisType'], $data['color'])) {
                if ($data['repair'] === 'Yes') {
                    $this->managerModel->addRepairJob($data['chassisNo'], $data['repairDescription']);
                    $this->managerModel->addPaintJob($data['chassisNo']);
                } else {
                    if ($data['paint'] === 'Yes') {
                        $this->managerModel->addPaintJob($data['chassisNo']);
                    }
                }
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }

    public function jobDone() {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => trim($_POST['id']),
                'job' => trim($_POST['job'])
            ];

            $result = $this->managerModel->jobDone($data['id'], $data['job']);

            if($result) {
                echo 'Successful';
            } else {
                echo 'Error';
            }
        }
    }

    public function settings() {

        if(!isLoggedIn()){
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
                    if ($this->managerModel->updateProfile($data['id'], $data['firstname'], $data['lastname'], $data['email'], $data['mobile'], $data['nic'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            }

        } else {
            $data['url'] = getUrl();
            $data['userDetails'] = $this->managerModel->userDetails($_SESSION['_id']);
            $this->view('manager/settings',$data);
        }
    }

    public function assembly() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('manager/assembly',$data);
        }
    }

    public function test() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('manager/test',$data);
        }
    }


}