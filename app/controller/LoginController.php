<?php

class LoginController extends Controller
{

    public function __construct()
    {
        global $oApp;

        $sRequestURI = $oApp->request_uri;

        $sUserEmail = $_POST['user_email'] ?? '';
        $sUserPassword = $_POST['user_password'] ?? '';
        $sUserEmailCookie = $_COOKIE['user_email'] ?? '';
        $sUserPasswordCookie = $_COOKIE['user_password'] ?? '';

        // Si l'utilisateur souhaite enregistrer sa Connexion
        // aller directement au controle de mot de passe
        if ($sRequestURI == '/connexion' && !empty($sUserEmailCookie) && !empty($sUserPasswordCookie)) {
            $sRequestURI = '/checklogin';
            $sUserEmail = $sUserEmailCookie;
            $sUserPassword = $sUserPasswordCookie;
        }

        switch ($sRequestURI) {
            case '/connexion':
                $this->view = new LoginView();
                break;
            case '/logout':
                // TODO modifier la session pour se deconnecter
                $oApp->setSession( 'usr_id', 0 );
                $this->view = new HomeView();
                break;
            case '/checklogin':
                if ( Auth::Authentification($sUserEmail, $sUserPassword) ) {
                    //enregistrer les données autologin dans App et cookies
                    $oApp->saveAutologin(
                        $_POST['autologin']??false,
                        $sUserEmail,
                        $sUserPassword
                        );


                    // Entrer dans la partie connectée
                    $this->view = new OccupationView();
                } else {
                    // Ré-afficher l'écran de connexion avec un message d'erreur
                    $this->view = new LoginView();
                    $this->view->setAlertTemplate("login_alert.php");
                }

                break;
            case '/forgotpasswd':
                $this->view = new LoginForgotView();
                break;
            case '/newpasswd':
                // Recuperer les données de l'utilisateur
                $oUser = new User;
                $oUser->readByEmail($sUserEmail);
                // Modifier le mot de passe
                $sNewPassword = $oUser->newPassword();
                $oUser->usr_date_connexion = $sNewPassword;     // Temporaire: le stocker dans la date
                $oUser->update();
                unset($oUser);

                $fp = fopen('newpasswd.log', 'w');
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
