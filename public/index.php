<?php
$sBasepath = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'].'/': '../';
require_once($sBasepath."app/core/autoload.php");

session_start();
$oApp = new App();
$oApp->openDatabase();

//  Routeur

//echo "sRequestURI:$oApp->request_uri\n";
//echo "sRequestQuery:$oApp->request_query\n";


switch ($oApp->request_uri) {
    case '/':
        $sControllerName = 'HomeController';
        break;
    case '/connexion':
    case '/checklogin':
    case '/forgotpasswd':
    case '/newpasswd':
    case '/logout':
        $sControllerName = 'LoginController';
        break;
    case '/inscription':
    case '/inscription-save':
        $sControllerName = 'InscriptionController';
        break;
    case '/logement':
    case '/logement-add':
    case '/logement-edit':
    case '/logement-delete':
    case '/logement-save':
            $sControllerName = 'LogementController';
        break;
    case '/contact':
        $sControllerName = 'ContactController';
        break;
    case '/eco':
        $sControllerName = 'EcoController';
        break;
    case '/rgpd':
        $sControllerName = 'RgpdController';
        break;

    default:
        $sControllerName = 'HomeController';
        break;
}

// transfert du controle au controller
$oController = new $sControllerName();
$oController->run();





?>
