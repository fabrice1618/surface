<?php

class EcoView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Eco-Conception Surface");
        $this->setPageKeywords( "Ecologie, Développement Durable, Eco-Conception, CO², CO2" );
        $this->setPageDescription( "http://www.cupcakeipsum.com/" );
        $this->setHtmlHeadContent( $this->readTemplate("htmlhead.html") );

        $this->setFooterContent( $this->readTemplate("footer.html") );
        $this->setPageMenu( $this->readTemplate("menupublic.html") );
        $this->setPageContent( $this->readTemplate("ecoconception.html") );
    }
}
