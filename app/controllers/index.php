<?php

class Index extends Controller
{
    public $checkLogin = '';
    function __construct()
    {
        parent::__construct();
        $this->checkLogin = Model::session_get("username");
        if ($this->checkLogin == false) {
            header("Location:" . URL . "login");
        }
    }

    function index()
    {
    //    $widget = $this->model->getWidget($this->checkLogin);
    //    $data = array('widget' => $widget);

    //    $this->view('index/index', $data);
        $this->view('index/index');
    }

}