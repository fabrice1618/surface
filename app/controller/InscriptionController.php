<?php

class InscriptionController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;

        $sUserEmail = $_POST['usr_email'] ?? '';

        switch ($sRequestURI) {
            case '/inscription':
                $this->view = new InscriptionView();
                break;
            case '/inscription-save':
                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->usr_email = $sUserEmail;
                $oUser->usr_role="user";
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->create();

                $fp = fopen('newpasswd.log', 'w+');
                fwrite($fp, "Changement de mot de passe $sUserEmail nouveau password: $sNewPassword\n");
                fclose($fp);

                $this->view = new LoginView();
                $this->view->setAlertTemplate("login_newpasswd.php");
                break;
        }

    }

    public function run()
    {
        $this->view->render();
    }



}
