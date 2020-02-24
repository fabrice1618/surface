<?php

class LoginController extends Controller
{

    public function run( $sAction )
    {
        global $oApp;
        
        switch ($sAction) {
            case 'login':
                $this->view = new LoginView();

                // Envoi des données à la vue
                $sAlertType = ParamSafe::readSession('login_alert_type', 'Validate::checkstring', '');
                $sAlertMessage = ParamSafe::readSession('login_alert_message', 'Validate::checkstring', '');
                $oApp->unsetSession('login_alert_type');
                $oApp->unsetSession('login_alert_message');

                $this->view->setData('login_alert_type', $sAlertType);
                $this->view->setData('login_alert_message', $sAlertMessage);
                $this->view->render();
                $this->exitDone();

                break;

            case 'checklogin':
                // Ouverture database
                $oApp->openDatabase();

                $sUserEmail = ParamSafe::readPost('usr_email', 'Validate::email', '');
                $sUserPassword = ParamSafe::readPost('usr_password', 'Auth::validatePassword', '');
                $lAutoLogin = ParamSafe::readPost('autologin', 'Validate::checkbool', false);

                $lLogin = false;
                if ( Validate::email($sUserEmail) && Auth::validatePassword($sUserPassword) ) {
                    $oApp->user_session->user = Auth::Authentification($sUserEmail, $sUserPassword);
                    if ($oApp->user_session->user->usr_id !=0) {
                        $lLogin = true;
                    }
                }

                if ( $lLogin ) {
                    //enregistrer les données autologin 
                    if ($lAutoLogin ) {
                        $oApp->saveAutologin(
                            true,
                            $oApp->user_session->user->usr_email,
                            Auth::hashPassword($sUserPassword)
                            );
                    }

                    $oApp->setSession( 'login', true );
                    $oApp->setSession( 'usr_id', $oApp->user_session->user->usr_id );
                    $oApp->setSession( 'last_active', time() );
                    $this->exitRedirect($oApp->app_root_url);

                } else {
                    // Ré-afficher l'écran de connexion avec un message d'erreur
                    $oApp->setSession('login_alert_message', 'Email ou mot de passe incorrect. Connexion échouée.');
                    $oApp->setSession('login_alert_type', 'alert-danger');
                    $this->exitRedirect('/login');
                }
                break;

            case 'forgotpasswd':
                $this->view = new LoginForgotView();
                $this->view->render();
                $this->exitDone();
                break;

            case 'newpasswd':
                // Ouverture database
                $oApp->openDatabase();

                // recuperer usr_email
                $sUserEmail = ParamSafe::readPost('usr_email', 'Validate::email', '');

                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->readByEmail($sUserEmail);
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->update();
                unset($oUser);

                $oApp->setSession('login_alert_message', 'Un nouveau mot de passe vous a été envoyé');
                $oApp->setSession('login_alert_type', 'alert-success');
                $this->exitRedirect('/login');
                break;

            case 'logout':
                $oApp->setSession( 'login', false );
                $oApp->setSession( 'usr_id', 0 );
                $oApp->setSession( 'last_active', 0 );

                $this->exitRedirect('/');
                break;
            case 'register':
                $this->view = new RegisterView();
                $this->view->render();
                $this->exitDone();
                break;
            case 'register-save':
                // Ouverture database
                $oApp->openDatabase();
    
                // recuperer usr_email
                $sUserEmail = ParamSafe::readPost('usr_email', 'Validate::email', '');
    
                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->usr_email = $sUserEmail;
                $oUser->usr_role="user";
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->create();
                unset($oUser);
    
                $oApp->setSession('login_alert_message', 'Un nouveau mot de passe vous a été envoyé');
                $oApp->setSession('login_alert_type', 'alert-success');
                $this->exitRedirect('/login');
                break;
                                                            
            default:
                throw new \Exception(__CLASS__.": Error action '$sAction' not found", 1);
                break;
        }
    }
}
