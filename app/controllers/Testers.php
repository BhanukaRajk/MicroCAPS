<?php

class Testers
{
    private $testerModel;

    public function __construct(){
        $this->testerModel = $this->model('Tester');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['url'] = getUrl();
            $this->view('tester/dashboard',$data);
        }
    }
}