<?php

class LogementView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Vos logements - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Liste de vos logements" );
        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("logement.html") );
    }

}
