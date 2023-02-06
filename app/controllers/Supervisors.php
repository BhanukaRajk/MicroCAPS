<?php

class Supervisors extends Controller {

    private $supervisorModel;

    public function __construct(){
        $this->supervisorModel = $this->model('Supervisor');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('supervisor/dashboard',$data);
        }
    }
}