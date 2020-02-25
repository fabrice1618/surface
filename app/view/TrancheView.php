<?php

class TrancheView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste des tranches horaires");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste de vos tranches horaires");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/tranche-add");
        $this->setPageContent($this->readTemplate("tranche.php"));
    }

}
