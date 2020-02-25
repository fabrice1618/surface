<?php

class OccupationEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'une occupation");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Mettez à jour votre occupation de salle");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("edit.php"));
        $this->setPageLink("/occupation");
        $this->setPageContent($this->readTemplate("occupation_edit.php"));
    }

}
