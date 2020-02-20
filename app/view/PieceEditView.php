<?php

class PieceEditView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Vos pièces - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Modifier une piece" );
        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menuconnecte.html") );
        $this->setPageContent( $this->readTemplate("piece_edit.html") );
    }

}
