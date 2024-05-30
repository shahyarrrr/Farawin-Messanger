<?php 

class addcontact extends Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view("addcontact/index");
    }

    function add() {
        $this_username = Model::session_get("username");
        $response = $this->model->addcontact($this_username, $_POST);
        echo $response;
    }
}