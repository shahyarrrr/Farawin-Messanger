<?php

class register extends  Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        $this->checkLogin = Model::session_get("username");
        if ($this->checkLogin != FALSE) {
            header("Location:" . URL);
        }
    }

    function index()
    {
        $this->view('register/index');
    }
    function insert_data()
    {
        $check = $this->model->insert_data($_POST);
        if ($check) {
            Model::session_set('username', $_POST['username']);
            $this->view('register/welcome');
        } else {
            $this->view('register/index');
        }
    }
}