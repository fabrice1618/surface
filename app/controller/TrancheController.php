<?php

class TrancheController extends Controller
{
    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/tranche':
                $this->view = new TrancheView();
                break;
            case '/tranche-edit':
                $this->view = new TrancheEditView();
                break;
            case '/tranche-delete':
                $this->view = new TrancheView();
                break;
            case '/tranche-add':
                $this->view = new TrancheEditView();
                break;
            case '/tranche-save':
                $this->view = new TrancheView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}