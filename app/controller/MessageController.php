<?php

class MessageController extends Controller
{
    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/message':
                $this->view = new MessageView();
                break;
            case '/message-edit':
                $this->view = new MessageEditView();
                break;
            case '/message-delete':
                $this->view = new MessageView();
                break;
            case '/message-add':
                $this->view = new MessageEditView();
                break;
            case '/message-save':
                $this->view = new MessageView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}