<?php

class TypeSalleController extends Controller
{
    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;


//        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/typesalle':
                $this->view = new TypeSalleView();
                break;
            case '/typesalle-edit':
                $this->view = new TypeSalleEditView();
                break;
            case '/typesalle-delete':
                $this->view = new TypeSalleView();
                break;
            case '/typesalle-add':
                $this->view = new TypeSalleEditView();
                break;
            case '/typesalle-save':
                $this->view = new TypeSalleView();
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }


}