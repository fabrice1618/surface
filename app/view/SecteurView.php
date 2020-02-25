<?php

class SecteurView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste des secteurs");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste de vos secteurs");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/secteur-add");
        $this->setPageContent($this->readTemplate("secteur.php"));
    }

}
