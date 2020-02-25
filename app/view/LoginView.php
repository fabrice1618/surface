<?php

class LoginView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Connectez-vous");
        $this->setPageKeywords("Greta, Loire, Formation professionnelle");
        $this->setPageDescription("Connexion à votre espace personnel");
        $this->setPageStyle("");
        $this->setFooterTemplate("footer.php");
        $this->setPageMenu($this->readTemplate("menupublic.php"));
        $this->setPageTemplate($this->readTemplate("public.php"));
        $this->setPageLink("");
        $this->setPageContent($this->readTemplate("login.php"));
        /*
        $this->setPageContent(
            sprintf(
                $this->readTemplate("login.php"),
                $this->readTemplate($this->alert_template)
                )
             );
             */
    }

    public function setAlertTemplate( $sAlertTemplate )
    {
        $this->alert_template = $sAlertTemplate;
        $this->setPageContent(
            sprintf(
                $this->readTemplate("login.php"),
                $this->readTemplate($this->alert_template)
                )
            );
    }

}
