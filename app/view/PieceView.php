<?php

class PieceView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Vos pièces - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Liste de vos pieces" );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead.html") );

        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("piece.html") );
    }

}
