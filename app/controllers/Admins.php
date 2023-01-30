<?php

class Admins extends Controller {

    private $adminModel;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('admin/dashboard',$data);
        }
    }
}