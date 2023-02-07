<?php

class Admins extends controller {

    private $adminModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/dashboard', $url );
        }
    }


    public function add() {

        // if(!isLoggedIn()){
        //     redirect('admins/login');
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/add');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/add');
        }
    }

    public function edit() {

        // if(!isLoggedIn()){
        //     redirect('admins/login');
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('admin/edit');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/edit');
        }
    }

    public function viewemployees() {

        // if(!isLoggedIn()){
        //     redirect('admins/login');
        // }

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //     $url = getUrl();
        //     
        //     $this->view('admin/viewemployees',$data);
        // }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $data['managerdetail'] = $this->adminModel->userdetails();
            $data['supervisordetail'] = $this->adminModel->userdetails_2();
            $data['testerdetail'] = $this->adminModel->userdetails_3();
            $this->view('admin/viewemployees',$data);
        }
    }

    public function insertadd() {

        if(!isLoggedIn()){
            redirect('admins/login');
        }

        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //     $url = getUrl();
        //     $this->view('admin/insertadd');
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('admin/insertadd');
        }
    }

}