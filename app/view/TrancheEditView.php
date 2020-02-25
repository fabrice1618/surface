<?php

class TrancheEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'une tranche horaire");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Mettez à jour votre tranche horaire");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("edit.php"));
        $this->setPageLink("/tranche");
        $this->setPageContent($this->readTemplate("tranche_edit.php"));
    }

}
