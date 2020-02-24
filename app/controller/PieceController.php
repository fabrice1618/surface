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
                $this->exitDone();
                break;

            case 'piece-edit':
                $this->view = new PieceEditView();
                $this->view->render();
                $this->exitDone();
                break;
    
            case 'piece-delete':
                // Enregistrement des donnes
                
                $this->exitRedirect('/piece');
                break;

            case 'piece-add':
                $this->view = new PieceEditView();
                $this->view->render();
                $this->exitDone();
                break;
            
            case 'piece-save':
                // Enregistrement des donnes
                
                $this->exitRedirect('/piece');
                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }



}
