<?php

class LogementEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'un logement - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Mettez à jour votre logement" );
        $this->setFooterTemplate( "footer.html" );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("logement_edit.html") );
    }

}
