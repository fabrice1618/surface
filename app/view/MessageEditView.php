<?php

class MessageEditView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Ajout/Modification d'un message - Module d'affichage");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Mettez à jour votre message");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("edit.php"));
        $this->setPageLink("/message");
        $this->setPageContent($this->readTemplate("message_edit.php"));
    }

}
