<?php

class InscriptionController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'register':
                $this->view = new InscriptionView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;

            case 'register-save':
                // Ouverture database
                $oApp->openDatabase();

                // recuperer usr_email
                $sUserEmail = $_POST['usr_email'];
                if ( !Validate::email($sUserEmail) ) {
                    throw new \Exception("LoginController: Error email not valid", 1);
                }

                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->usr_email = $sUserEmail;
                $oUser->usr_role="user";
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->create();
                unset($oUser);

                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/connexion';
                $this->exit_data['login_alert_message'] = 'Un nouveau mot de passe vous a été envoyé';
                $this->exit_data['login_alert_type'] = 'alert-success';
                $this->http_response_code = 200;
                break;

            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }


}
