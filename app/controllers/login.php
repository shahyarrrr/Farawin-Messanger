<?php

class Login extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        $this->checkLogin = Model::session_get("username");
        // if ($this->checkLogin != FALSE) {
        //     header("Location:" . URL);
        // }
    }

    function index()
    {
        $this->view('login/index');
    }

    function check_data() 
    {
        $login = $this->model->check_data($_POST);
        echo $login;
    }
}
?>