<?php

class App
{
    private const DUREE_COOKIE = 60*60*24*2; // 2 Jours
    private const DUREE_SESSION = 60*15; // 15 minutes
    public const EXIT_DONE = 0;
    public const EXIT_REDIRECT = 1;

    public $base_path = '';
    public $context = null;
    public $exit_code = null;
    public $exit_data = null;
    public $redirect_path = '';
    public $http_response_code = 200;

//    public $request_path = '';
//    public $request_arg = [];
//    public $request_uri = '';
//    public $request_query = '';
    public $phpsessid = null;
    public $session;
//    public $last_active = 0;
    public $user = null;
    public $autologin = [
        'autologin' => false,
        'autologin_user'=>'',
        'autologin_hash'=>''
        ];
//    public $controller_name;
//    public $controller_action;
    public $controller = null;
    public $database = null;
    public $dbconfig = 'dbconfig.json';

    public function __construct()
    {
        global $sBasepath;
        global $oRouter;

        $sBasepath = $sBasepath ?? '../';

        $this->context = isset($_SERVER['argv']) ? 'CLI' : 'WEB';
        $this->base_path = $sBasepath;

        if ($this->context == 'WEB') {
            $oRouter->parseRequestURI($_SERVER['REQUEST_URI']);

            // Gestion de la session
            $this->phpsessid = $_COOKIE['PHPSESSID'] ?? null;
            $this->session = $_SESSION;
            $this->readCookiesAutologin();
        }


/*
        // deconnecter user si il n'as pas été actif depuis 15 minutes
        // exception si autologin est activé
        if (
            ( time() - $this->session['last_active'] > self::DUREE_SESSION ) &&
            $this->autologin['autologin'] === false
            ) {
            $this->request_uri = '/connexion';
            $this->setSession( 'usr_id', 0 );
        }
*/


        //$this->last_active = time();

    }

    public function openDatabase()
    {

        // Ouvrir la base de données en mode persistant
        // Lecture de la config dans dbconfig.json
        $oDBConfig = new DBConfig($this->dbconfig);
        try {
            $this->database = new PDO(
              $oDBConfig->dsn,
              $oDBConfig->user,
              $oDBConfig->password,
              $oDBConfig->options
            );
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            var_dump($oDBConfig);
            $sMessage = sprintf(
                "%s: dans %s à la ligne %d : %s",
                get_class($e),
                $e->getFile(),
                $e->getLine(),
                $e->getMessage());
            throw new \Exception($sMessage, 1);
        }
    }

    public function initController()
    {
        global $oRouter;

        // Instancie le controller
        $sControllerName = $oRouter->controller_name;
        $this->controller = new $sControllerName();

    }

    public function runController()
    {
        global $oRouter;

        // Execute l'action dans le controller
        $this->controller->run( $oRouter->controller_action );

        $this->exit_code = $this->controller->exit_code;
        $this->exit_data = $this->controller->exit_data;
        $this->redirect_path = $this->controller->redirect_path;
        $this->http_response_code = $this->controller->http_response_code;
        
    }

    public function stopController()
    {
        // Stoppe le controleur
        unset($this->controller);
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

    public function setSession( $sKey, $value )
    {
        $this->session[$sKey] = $value;
        $_SESSION[$sKey] = $value;
    }

}
