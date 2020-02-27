<?php

class HttpErrorView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Erreur - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Page d'erreur" );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead_core.html") );

    }

    public function render()
    {
        // Preparation du rendu
        // Preparation du message alerte
        $sHttpError = $this->getData( 'http_error' );
        if ( empty($sHttpError)) {
            $sHttpError = '000';
        }
        // Preparation contenu de la page
        $this->setPageContent( sprintf( $this->readTemplate("http_error.html"), $sHttpError ) );

        // Effectuer le rendu final
        parent::render();
    }

}
