<?php

class LogementEditView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'un logement - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Mettez à jour votre logement" );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead.html") );

        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("logement_edit.html") );
    }

}
