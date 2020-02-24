<?php

class UserSession
{
    private const DUREE_COOKIE = 60*60*24*2; // 2 Jours
    private const DUREE_SESSION = 60*15; // 15 minutes

    public $user = null;

    public $login = false;
//    public $usr_id = 0;
    public $last_active = 0;

    public $autologin = [
        'autologin' => false,
        'autologin_user'=>'',
        'autologin_hash'=>''
        ];


    public function __construct()
    {
        $this->readCookiesAutologin();

        $this->checkLogin();

        if ($this->login) {
            $this->last_active = time();
        }
    }

    private function checkLogin()
    {
        global $oApp;

        $lLogin = ParamSafe::readSession('login', 'Validate::checkbool', false);
//        $iUsrId = (int)ParamSafe::readSession('usr_id', 'Validate::id', 0);
        $iUsrId = (int)ParamSafe::readSession('usr_id', 'Validate::alwaysTrue', 0);
        $iLastActive = ParamSafe::readSession('last_active', 'Validate::checkint', 0);

        $oApp->openDatabase();

        $this->login = false;
        $this->user = new User;
        $this->user->usr_id = 0;

        // On verifie si la précédente connexion est toujours valide
        if ( $lLogin && ( time()-$iLastActive > self::DUREE_SESSION ) ) {
            // Si on a dépassé la duree de la session, on deconnecte
            $lLogin = false;
        }

        if ($lLogin) {
            // Si on est connecte, lire les informations de l'utilisateur
            $this->login = true;
            $this->user->read($iUsrId);
        } else {
            // Si l'utilisateur n'est pas connecté, on tente autologin si besoin
            if ($this->autologin['autologin'] === true) {
                $this->login = true;
                $this->user->readByEmail($this->autologin['autologin_user']);
            }
        }

    }


    public function saveAutologin($lAutologin, $sEmail, $sPassword )
    {
        $this->setAutologin( $lAutologin, $sEmail, Auth::hashPassword($sPassword) );
        $this->writeCookiesAutologin();
    }

    public function setAutologin($lAutologin, $sEmail, $sPasswordHash )
    {
        if (
            is_bool($lAutologin) &&
            is_string($sEmail) &&
            is_string($sPasswordHash) &&
            $lAutologin === true &&
            !empty($sEmail) &&
            !empty($sPasswordHash) &&
            filter_var($sEmail, FILTER_VALIDATE_EMAIL) !== false &&
            Auth::checkPassword($sEmail,$sPasswordHash)
            ) {
          $this->autologin = [
              'autologin'=>true,
              'autologin_user'=>$sEmail,
              'autologin_hash'=>$sPasswordHash
            ];
        } else {
          $this->autologin = [ 'autologin'=>false, 'autologin_user'=>'', 'autologin_hash'=>'' ];
        }

    }

    private function writeCookiesAutologin()
    {
        if ($this->autologin['autologin']) {
            setcookie("autologin", 'true', time()+self::DUREE_COOKIE, "/");
            setcookie("autologin_user", $this->autologin['autologin_user'], time()+self::DUREE_COOKIE, "/");
            setcookie("autologin_hash", $this->autologin['autologin_hash'], time()+self::DUREE_COOKIE, "/");
        } else {
            setcookie("autologin", "" , NULL, "/");
            setcookie("autologin_user", "" , NULL, "/");
            setcookie("autologin_hash", "" , NULL, "/");
        }
    }

    private function readCookiesAutologin()
    {
        $sAutologin = $_COOKIE['autologin'] ?? 'false';
        $sAutologinUser = $_COOKIE['autologin_user'] ?? '';
        $sAutologinHash = $_COOKIE['autologin_hash'] ?? '';

        $lAutologin = false;
        if ($sAutologin=='true') {
            $lAutologin = true;
        }

        $this->setAutologin($lAutologin, $sAutologinUser, $sAutologinHash );
    }


}