<?php

class Admins extends controller {

    private $adminModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view('admin/dashboard');
        }
    }

    public function employees() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'id' => trim($_POST['id'])
            ];

            if ($this->adminModel->userDelete($data['id'])) {
                echo "Successful";
            } else {
                echo "Error";
            }

        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['managerDetail'] = $this->adminModel->employeeDetails("manager");
            $data['supervisorDetail'] = $this->adminModel->employeeDetails("Supervisor");
            $data['testerDetail'] = $this->adminModel->employeeDetails("Tester");
            $this->view('admin/employees', $data );
        }
    }

    public function dispatch() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['dispatchDetails'] = $this->adminModel->dispatchDetails();
            $this->view('admin/dispatch', $data);
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
                'email' => trim($_POST['email'])
            ];

            if (isset($_FILES['image'])) {

                $profile = strval($data['firstname']) . '.jpg';
                $to = '../public/images/profile/' . $profile;

                $from = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($from, $to)) {
                    if ($this->adminModel->updateProfile($data['id'], $data['firstname'], $data['email'], $profile))
                        echo 'Successful';
                    else
                        echo 'Error';
                } else {
                    echo 'Error';
                }

            } else {
                if ($this->adminModel->updateProfileValues($data['id'], $data['firstname'], $data['email']))
                    echo 'Successful';
                else
                    echo 'Error';
            }

        } else {
            $data['userDetails'] = $this->adminModel->userDetails($_SESSION['_id']);
            $this->view('admin/settings',$data);
        }
    }

    public function assembly() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view('admin/assembly');
        }
    }

    public function assemblystage($stage) {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view('admin/'.$stage);
        }
    }

    public function pdi() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['onPDIVehicles'] = $this->adminModel->onPDIVehicles();
            $data['pdiCheckCategories'] = $this->adminModel->pdiCheckCategories();
            $data['pdiCheckList'] = $this->adminModel->pdiCheckList($data['onPDIVehicles'][0]->ChassisNo);
            $this->view('admin/pdi',$data);
        }
    }

    public function addEmployee() {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'id' => '',
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'nic' => trim($_POST['nic']),
                'email' => trim($_POST['email']),
                'telephone' => trim($_POST['telephone']),
                'position' => trim($_POST['position']),
                'account' => $_POST['account'] === 'Yes' ? 'Yes' : 'No',
            ];

            $data['id'] = $this->adminModel->getLastId()->id + 1;

            if ($data['id'] < 10)
                $data['id'] = '000' . strval($data['id']);
            else if ($data['id'] < 100)
                $data['id'] = '00' . strval($data['id']);
            else
                $data['id'] = '0' . strval($data['id']);

            if ($this->adminModel->addEmployee($data)) {
                if ($data['account'] === 'Yes') {
                    if ($this->adminModel->createUser($data)) {
                        echo "Successful";
                    } else {
                        echo "Error";
                    }
                }
            } else {
                echo "Error";
            }

        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view('admin/addEmployee');
        }
    }

}