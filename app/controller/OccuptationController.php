<?php

class OccupaionController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/occupation':
                $this->view = new OccupationView();
                break;
            case '/occupation-edit':
                $this->view = new OccupationEditView();
                break;
            case '/occupation-delete':
                $this->view = new OccupationView();
                break;
            case '/occupation-add':
                $this->view = new OccupationEditView();
                break;
            case '/occupation-save':
                $this->view = new OccupationView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}