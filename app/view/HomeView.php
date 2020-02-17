<?php

class HomeView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Ce site vous permettra de calculer la surface de votre logement et d'envoyer les données à un artisan pour le chiffrage de vos travaux." );
        $this->setFooterTemplate( "footer.html" );
        $this->setPageMenu( $this->readTemplate("menupublic.html") );
        $this->setPageContent( $this->readTemplate("content_default.html") );
    }
}
