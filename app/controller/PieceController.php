<?php

class PieceController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;

      
//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/piece':
                $this->view = new PieceView();
                break;
            case '/piece-edit':
                $this->view = new PieceEditView();
                break;
            case '/piece-delete':
                $this->view = new PieceView();
                break;
            case '/piece-add':
                $this->view = new PieceEditView();
                break;
            case '/piece-save':
                $this->view = new PieceView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }



}
