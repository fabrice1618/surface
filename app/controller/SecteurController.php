<?php

class SecteurController extends Controller
{
    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/secteur':
                $this->view = new SecteurView();
                break;
            case '/secteur-edit':
                $this->view = new SecteurEditView();
                break;
            case '/secteur-delete':
                $this->view = new SecteurView();
                break;
            case '/secteur-add':
                $this->view = new SecteurEditView();
                break;
            case '/secteur-save':
                $this->view = new SecteurView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}