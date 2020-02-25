<?php

class OccupationView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste des occupations de salles");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste des occupations de salles");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/occupation-add");
        $this->setPageContent($this->readTemplate("occupation.php"));
    }

}