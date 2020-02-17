<?php

class LoginView extends View
{
    private $alert_template = '';

    public function __construct()
    {
        $this->setPageTitle("Connexion - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Connexion à votre espace personnel" );

        $this->setPageContent(
            sprintf(
                $this->readTemplate("login.html"),
                $this->readTemplate($this->alert_template)
                )
             );
    }

    public function setAlertTemplate( $sAlertTemplate )
    {
        $this->alert_template = $sAlertTemplate;
        $this->setPageContent(
            sprintf(
                $this->readTemplate("login.html"),
                $this->readTemplate($this->alert_template)
                )
            );
    }

}
