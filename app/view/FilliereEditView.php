<?php

class FilliereEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'une filliere");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Mettez à jour votre fillière");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("edit.php"));
        $this->setPageLink("/filliere");
        $this->setPageContent($this->readTemplate("filliere_edit.php"));
    }

}
