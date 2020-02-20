<?php

class PieceController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'piece':
                $this->view = new PieceView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;

            case 'piece-edit':
                $this->view = new PieceEditView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;
    
            case 'piece-delete':
                // Enregistrement des donnes
                
                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/piece';
                $this->http_response_code = 200;
                break;

            case 'piece-add':
                $this->view = new PieceEditView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;
            
            case 'piece-save':
                // Enregistrement des donnes
                
                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/piece';
                $this->http_response_code = 200;

                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }



}
