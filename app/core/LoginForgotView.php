<?php

class LoginForgotView extends View
{

    public function __construct()
    {
        $this->setPageTitle("Demandez un nouveau mot de passe - Calculez la surface de votre logement");
        $this->setPageKeywords( "Calcul surface logement" );
        $this->setPageDescription( "Demande de nouveau mot de passe" );

        $this->setPageContent( $this->readTemplate("login_forgot.html"));
    }

}
