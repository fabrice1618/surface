<?php

class HomeController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'home':
                $this->view = new HomeView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }

}
