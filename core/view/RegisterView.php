<?php

class RegisterView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Inscription - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Inscription pour obtenir votre espace personnel" );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead_core.html") );

        $this->setPageContent( $this->readTemplate("inscription.html") );
    }

}
