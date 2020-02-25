<?php

class SalleEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'une salle");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Mettez à jour votre secteur");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("edit.php"));
        $this->setPageLink("/salle");
        $this->setPageContent($this->readTemplate("salle_edit.php"));
    }

}
