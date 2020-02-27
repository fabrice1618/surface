<?php

class HttpErrorController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'err404':
                $this->view = new HttpErrorView();
                $this->view->setData( 'http_error', '404' );
                http_response_code(404);
                $this->view->render();
                $this->exitDone();
                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }

}
