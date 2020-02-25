<?php

class MessageView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Liste de  vos messages");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Liste de vos messages");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menuconnecte.php"));
        $this->setPageTemplate($this->readTemplate("view.php"));
        $this->setPageLink("/message-add");
        $this->setPageContent($this->readTemplate("message.php"));
    }

}
