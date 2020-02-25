<?php

class InscriptionView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Inscription - Module d'affichage");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Inscription pour obtenir votre espace personnel");
        $this->setPageTemplate($this->readTemplate("public.php"));
        $this->setPageContent($this->readTemplate("inscription.php"));
    }

}
