<?php

class FilliereController extends Controller
{
    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/filliere':
                $this->view = new FilliereView();
                break;
            case '/filliere-edit':
                $this->view = new FilliereEditView();
                break;
            case '/filliere-delete':
                $this->view = new FilliereView();
                break;
            case '/filliere-add':
                $this->view = new FilliereEditView();
                break;
            case '/filliere-save':
                $this->view = new FilliereView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}