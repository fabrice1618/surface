<?php

class TypeSalleView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste des types salles");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste de vos types de salles");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/typesalle-add");
        $this->setPageContent($this->readTemplate("typesalle.php"));
    }

}
