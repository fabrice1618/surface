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
                $this->exitDone();
                break;

            case 'logement-edit':
                $this->view = new LogementEditView();
                $this->view->render();
                $this->exitDone();
                break;
    
            case 'logement-delete':
                // Enregistrement des donnes
                
                $this->exitRedirect('/logement');
                break;

            case 'logement-add':
                $this->view = new LogementEditView();
                $this->view->render();
                $this->exitDone();
                break;
            
            case 'logement-save':
                // Enregiqtrement des donnes
                
                $this->exitRedirect('/logement');
                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }

}
