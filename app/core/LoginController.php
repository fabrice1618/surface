<?php

class LoginController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'login':
                if ( $oApp->autologin['autologin'] === true ) {
                    $this->exit_code = self::EXIT_REDIRECT;
                    $this->redirect_path = '/logement';
                    $this->http_response_code = 200;
                } else {
                    
                    $this->view = new LoginView();

                    // Envoi des données à la vue
                    $sAlertType = $oApp->exit_data['login_alert_type'] ?? '';
                    $this->view->setData('login_alert_type', $sAlertType);
                    $sAlertMessage = $oApp->exit_data['login_alert_message'] ?? '';
                    $this->view->setData('login_alert_message', $sAlertMessage);

                    $this->view->render();
                    $this->exit_code = self::EXIT_DONE;
                }
                break;

            case 'checklogin':
                // Ouverture database
                $oApp->openDatabase();

                $sUserEmail = $_POST['usr_email'];
                if ( !Validate::email($sUserEmail) ) {
                    throw new \Exception("LoginController: Error email not valid", 1);
                }

                $sUserPassword = $_POST['usr_password'];
                if ( !Auth::validatePassword($sUserPassword) ) {
                    throw new \Exception("LoginController: Error password not valid", 1);
                }

                if ( Auth::Authentification($sUserEmail, $sUserPassword) ) {
                    //enregistrer les données autologin dans App et cookies
                    $oApp->saveAutologin(
                        $_POST['autologin']??false,
                        $sUserEmail,
                        $sUserPassword
                        );

                    $oApp->setSession( 'login', true );
                    $oApp->setSession( 'usr_id', $oApp->user->usr_id );
                    $oApp->setSession( 'last_active', time() );

                    $this->exit_code = self::EXIT_REDIRECT;
                    $this->redirect_path = '/logement';
                    $this->http_response_code = 200;
                } else {
                    // Ré-afficher l'écran de connexion avec un message d'erreur
                    $this->exit_code = self::EXIT_REDIRECT;
                    $this->redirect_path = '/login';
                    $this->exit_data['login_alert_message'] = 'Email ou mot de passe incorrect. Connexion échouée.';
                    $this->exit_data['login_alert_type'] = 'alert-danger';                    
                    $this->http_response_code = 403;
                }
                break;

            case 'forgotpasswd':
                $this->view = new LoginForgotView();
                $this->view->render();
                $this->exit_code = self::EXIT_DONE;
                break;

            case 'newpasswd':
                // Ouverture database
                $oApp->openDatabase();

                // recuperer usr_email
                $sUserEmail = $_POST['usr_email'];
                if ( !Validate::email($sUserEmail) ) {
                    throw new \Exception("LoginController: Error email not valid", 1);
                }

                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->readByEmail($sUserEmail);
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->update();
                unset($oUser);

                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/login';
                $this->exit_data['login_alert_message'] = 'Un nouveau mot de passe vous a été envoyé';
                $this->exit_data['login_alert_type'] = 'alert-success';
                $this->http_response_code = 200;
                break;

            case 'logout':
                $oApp->setSession( 'login', false );
                $oApp->setSession( 'usr_id', 0 );
                $oApp->setSession( 'last_active', 0 );

                $this->exit_code = self::EXIT_REDIRECT;
                $this->redirect_path = '/';
                $this->http_response_code = 200;
                break;
                                                        
            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }
}
