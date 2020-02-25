<?php

class ScreenerView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Afficheur");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Ce site vous permettra d'afficher le panneaux d'affichage du Greta, et de modifier les attributions des salles.");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menupublic.php"));
        $this->setPageTemplate($this->readTemplate("public.php"));
        $this->setPageLink("");
        $this->setPageContent($this->readTemplate("afficheur.php"));
    }
}
