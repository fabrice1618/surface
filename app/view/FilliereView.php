<?php

class FilliereView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste des fillière");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste de vos fillières");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/filliere-add");
        $this->setPageContent($this->readTemplate("filliere.php"));
    }

}