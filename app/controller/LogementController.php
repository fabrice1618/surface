<?php

class LogementController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'logement':
                $this->view = new LogementView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;

            case 'logement-edit':
                $this->view = new LogementEditView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;
    
            case 'logement-delete':
                // Enregistrement des donnes
                
                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/logement';
                $this->http_response_code = 200;
                break;

            case 'logement-add':
                $this->view = new LogementEditView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;
            
            case 'logement-save':
                // Enregiqtrement des donnes
                
                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/logement';
                $this->http_response_code = 200;

                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }

}
