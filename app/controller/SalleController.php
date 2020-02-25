<?php

class SalleController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/salle':
                $this->view = new SalleView();
                break;
            case '/salle-edit':
                $this->view = new SalleEditView();
                break;
            case '/salle-delete':
                $this->view = new SalleView();
                break;
            case '/salle-add':
                $this->view = new SalleEditView();
                break;
            case '/salle-save':
                $this->view = new SalleView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}