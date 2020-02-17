<?php

class LogementView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Vos logements - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Liste de vos logements" );
        $this->setFooterTemplate( "footer.html" );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("logement.html") );
    }

}
