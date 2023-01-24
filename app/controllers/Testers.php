<?php
class Tester {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findUserByUsername($username) {

        $this->db->query('SELECT * FROM credentials  WHERE credentials.Username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }

    }

    public function login($username,$password) {
        $this->db->query(
            'SELECT credentials.Username, credentials.Password, employee.EmployeeID, employee.Firstname, employee.Lastname, employee.Position
            FROM credentials
            INNER JOIN employee
            ON credentials.EmployeeID = employee.EmployeeId
            WHERE credentials.Username = :username'
        );

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ( $password == $row->Password ) {
            return $row;
        } else {
            return null;
        }
    }

}



class Testers extends controller {

    private $testerModel;

    public function __construct(){
        $this->testerModel = $this->model('Tester');
    }

    public function login(){

        /* Post */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            if(!$this->testerModel->findUserByUsername($data['username'])) {
                $data['username_err'] = 'Incorrect Username';
            }


            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->testerModel->login($data['username'],$data['password']);

                if( $loggedUser ) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Incorrect Password';
                    $this->view('tester/index', $data);
                }

            } else {
                $this->view('tester/index', $data);
            }

        }  else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('tester/index',$data);
        }

    }

    public function createUserSession($user){
        $_SESSION['_id'] = $user->EmployeeID;
        $_SESSION['_firstname'] = $user->Firstname;
        $_SESSION['_lastname'] = $user->Lastname;
        redirect('testers/dashboard');
    }

    public function logout(){
        unset($_SESSION['_id']);
        unset($_SESSION['_email']);
        unset($_SESSION['_name']);
        session_destroy();
        redirect('testers/login');
    }

    public function dashboard() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/dashboard', $url);
        }
    }

    public function defectsheet() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/defectsheet', $url);
        }
    }

    public function defect_sheet() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/defect_sheet', $url);
        }
    }

    public function add_defect() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/add_defect', $url);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('tester/add_defect', $url);
        }
    }

    public function add_defect2() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/add_defect2', $url);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = getUrl();
            $this->view('tester/add_defect2', $url);
        }
    }

    public function select_vehicle() {

        if(!isLoggedIn()){
            redirect('testers/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $url = getUrl();
            $this->view('tester/select_vehicle', $url);
        }
    }

}