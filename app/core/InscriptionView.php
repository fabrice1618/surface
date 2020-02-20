<?php

class InscriptionView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Inscription - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Inscription pour obtenir votre espace personnel" );

        $this->setPageContent( $this->readTemplate("inscription.html") );
    }

}
