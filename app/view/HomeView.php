<?php

class HomeView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Ce site vous permettra de calculer la surface de votre logement et d'envoyer les données à un artisan pour le chiffrage de vos travaux." );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead.html") );

        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menupublic.html") );
        $this->setPageContent( $this->readTemplate("home.html") );
    }
}
