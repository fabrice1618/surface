<?php

class App
{
    public const EXIT_DONE = 0;
    public const EXIT_REDIRECT = 1;

    public $base_path = '';
    public $context = null;
    public $app_root_url = '/';
    public $exit_code = null;
//    public $exit_data = null;
    public $redirect_path = '';

//    public $request_path = '';
//    public $request_arg = [];
//    public $request_uri = '';
//    public $request_query = '';
//    public $phpsessid = null;
//    public $session;
//    public $last_active = 0;
/*
    public $user = null;
    public $autologin = [
        'autologin' => false,
        'autologin_user'=>'',
        'autologin_hash'=>''
        ];
*/        
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

        }

    }

    public function openDatabase()
    {

        // Ouvrir la base de données en mode persistant
        // Lecture de la config dans dbconfig.json
        if ( is_null($this->database) ) {
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
    }

    public function runController($sControllerName, $sControllerAction)
    {

        if ( ! Validate::checkstring($sControllerName)) {
            throw new \Exception(__CLASS__.": Error controller name '$sControllerName' not valid", 1);
        }

        if ( ! Validate::checkstring($sControllerAction)) {
            throw new \Exception(__CLASS__.": Error controller action '$sControllerAction' not valid", 1);
        }
        
        // Instancie le controller
        $this->controller = new $sControllerName();

        // Execute l'action dans le controller
        $this->controller->run( $sControllerAction );

        $this->exit_code = $this->controller->exit_code;
//        $this->exit_data = $this->controller->exit_data;
        $this->redirect_path = $this->controller->redirect_path;

        // Stoppe le controleur
        unset($this->controller);

    }

    public function setSession( $sKey, $value )
    {
        $this->session[$sKey] = $value;
        $_SESSION[$sKey] = $value;
    }

    public function unsetSession( $sKey )
    {
        unset($this->session[$sKey]);
        unset($_SESSION[$sKey]);
    }

}
