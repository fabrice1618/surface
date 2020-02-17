<?php

class LogementController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;

      
//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/logement':
                $this->view = new LogementView();
                break;
            case '/logement-edit':
                $this->view = new LogementEditView();
                break;
            case '/logement-delete':
                $this->view = new LogementView();
                break;
            case '/logement-add':
                $this->view = new LogementEditView();
                break;
            case '/logement-save':
                $this->view = new LogementView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }



}
