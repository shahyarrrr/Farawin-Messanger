<?php

class Chatscreen extends Controller {
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
        $this->view('chatscreen/index');
    }
}