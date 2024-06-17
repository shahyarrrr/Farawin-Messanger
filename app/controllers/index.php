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

    function addcontact() {
        $result = $this->model->addcontact($_POST);
        echo $result;
    }

    function getcontact() {
        $result = $this->model->getcontact();
        echo $result;
    }

    function editcontact() {
        $result = $this->model->editcontact($_POST);
        echo $result;
    }

    function chatContainer() {
        $result = $this->model->chatContainer($_GET);
        echo $result;
    }

    function sendMessage() {
        $result = $this->model->sendMessage($_POST);
        echo $result;
    }

    function refreshChat() {
        $result = $this->model->refreshChat($_GET);
        echo $result;
    }
}